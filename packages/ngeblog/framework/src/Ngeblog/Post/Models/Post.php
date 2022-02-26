<?php

namespace Ngeblog\Post\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Lara\Comment\Commentable;
use Lara\Comment\Contracts\IsCommentable;
use Lara\Tag\HasTags;
use Ngeblog\Post\Database\Factories\PostFactory;

class Post extends Model implements IsCommentable
{
    use HasFactory, HasTags, Commentable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'content',
        'user_id',
        'tags',
    ];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Ngeblog\Post\Database\Factories\PostFactory
     */
    protected static function newFactory()
    {
        return PostFactory::new();
    }

    /**
     * Get the user that owns the post.
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
