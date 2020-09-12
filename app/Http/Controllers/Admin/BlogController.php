<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\UpdateRequest;
use App\Models\Designer;
use App\Models\Post;
use App\Models\Product;
use App\Models\Tag;
use App\Models\User;
use Storage;

class BlogController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('create', Post::class);

        $designers = Designer::orderBy('title')->get();
        $posts = Post::orderBy('title')->get();
        $products = Product::has('designer')->with('designer')->orderBy('title')->get();
        $tags = Tag::orderBy('name')->get();
        $users = User::orderBy('name')->get();

        return view('admin.blog.create', compact('designers', 'posts', 'products', 'tags','users'));
    }

    /**
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Post $post)
    {
        $this->authorize('delete', Post::class);

        $post->tags()->detach();
        $post->delete();

        flash_message('Blog post was deleted');

        return redirect()->route('admin.blog');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function edit(Post $post)
    {
        $this->authorize('update', Post::class);

        $post->load('relatedDesigners','relatedPosts', 'relatedProducts');

        $designers = Designer::orderBy('title')->get();
        $posts = Post::where('id', '!=', $post->id)->orderBy('title')->get();
        $products = Product::has('designer')->with('designer')->orderBy('title')->get();
        $tags = Tag::orderBy('name')->get();
        $users = User::orderBy('name')->get();

        return view('admin.blog.edit', compact('designers', 'post', 'posts', 'products', 'tags','users'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $posts = Post::sortable()->with('authors')->paginate(10);
        // dd($posts[0]->authors->first()->name);

        return view('admin.blog.index', compact('posts'));
    }

    /**
     * @param StoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        $post = Post::create($request->all());

        $post->authors()->attach($request->authors);

        $this->attachTags($post, $request->tags);

        $this->attachRelated($post, $request);

        foreach ($request->files as $name => $file) {
            if ($request->hasFile($name)) {
                $post->$name = generateFilename($request->$name);
                $request->$name->move(public_path('upload/blog'), $post->$name);
            }
        }

        $post->save();

        flash_message('Blog post was published');

        return redirect()->route('admin.blog');
    }

    /**
     * @param UpdateRequest $request
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, Post $post)
    {
        $post->update($request->all());

        $post->authors()->sync(is_array($request->authors) ? $request->authors : [$request->authors]);

        $this->attachTags($post, $request->tags);

        $this->attachRelated($post, $request);

        foreach ($request->files as $name => $file) {
            if ($request->hasFile($name)) {
                if (Storage::disk('upload')->exists('blog/' . $post->$name)) {
                    Storage::disk('upload')->delete('blog/' . $post->$name);
                }
                $post->$name = generateFilename($request->$name);
                $request->$name->move(public_path('upload/blog'), $post->$name);
            }
        }

        $post->save();

        flash_message('Blog post was updated');

        return redirect()->route('admin.blog');
    }

    /**
     * @param Post $post
     * @param array $designers
     */
    protected function attachDesigners(Post $post, array $designers = null)
    {
        if (!is_null($designers)) {
            $designers = Designer::whereIn('slug', $designers)->get();
            $post->relatedDesigners()->sync($designers);
        } else {
            $post->relatedDesigners()->detach();
        }
    }

    /**
     * @param Post $post
     * @param array $posts
     */
    protected function attachPosts(Post $post, array $posts = null)
    {
        if (!is_null($posts)) {
            $posts = Post::whereIn('slug', $posts)->get();
            $post->relatedPosts()->sync($posts);
        } else {
            $post->relatedPosts()->detach();
        }
    }

    /**
     * @param Post $post
     * @param array $products
     */
    protected function attachProducts(Post $post, array $products = null)
    {
        if (!is_null($products)) {
            $products = Product::whereIn('slug', $products)->get();
            $post->relatedProducts()->sync($products);
        } else {
            $post->relatedProducts()->detach();
        }
    }

    /**
     * @param Post $post
     * @param StoreRequest|UpdateRequest $request
     */
    protected function attachRelated(Post $post, $request)
    {
        $this->attachDesigners($post, $request->designers);

        $this->attachPosts($post, $request->posts);

        $this->attachProducts($post, $request->products);
    }

    /**
     * @param Post $post
     * @param array $tags
     */
    protected function attachTags(Post $post, array $tags = null)
    {
        if (!is_null($tags)) {
            $existingTags = Tag::whereIn('slug', $tags)->get();
            $new = array_diff($tags, $existingTags->pluck('slug')->all());

            // Create new tags
            $added = [];
            foreach ($new as $tag) {
                $added[] = Tag::create(['name' => $tag]);
            }

            // Attach the tags to the post
            $ids = $existingTags->merge($added)->pluck('id')->all();
            $post->tags()->sync($ids);
        } else {
            $post->tags()->detach();
        }
    }
}
