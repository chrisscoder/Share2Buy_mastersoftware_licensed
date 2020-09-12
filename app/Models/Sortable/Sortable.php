<?php

namespace App\Models\Sortable;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

trait Sortable
{
    public function scopeSortable(Builder $query)
    {
        $order = request('order') ? : 'asc';

        // TODO:
        if (request('sort') == 'campaign') {
            $now = Carbon::now();

            return $query->select(DB::raw("products.*,
            CASE
                WHEN `start_date` < '".$now->toDateTimeString()."' AND `end_date` > '".$now->toDateTimeString()."'  THEN '1'
                ELSE '0'
            END AS `campaign`
            "))->orderBy('campaign', $order);
        }

        if (request('sort') == 'designer') {
            return $query->join('designers', $this->getTable() . '.designer_id', '=', 'designers.id')
                ->orderBy('designers.title', $order)
                ->select($this->getTable() . '.*'); // Only select product fields to avoid duplicate field names
        }

        // TODO: also show fields with no sales
        if (request('sort') == 'sale') {
            return $query->leftJoin('orders', $this->getTable() . '.id', '=', 'orders.product_id')
                ->select('products.*', 'orders.product_id', DB::raw('SUM(quantity) as total'))
                ->groupBy('orders.product_id')
                ->orderBy('total', $order);
        }

        return $query->when(request('sort'), function (Builder $query) {
            $order = request('order') ? : 'asc';
            return $query->orderBy(request('sort'), $order);
        })->when(!request('sort'), function (Builder $query) {
            return $query->latest();
        });
    }
}
