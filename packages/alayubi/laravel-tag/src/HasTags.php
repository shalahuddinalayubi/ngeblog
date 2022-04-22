<?php

namespace Lara\Tag;

use Illuminate\Support\Facades\DB;
use Lara\Tag\Tag;

trait HasTags
{
    protected $modelTag = [];

    /**
     * Get all of the tags for the post.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    /**
     * Bootstrap any application services.
     * 
     * @return void
     */
    public static function bootHasTags()
    {
        static::created(function ($modelHasTag) {
            if (count($modelHasTag->modelTag) === 0) {
                return;
            }

            $modelHasTag->attachTags($modelHasTag->modelTag);

            $modelHasTag->modelTag = [];
        });

        static::saved(function ($modelHasTag) {
            if (count($modelHasTag->modelTag) === 0) {
                return;
            }

            $modelHasTag->syncTags($modelHasTag->modelTag);

            $modelHasTag->modelTag = [];
        });
    }

    /**
     * Sync tags for the post.
     * 
     * @return void
     */
    public function syncTags($names)
    {
        $tags = Tag::findOrCreate($names);

        $this->tags()->sync($tags->pluck('id')->toArray());
    }

    /**
     * Attach tags for the post.
     * 
     * @return void
     */
    public function attachTags($names)
    {
        $tags = Tag::findOrCreate($names);

        $this->tags()->syncWithoutDetaching($tags->pluck('id')->toArray());
    }

    /**
     * Set tags for the post.
     * 
     * @param string|array $tags
     * @return void
     */
    public function setTagsAttribute($tags)
    {
        $this->modelTag = collect($tags)->merge($this->modelTag)->toArray();
    }

    /**
     * Get the most used tags for the model.
     * 
     * @return \Illuminate\Support\Collection
     */
    public static function mostUsedTags($limit = 5)
    {
        $taggableType = (new self)->tags()->getMorphClass();

        $tags = DB::table('tags')
                ->rightJoin('taggables', 'tags.id', '=', 'taggables.tag_id')
                ->select('taggables.tag_id as tag_id', 'tags.name', DB::raw('count(taggables.tag_id) as number'))
                ->where('taggable_type', '=', $taggableType)
                ->groupBy('taggables.tag_id')
                ->groupBy('tags.name')
                ->orderBy('number', 'desc')
                ->take($limit)
                ->get();
        
        return \Lara\Tag\Tag::hydrate($tags->all());
    }
}
