<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Storage;

class ChangeDesignerImagePaths extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'images:designers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change designers image path and move images';

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
        $designers = DB::table('designers')->get();

        foreach ($designers as $designer) {
            $images = [];
            $changed = 0;
            if (!is_null($designer->image1) && !empty($designer->image1)) {
                $old = str_replace('/upload/storage/','', $designer->image1);
                $images['image1'] = generateFilenameFromField($old);
                if (Storage::disk('upload')->exists('storage/' . $old)) {
                    if (Storage::disk('upload')->exists('storage/' . $images['image1'])) {
                        $images['image1'] = $this->renameDuplicate('designer', $images['image1']);
                    }
                    Storage::disk('upload')->move('storage/' . $old, 'designer/' . $images['image1']);
                    echo "Moved" . $designer->title . " - header image: " . $images['image1']."\n";
                    $changed++;
                }
            }

            if (count($images) > 0 && $changed > 0) {
                DB::table('designers')->where('id', $designer->id)->update($images);
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
