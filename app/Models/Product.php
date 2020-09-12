<?php

namespace App\Models;

use App\Models\Sortable\Sortable;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use Sluggable, SoftDeletes, Sortable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'intro',
        'body',
        'start_date',
        'end_date',
        'price',
        'meta_title',
        'meta_description',
        'designer_id',
        'headerImage',
        'headerImageAlt',
        'sectionTopImage',
        'sectionTopImageAlt',
        'sectionBottomImage',
        'sectionBottomImageAlt',
        'galleryLeftImage',
        'galleryLeftImageAlt',
        'galleryRightImage',
        'galleryRightImageAlt',
        'materials',
        'colour',
        'type',
        'type_value',
        'category',
        'periode',
        'online'
    ];

    /**
    * The attributes that should be visible in JSON.
    *
    * @var array
    */
    protected $visible = ['id','slug','title','images','enddate','periode','price','category','type','buyable','active','discount','priceIncCommission','url','designer','orderCount','unhandledOrderCount'];

    public function currentPct($quantity = 0)
    {
      return currentPct($this->unhandledOrderCount + $quantity - 1);
    }

    /**
     * @return bool
     */
    public function getActiveAttribute()
    {
        $end_date = Carbon::parse($this->attributes['end_date']);
        $now = Carbon::now();

        return ($end_date->gt($now) && $this->unhandledOrderCount < 10 && $this->online == 1);
    }

    /**
     * @return bool
     */
    public function getBuyableAttribute()
    {
        $start_date = Carbon::parse($this->attributes['start_date']);
        $now = Carbon::now();
        return $start_date->lt($now) && $this->online == 1;
    }

    /**
     * @return bool
     */
    public function getCampaignDisabledAttribute()
    {

        $start_date = Carbon::parse($this->attributes['start_date']);
        $end_date = Carbon::parse($this->attributes['end_date']);
        $now = Carbon::now();

        if ($this->unhandledOrderCount > 0) {
            return true;
        }

        if ($start_date->lt($now) && $end_date->gt($now) && $this->unhandledOrderCount > 0) {
          return true;
        }

        return false;
    }

    /**
     * @return float
     */
    public function getCurrentPctAttribute()
    {
        return currentPct($this->unhandledOrderCount);
    }

    /**
     * @return float
     */
    public function getDiscountAttribute()
    {
        return discount($this->price, $this->priceIncCommission);
    }

    /**
     * @return string
     */
    public function getEndDateUTCAttribute()
    {
        $end_date = $this->attributes['end_date'];

        return Carbon::parse($end_date)->toW3cString();
    }

    /**
     * @return int
     */
    public function getOrderCountAttribute()
    {
        $count = 0;
        foreach ($this->orders as $order) {
            $count += $order->quantity;
        }

        return $count;
    }

    /**
     * @return int
     */
    public function getUnhandledOrderCountAttribute()
    {
        $orders = $this->orders->where('handled', 0)->where('status', '!=', 'charged');
        $count = 0;
        foreach ($orders as $order) {
            $count += $order->quantity;
        }

        return $count;
    }

    /**
     * @return float
     */
    public function getPriceIncCommissionAttribute()
    {
        return priceIncCommision($this->price, $this->currentPct);
    }

    /**
     * @return string
     */
    public function getUrlAttribute()
    {
        return route('products.show', [$this->attributes['slug']]);
    }

    /**
     * The relationship between the Product and Designer models
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function designer()
    {
        return $this->belongsTo(Designer::class, 'designer_id');
    }

    /**
     * The relationship between the Product and Featured Product models
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function featured()
    {
        return $this->hasOne(FeaturedProduct::class);
    }

    /**
     * @param string $field
     * @return string
     */
    public function html($field = 'body')
    {
        $text = $this->attributes[$field];

        $parsedown = new \ParsedownExtra();
        $html = $parsedown->setBreaksEnabled(true)->text($text);

        return strip_tags($html,'<p><strong><em>');
    }

    /**
     * Get resized image
     *
     * @param $image
     * @param string $size
     * @return string
     */
    public function image($image, $size = 'large.16:9')
    {
        $image = $this->attributes[$image];
        $url = sprintf('pics/product/%s/%s', $size, $image);

        return url($url);
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeActive(Builder $query)
    {
        $now = Carbon::now();
        return $query->where('start_date', '<', $now->toDateTimeString())
            ->where('end_date', '>', $now->toDateTimeString());
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeBuyable(Builder $query)
    {
        return $query->whereDoesntHave('orders', function (Builder $query) {
            return $query->groupBy('product_id')->havingRaw('SUM(quantity) = 10');
        });
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return ['slug' => ['source' => 'titlemod']];
    }

    public function getTitlemodAttribute()
    {
        return preg_replace('#^\d+#', '', $this->title);
    }

    /**
     * The relationship between the Product and Order models
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * The relationship between the Product and Order models where the order hasn't been handled yet
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ordersUnhandled()
    {
        return $this->hasMany(Order::class)->where('status', '!=', 'charged')->where('handled', 0);
    }
}
