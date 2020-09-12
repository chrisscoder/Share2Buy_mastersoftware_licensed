<?php

namespace App\Core\Image\Templates\Blog;

use Intervention\Image\Filters\FilterInterface;
use Intervention\Image\Image;

class HeroSmall implements FilterInterface
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
