<?php

namespace Lara\Comment;

trait Commentable
{
    /**
     * Get all of the model's comments.
     */
    public function comments()
    {
        return $this->morphMany(\Lara\Comment\Comment::class, 'commentable');
    }
}
