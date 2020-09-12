<?php

namespace App\Models;

use App\Models\Sortable\Sortable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Designer extends Model
{
    use Sluggable, SoftDeletes, Sortable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'profession',
        'intro',
        'body',
        'image1',
        'imageAlt',
        'featured',
        'meta_title',
        'meta_description',
        'user_id',
        'vat_id',
    ];

    /**
    * The attributes that should be visible in JSON.
    *
    * @var array
    */
    protected $visible = ['id','slug','title','profession','intro','image1','imageAlt','user_id'];

    /**
     * Function to truncate the body attribute called directly or through the body_truncated mutator
     *
     * @param int $length
     * @return string
     */
    public function bodyTruncated($length = 80)
    {
        return custom_truncate($this->attributes['body'], $length);
    }

    /**
     * Mutator to truncate the body text length
     *
     * @return string
     */
    public function getbodyTruncatedAttribute()
    {
        return $this->bodyTruncated();
    }

    public function getHasOrdersNotHandledAttribute()
    {
        return !!$this->orders->where('handled', 0)->count();
    }

    /**
     * @return string
     */
    public function getUrlAttribute()
    {
        return action('DesignerController@show', [$this->attributes['slug']]);
    }

    /**
     * Get resized image
     *
     * @param string $size
     * @return string
     */
    public function image($size = 'large')
    {
        $image = $this->attributes['image1'];
        $url = sprintf('pics/designer/%s/%s', $size, $image);

        return url($url);
    }

    /**
     * The relationship between the Product and Designer models
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'designer_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function orders()
    {
        return $this->hasManyThrough(Order::class, Product::class);
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
