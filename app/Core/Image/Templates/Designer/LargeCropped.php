<?php

namespace App\Core\Image\Templates\Designer;

use Intervention\Image\Filters\FilterInterface;
use Intervention\Image\Image;

class LargeCropped implements FilterInterface
{

    /**
     * Applies filter to given image
     *
     * @param  Image $image
     * @return Image
     */
    public function applyFilter(Image $image)
    {
        return $image->fit(1300, 1300);
    }
}
