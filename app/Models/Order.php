<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'quantity',
        'size',
        'total',
        'name',
        'address',
        'postal',
        'city',
        'email',
        'status',
        'stripetoken',
        'handled'
    ];

    /**
     * The relationship between the Order and Product models
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
