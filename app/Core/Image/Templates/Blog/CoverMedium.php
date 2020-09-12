<?php

namespace App\Core\Image\Templates\Blog;

use Intervention\Image\Filters\FilterInterface;
use Intervention\Image\Image;

class CoverMedium implements FilterInterface
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
