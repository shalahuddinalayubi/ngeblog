<?php

namespace Ngeblog\Tag\Http\Controller\Api;

use App\Http\Controllers\Controller;
use Lara\Tag\Tag;
use Ngeblog\Tag\Transformers\TagTransformer;
use Spatie\QueryBuilder\Exceptions\InvalidFilterQuery;
use Spatie\QueryBuilder\QueryBuilder;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            $tags = QueryBuilder::for(Tag::class)
                        ->allowedFilters('name')
                        ->get();

        } catch(InvalidFilterQuery $error) {

            return response()->json(['error' => 'Invalid query filter.'], '400');

        }

        return fractal($tags, new TagTransformer())->respond();
    }
}
