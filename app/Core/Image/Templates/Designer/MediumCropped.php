<?php

namespace App\Core\Image\Templates\Designer;

use Intervention\Image\Filters\FilterInterface;
use Intervention\Image\Image;

class MediumCropped implements FilterInterface
{

    /**
     * Applies filter to given image
     *
     * @param  Image $image
     * @return Image
     */
    public function applyFilter(Image $image)
    {
        return $image->fit(650, 650);
    }
}
