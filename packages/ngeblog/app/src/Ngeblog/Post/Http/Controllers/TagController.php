<?php

namespace Ngeblog\Post\Http\Controllers;

use App\Http\Controllers\Controller;
use Lara\Tag\Tag;

class TagController extends Controller
{
    /**
     * Display posts base on the tag.
     *
     * @param \Lara\Tag\Tag $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        $posts = $tag->posts()->paginate();

        return view('post::index', compact('posts'));
    }
}
