<?php

namespace App\Http\Controllers\Admin;

use App\Models\Designer;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Notifications\CampaignActivated;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::when($request->user()->role != 'admin', function ($query) use ($request) {
            return $query->where('designer_id', $request->user()->designer->id);
        })->has('designer')
            ->with('designer', 'orders')
            ->sortable()
            ->paginate(10);

        $products->appends([
            'sort' => request('sort'),
            'order' => request('order')
        ]);

        Session::put('currentPage',$products->currentPage());

        return view('admin.products.index', compact('products'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function add(Request $request)
    {
        if ($request->user()->role == 'admin') {
            $designers = Designer::orderBy('title')->get();
            return view('admin.products.add', compact('designers'));
        }

        return view('admin.products.add');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $product = Product::create($request->all());

        // loop through files and upload them all
        // TODO should this be checked up against an array instead?
        foreach ($request->files as $name => $file) {
            if ($request->hasFile($name)) {
                $product->$name = generateFilename($request->$name);
                $request->$name->move(public_path('upload/product'), $product->$name);
            }
        }

        $product->start_date = Carbon::createFromFormat('d/m/Y H:i' ,$request->start_date);
        $product->end_date = $product->start_date->copy()->addDays($request->periode);
        $product->online = 1;

        $product->save();

        flash_message('The product was published');

        return redirect()->route('dashboard');
    }

    /**
     * @param Product $product
     * @return \Illuminate\View\View
     */
    public function edit(Product $product)
    {
        $this->authorize('update', $product);

        $product->load('orders');

        $today = Carbon::now();
        $start_date = date('Y-m-d H:i', strtotime($product->start_date));
        $end_date = date('Y-m-d H:i', strtotime($product->end_date));
        $productOrderSum = 0;

        return view('admin.products.edit', compact('product'));
    }

    /**
     * @param Request $request
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Product $product)
    {
        $this->authorize('update', $product);

        $prevStartDate = '';
        $updatedStartDate = '';

        if ($request->filled('start_date') && !empty($product->start_date)) {
            $prevStartDate = Carbon::parse($product->start_date); // Done before update
            $updatedStartDate = Carbon::createFromFormat('d/m/Y H:i', $request->start_date);
        }

        $product->update($request->all());

        /**
         * loop through files and upload them all
         */
        foreach ($request->files as $name => $file) {
            if ($request->hasFile($name)) {
                if (Storage::disk('upload')->exists('product/' . $product->$name)) {
                    Storage::disk('upload')->delete('product/' . $product->$name);
                }
                $product->$name = generateFilename($request->$name);
                $request->$name->move(public_path('upload/product'), $product->$name);
            }
        }

        /**
         * Format dateTime
         */
        if ($request->filled('start_date')) {
            $product->start_date = Carbon::createFromFormat('d/m/Y H:i', $request->start_date);
            $product->end_date = $product->start_date->copy()->addDays($request->periode);
        }

        /**
         * Send notifications about activation of campaigns
         * if the updated start date is greater than the prev start date
         */
        if (!empty($prevStartDate) && !empty($updatedStartDate) && $updatedStartDate->gt($prevStartDate)) {
            $product->load('designer');
            User::find($product->designer->user_id)->notify(new CampaignActivated($product));
        }

        $product->online = 1;

        $product->save();

        flash_message($product->title . ' was updated');

        if ($request->user()->role != 'admin') {
            return redirect()->route('dashboard');
        }

        return Redirect::route('admin.products', ['page' => Session::get('currentPage')]);
    }

    /**
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Product $product)
    {

        $this->authorize('delete', $product);

        $product->delete();

        flash_message('The product was deleted');

        return redirect()->route('dashboard');
    }
}
