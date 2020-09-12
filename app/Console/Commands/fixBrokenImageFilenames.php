<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;
use Storage;

class fixBrokenImageFilenames extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'images:fix';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fixes broken images uploaded by designers';

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
        $products = Product::get();

        foreach ($products as $product) {
            $changes = 0;
            $images = ['headerImage', 'sectionTopImage', 'galleryLeftImage', 'galleryRightImage'];
            foreach ($images as $image) {
                if (substr($product->{$image},-1) == '.') {
                    $name = $product->{$image}.'jpg';
                    echo 'changed '.$product->{$image}.' to '.$name."\n";
                    Storage::disk('upload')->move('product/' . $product->{$image}, 'product/' . $name);

                    $product->{$image} = $name;
                    $changes++;
                }
            }
            if ($changes > 0) {
                $product->save();
            }

        }
    }
}
