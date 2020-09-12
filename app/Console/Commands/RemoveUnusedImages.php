<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class RemoveUnusedImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'images:remove';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Removes unused images';

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
        // chmod(public_path('upload/product'), 0777);

        $products = Product::get();

        foreach ($products as $product) {
            // chmod(public_path('upload/product/'.$product->sectionBottomImage), 0777);
            if (!empty($product->sectionBottomImage) && Storage::disk('upload')->exists('product/' . $product->sectionBottomImage)) {
                Storage::disk('upload')->delete('product/' . $product->sectionBottomImage);
            }
        }
    }
}
