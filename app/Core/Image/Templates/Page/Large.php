<?php

namespace App\Core\Image\Templates\Page;

use Intervention\Image\Filters\FilterInterface;
use Intervention\Image\Image;

class Large implements FilterInterface
{

    /**
     * Applies filter to given image
     *
     * @param  Image $image
     * @return Image
     */
    public function applyFilter(Image $image)
    {
        return $image->widen(1920);
    }
}
