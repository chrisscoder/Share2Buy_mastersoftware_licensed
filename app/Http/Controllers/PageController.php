<?php

namespace App\Http\Controllers;

use App\Models\Designer;
use App\Models\FeaturedProduct;
use App\Models\Order;
use App\Models\Product;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function frontpage()
    {
        $popularProducts = $this->getBestSelling(8);
        $featured_product = FeaturedProduct::active()->buyable()
            ->with('product', 'product.designer', 'product.orders')
            ->orderBy('priority')
            ->first();
        $featured_product = !is_null($featured_product) ? $featured_product->product : null;
        $endingCampaigns = $this->getEndingCampaigns();
        $best_selling = $popularProducts->first();
        // $featured_designer = $this->getFeaturedDesigner();
        $latestPosts = Post::latest()->take(4)->get();
        $latestDesigners = Designer::latest()->take(4)->get();

        return view('home', compact(
            'best_selling',
            'endingCampaigns',
            'featured_product',
            'popularProducts',
            'latestPosts',
            'latestDesigners')
        );
    }

    /**
     * @param $page
     * @return \Illuminate\View\View
     */
    public function page($page)
    {
        // if this controller has method with the same name as $page's string call it instead
        if (is_string($page) && method_exists($this, $page)) {
            return $this->$page();
        } elseif (is_string($page)) {
            return view('pages.' . $page);
        }

        return view('pages.show', compact('page'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function join()
    {
        $designers = Designer::whereIn('id', [33,54,39])->get();
        $designers = $designers->sortBy(function ($designer, $key) {
            return array_search($designer->id, [54,33,39]);
        });

        return view('pages.join', compact('designers'));
    }

    /**
     * @return Designer|null
     */
    private function getFeaturedDesigner()
    {
        $id = DB::table('site_settings')->value('featured_designer');
        $designer = Designer::where('id', $id)->first();

        return $designer;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    private function getBestSelling($take = 8)
    {
        $best_selling = Order::whereHas('product', function ($query) {
          $now = Carbon::now();
          $query->where([
            ['end_date', '>', $now],
            ['price', '>', 0],
            ['online', '=', 1]
          ]);
        })->has('product.designer')
          ->with('product', 'product.ordersUnhandled', 'product.designer')
          ->select(DB::raw('product_id, sum(`orders`.`quantity`) AS `quantity`'))
          ->groupBy('product_id')
          ->orderBy('quantity', 'desc')
          ->take($take*2)->get();

        $products = collect();
        foreach ($best_selling as $order) {
            $products[] = $order->product;
        }

        foreach ($products as $key => &$product) {
            $productOrders = 0;
            if (!empty($product->ordersUnhandled)) {
              foreach ($product->ordersUnhandled as $order) {
                  $productOrders += $order->quantity;
              }

              if ($productOrders == 10) {
                 $products->forget($key);
              }
            }
        }

        return $products->take($take);
    }

    /**
     * @param int $take
     * @return mixed
     */
    private function getEndingCampaigns($take = 8)
    {
        $now = Carbon::now();
        $dayAfterTomorrow = $now->copy()->addDays(2);
        $products = Product::with('designer', 'orders')
          ->where([
            ['end_date', '>', $now],
            ['end_date', '<', $dayAfterTomorrow],
            ['price', '>', 0],
          ])
          ->orderBy('end_date')
          ->take($take)
          ->get();

        return $products;
    }
}
