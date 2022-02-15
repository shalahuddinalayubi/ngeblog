<?php

namespace Lara\Tag;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Database\Factories\TagFactory;

class Tag extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Ngeblog\Post\Database\Factories\PostFactory
     */
    protected static function newFactory()
    {
        return TagFactory::new();
    }

    /**
     * Get all of the posts that are assigned this tag.
     */
    public function posts()
    {
        return $this->morphedByMany(\Ngeblog\Post\Models\Post::class, 'taggable');
    }

    /**
     * Find or create tags.
     * 
     * @return \Illuminate\Support\Collection
     */
    public static function findOrCreate($names)
    {
        $tags = collect($names)->map(function ($name) {
            if ($name instanceof self) {
                return $name;
            }

            try {
                $tag = static::query()
                        ->where('name', $name)
                        ->firstOrFail();
            } catch (ModelNotFoundException $error) {
                $tag = static::create(['name' => $name]);
            }

            return $tag;
        });

        return $tags;
    }
}
