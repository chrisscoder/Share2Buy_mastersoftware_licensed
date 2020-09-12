<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class DynamicPage extends Model
{
    use Sluggable;

    protected $fillable = [
        'title',
        'intro',
        'body',
        'image1',
        'meta_title',
        'meta_description',
        'menu_place',
        'menu_title',
    ];

    /**
     * Get resized image
     *
     * @param string $size
     * @return string
     */
    public function image($size = 'large')
    {
        $image = $this->attributes['image1'];
        $url = sprintf('pics/page/%s/%s', $size, $image);

        return url($url);
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return ['slug' => ['source' => 'title']];
    }
}
