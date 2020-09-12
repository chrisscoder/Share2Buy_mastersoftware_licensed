<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;

class BlogController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $posts = Post::latest()->paginate(12);

        return view('blog.index', compact('posts'));
    }

    /**
     * @param Post $post
     * @return \Illuminate\View\View
     */
    public function show(Post $post)
    {
        $post->load('relatedDesigners','relatedPosts', 'relatedProducts')->with('authors');

        return view('blog.show', compact('post'));
    }

    public function tagged(Tag $tag)
    {
        $posts = Post::whereHas('tags', function ($query) use($tag) {
            return $query->where('id', $tag->id);
        })->latest()->paginate(12);

        return view('blog.index', compact('posts', 'tag'));
    }
}
