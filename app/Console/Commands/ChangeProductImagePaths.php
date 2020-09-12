<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Storage;

class ChangeProductImagePaths extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'images:products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change products image path and move images';

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
        $products = DB::table('products')->get();

        foreach ($products as $product) {
            $images = [];
            $changed = 0;
            if (!is_null($product->headerImage) && !empty($product->headerImage)) {
                $old = str_replace('/upload/storage/','', $product->headerImage);
                $images['headerImage'] = generateFilenameFromField($old);
                if (Storage::disk('upload')->exists('storage/' . $old)) {
                    if (Storage::disk('upload')->exists('product/' . $images['headerImage'])) {
                        $images['headerImage'] = $this->renameDuplicate('product', $images['headerImage']);
                    }
                    Storage::disk('upload')->move('storage/' . $old, 'product/' . $images['headerImage']);
                    echo "Moved" . $product->title . " - header image: " . $images['headerImage']."\n";
                    $changed++;
                }
            }

            if (!is_null($product->sectionTopImage) && !empty($product->sectionTopImage)) {
                $old = str_replace('/upload/storage/','', $product->sectionTopImage);
                $images['sectionTopImage'] = generateFilenameFromField($old);
                if (Storage::disk('upload')->exists('storage/' . $old)) {
                    if (Storage::disk('upload')->exists('product/' . $images['sectionTopImage'])) {
                        $images['sectionTopImage'] = $this->renameDuplicate('product', $images['sectionTopImage']);
                    }
                    Storage::disk('upload')->move('storage/' . $old, 'product/' . $images['sectionTopImage']);
                    echo "Moved" . $product->title . " - section top image: " . $images['sectionTopImage']."\n";
                    $changed++;
                }
            }

            if (!is_null($product->galleryLeftImage) && !empty($product->galleryLeftImage)) {
                $old = str_replace('/upload/storage/','', $product->galleryLeftImage);
                $images['galleryLeftImage'] = generateFilenameFromField($old);
                if (Storage::disk('upload')->exists('storage/' . $old)) {
                    if (Storage::disk('upload')->exists('product/' . $images['galleryLeftImage'])) {
                        $images['galleryLeftImage'] = $this->renameDuplicate('product', $images['galleryLeftImage']);
                    }
                    Storage::disk('upload')->move('storage/' . $old, 'product/' . $images['galleryLeftImage']);
                    echo "Moved" . $product->title . " - gallery left image: " . $images['galleryLeftImage']."\n";
                    $changed++;
                }
            }

            if (!is_null($product->galleryRightImage) && !empty($product->galleryRightImage)) {
                $old = str_replace('/upload/storage/','', $product->galleryRightImage);
                $images['galleryRightImage'] = generateFilenameFromField($old);
                if (Storage::disk('upload')->exists('storage/' . $old)) {
                    if (Storage::disk('upload')->exists('product/' . $images['galleryRightImage'])) {
                        $images['galleryRightImage'] = $this->renameDuplicate('product', $images['galleryRightImage']);
                    }
                    Storage::disk('upload')->move('storage/' . $old, 'product/' . $images['galleryRightImage']);
                    echo "Moved" . $product->title . " - gallery right image: " . $images['galleryRightImage']."\n";
                    $changed++;
                }
            }

            if (count($images) > 0 && $changed > 0) {
                DB::table('products')->where('id', $product->id)->update($images);
            }
        }
    }

    private function renameDuplicate($folder, $filename)
    {
        $actual_name = pathinfo($filename,PATHINFO_FILENAME);
        $original_name = $actual_name;
        $extension = pathinfo($filename, PATHINFO_EXTENSION);

        $i = 1;
        while(Storage::disk('upload')->exists($folder .'/' . $actual_name. '.' . $extension))
        {
            $actual_name = (string)$original_name.'-'.$i;
            $filename = $actual_name.".".$extension;
            $i++;
        }

        return $filename;
    }
}
