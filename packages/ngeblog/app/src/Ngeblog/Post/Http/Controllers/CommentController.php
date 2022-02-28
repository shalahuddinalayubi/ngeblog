<?php

namespace Ngeblog\Post\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Lara\Comment\CommentService;
use Ngeblog\Post\Models\Post;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Ngeblog\Post\Model\Post $post
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Post $post)
    {
        CommentService::for($post, $request)
            ->setCommentator(Auth::user())
            ->store();

        return redirect()->back();
    }
}
