<?php

namespace App\Console\Commands;

use DB;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Notifications\CampaignFinished;
use App\Notifications\CampaignSoldOut;

class CampaignUnhandled extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'campaign:unhandled';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notify designers if their campaigns are sold out or finished and are still unhandled';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

      /**
       * Check if there are campaigns that has sold out or ended and is still unhandled
       */

      // TODO refactor into one function and make service that takes care of the heavy lifting i.e. emailing and other logic
      // TODO make it such that the reminder is send again after some time

      // Get current date time
      $currentDateTime = Carbon::now();

      // Query orders that are unhandled and which campaign has ended
      $unhandledFinishedCampaigns = DB::table('orders')
                                  ->where('handled',0)
                                  ->where('status', '!=', 'charged')
                                  ->where('reminder_status',0)
                                  ->join('products', 'orders.product_id','=','products.id')
                                  ->where('products.end_date','<=',$currentDateTime)
                                  ->select('orders.id','orders.quantity','orders.product_id','products.designer_id','products.price','products.title')
                                  ->get();

      // Query orders that are unhandled and which campaign has not ended
      $unhandledRunningCampaigns  = DB::table('orders')
                                  ->where('handled',0)
                                  ->where('status', '!=', 'charged')
                                  ->where('reminder_status',0)
                                  ->join('products', 'orders.product_id','=','products.id')
                                  ->where('products.end_date','>=',$currentDateTime)
                                  ->select('orders.id','orders.quantity','orders.product_id','products.designer_id','products.price','products.title')
                                  ->get();

      if ($unhandledFinishedCampaigns->isNotEmpty()) {
        /**
         * Check if campaigns are finished and have unhandled orders.
         * If so find designer and send reminder
         */

        // Get unique product IDs
        $productsID = [];

        foreach ($unhandledFinishedCampaigns as $unhandledFinishedCampaign) {
          if (!in_array($unhandledFinishedCampaign->product_id, $productsID)) {
            $productsID[] = $unhandledFinishedCampaign->product_id;
          }
        }

        if (!empty($productsID)) {
          foreach ($productsID as $key => $productID) {
            $quantitySum = DB::table('orders')->where('handled',0)->where('status', '!=', 'charged')->where('product_id','=',$productID)->sum('quantity');
            $product = Product::with('designer', 'designer.user')->find($productsID)->first();

            User::find($product->designer->user_id)->notify(new CampaignFinished($product, $quantitySum));

            // Only remind designer if not reminded before
            DB::table('orders')->where('product_id',$productID)->where('handled',0)->update(['reminder_status' => 1]);

          }

          $this->info("Processed unhandled finished campaigns and send reminder emails to designer");
        }

      }

      if ($unhandledRunningCampaigns->isNotEmpty()) {
        /**
         * Check if campaign products are sold out and have unhandled orders.
         * If so find designer and send reminder
         */

        // Get unique product IDs
        $productsID = [];

        foreach ($unhandledRunningCampaigns as $key => $unhandledRunningCampaign) {
          if (!in_array($unhandledRunningCampaign->product_id, $productsID)) {
            $productsID[] = $unhandledRunningCampaign->product_id;
          }
        }

        if (!empty($productsID)) {
          foreach ($productsID as $productID) {
            $quantitySum = DB::table('orders')->where('handled',0)->where('status', '!=', 'charged')->where('product_id','=',$productID)->sum('quantity');
            if ($quantitySum >= 10) {
              // Get designer and send reminder
              $product = Product::with('designer', 'designer.user')->find($productsID)->first();

              User::find($product->designer->user_id)->notify(new CampaignSoldOut($product));

              // Only remind designer if not reminded before
              DB::table('orders')->where('product_id',$productID)->where('handled',0)->update(['reminder_status' => 1]);
            }
          }

          $this->info("Processed unhandled sold out campaigns and send reminder emails to designer");
        }

      }

      if ($unhandledRunningCampaigns->isEmpty() && $unhandledFinishedCampaigns->isEmpty()) {
        $this->info("No reminders to send out");
      }
    }
}
