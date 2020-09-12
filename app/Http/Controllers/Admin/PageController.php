<?php

namespace App\Http\Controllers\Admin;

use App\Models\DynamicPage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $pages = DynamicPage::orderBy('title')->paginate();

        return view('admin.pages.index', compact('pages'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('create', DynamicPage::class);

        return view('admin.pages.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        if ($request->hasFile('image')) {
            $image1 = generateFilename($request->image);
            $request->image->move(public_path('upload/page'), $image1);
            $request->merge(compact('image1'));
        }

        DynamicPage::create($request->all());

        flash_message('The page was published');

        return redirect()->route('admin.pages');
    }

    /**
     * @param DynamicPage $page
     * @return \Illuminate\View\View
     */
    public function edit(DynamicPage $page)
    {
        $this->authorize('update', $page);

        return view('admin.pages.edit', compact('page'));
    }

    /**
     * @param Request $request
     * @param DynamicPage $page
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, DynamicPage $page)
    {
        // upload image
        if ($request->hasFile('image')) {
            if (!is_null($page->image1) && Storage::disk('upload')->exists('page/' . $page->image1)) {
                Storage::disk('upload')->delete('page/' . $page->image1);
            }
            $page->image1 = generateFilename($request->image);
            $request->image->move(public_path('upload/page'), $page->image1);
        }

        $page->update($request->all());

        flash_message('The page was updated');

        return redirect()->route('admin.pages');
    }

    /**
     * @param DynamicPage $page
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function delete(DynamicPage $page)
    {
        $this->authorize('delete', $page);

        // delete image
        if (!is_null($page->image1) && Storage::disk('upload')->exists('page/' . $page->image1)) {
            Storage::disk('upload')->delete('page/' . $page->image1);
        }

        $page->delete();

        flash_message('The page was deleted');

        return redirect()->route('admin.pages');
    }
}
