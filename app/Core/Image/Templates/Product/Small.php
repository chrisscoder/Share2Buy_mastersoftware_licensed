<?php

namespace App\Core\Image\Templates\Product;

use Intervention\Image\Filters\FilterInterface;
use Intervention\Image\Image;

class Small implements FilterInterface
{
    /**
     * Applies filter to given image
     *
     * @param  Image $image
     * @return Image
     */
    public function applyFilter(Image $image)
    {
        return $image->fit(352, 198);
    }
}
