<?php

namespace App\Http\Controllers\Admin;

use App\Models\FeaturedProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FeaturedController extends Controller
{
    public function update(Request $request)
    {
        if ($request->filled('featured')) {
            // Delete all featured products
            FeaturedProduct::truncate();

            // Add the featured products
            if (is_array($request->featured)) {
                $i = 0;
                foreach ($request->get('featured') as $product) {
                    FeaturedProduct::create(['product_id' => $product, 'priority' => $i]);
                    $i++;
                }
            } else {
                FeaturedProduct::create(['product_id' => $request->featured, 'priority' => 0]);
            }

            flash_message('Featured products updated');
        }

        return redirect()->route('dashboard');
    }
}
