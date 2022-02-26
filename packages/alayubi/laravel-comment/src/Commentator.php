<?php

namespace Lara\Comment;

trait Commentator
{
    /**
     * Get the comments for the model.
     */
    public function comments()
    {
        return $this->hasMany(\Lara\Comment\Comment::class);
    }
}
