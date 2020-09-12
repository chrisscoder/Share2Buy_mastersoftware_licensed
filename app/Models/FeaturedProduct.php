<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class FeaturedProduct extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'priority',
    ];

    /**
     * The relationship between the FeaturedProduct and Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeActive(Builder $query)
    {
        return $query->whereHas('product', function (Builder $query) {
            $now = Carbon::now();
            return $query->where([
              ['end_date', '>', $now->toDateTimeString()],
              ['price', '>', 0],
            ]);
        });
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeBuyable(Builder $query)
    {
        return $query->whereDoesntHave('product.orders', function (Builder $query) {
            return $query->groupBy('product_id')->havingRaw('SUM(quantity) = 10');
        });
    }
}
