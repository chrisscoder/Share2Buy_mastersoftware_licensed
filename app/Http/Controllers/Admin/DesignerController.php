<?php

namespace App\Http\Controllers\Admin;

use App\Models\Designer;
use App\Http\Requests\Designer\StoreRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class DesignerController extends Controller
{
    public function index()
    {
        $this->authorize('index', Designer::class);

        $designers = Designer::sortable()
            ->paginate(10);

        $designers->appends([
            'sort' => request('sort'),
            'order' => request('order')
        ]);

        Session::put('currentPage',$designers->currentPage());

        return view('admin.designers.index', compact('designers'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function add()
    {
        $this->authorize('create', Designer::class);

        return view('admin.designers.add');
    }

    /**
     * @param StoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('create', Designer::class);

        // Upload image
        $image1 = generateFilename($request->image);
        $request->image->move(public_path('upload/designer'), $image1);
        $request->merge(compact('image1'));

        $user = User::where('email', $request->email)->first();
        if (is_null($user)) {
            $user = User::create([
                'name' => $request->title,
                'email' => $request->email,
                'password' => $request->password,
                'role' => 'designer'
            ]);
        }

        $request->merge(['user_id' => $user->id]);
        Designer::create($request->all());

        flash_message('Brand added');

        return redirect()->route('admin.designers');
    }

    /**
     * @param Designer $designer
     * @return \Illuminate\View\View
     */
    public function edit(Designer $designer)
    {
        $this->authorize('update', $designer);

        return view('admin.designers.edit', compact('designer'));
    }

    /**
     * @param Designer $designer
     * @return RedirectResponse
     */
    public function delete(Designer $designer)
    {
        $this->authorize('delete', $designer);

        $designer->products()->delete();
        $designer->user()->delete();

        $designer->delete();

        flash_message('Brand deleted');

        return redirect()->route('admin.designers');
    }

    /**
     * @param Request $request
     * @param Designer $designer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Designer $designer)
    {
        $this->authorize('update', $designer);

        // upload image
        if ($request->hasFile('image')) {
            if (!is_null($designer->image1) && Storage::disk('upload')->exists('designer/' . $designer->image1)) {
                Storage::disk('upload')->delete('designer/' . $designer->image1);
            }
            $designer->image1 = generateFilename($request->image);
            $request->image->move(public_path('upload/designer'), $designer->image1);
        }

        $designer->update($request->all());

        flash_message('Brand updated');

        if ($request->user()->role != 'admin') {
            return redirect()->route('dashboard');
        }

        // return redirect()->route('admin.designers');
        return Redirect::route('admin.designers', ['page' => Session::get('currentPage')]);
    }

    public function featured(Request $request)
    {
        // Laravel 5.5: The only method will now only return attributes that are actually present in the request payload. If you would like to preserve the old behavior of the only method, you may use the all method instead.
        DB::table('site_settings')->update($request->only('featured_designer'));

        flash_message('Featured designer updated');

        return redirect()->route('dashboard');
    }
}
