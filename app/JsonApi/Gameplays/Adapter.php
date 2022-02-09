<?php

namespace App\JsonApi\Gameplays;

use App\Gameplay;
use CloudCreativity\LaravelJsonApi\Eloquent\AbstractAdapter;
use CloudCreativity\LaravelJsonApi\Eloquent\BelongsTo;
use CloudCreativity\LaravelJsonApi\Eloquent\HasMany;
use CloudCreativity\LaravelJsonApi\Pagination\StandardStrategy;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class Adapter extends AbstractAdapter
{

    /**
     * Mapping of JSON API attribute field names to model keys.
     *
     * @var array
     */
    protected $attributes = [];

    protected $relationships = [
        'author',
    ];

    protected $dates = [
        'published-at',
    ];
    /**
     * Mapping of JSON API filter names to model scopes.
     *
     * @var array
     */
    protected $filterScopes = [];

    /**
     * @return BelongsTo
     */
    protected function author()
    {
        return $this->belongsTo();
    }
    /**
     * Adapter constructor.
     *
     * @param StandardStrategy $paging
     */
    public function __construct(StandardStrategy $paging)
    {
        parent::__construct(new Gameplay(), $paging);
    }

    /**
     * @param Gameplay $post
     */
    protected function creating(Gameplay $post): void
    {
        $post->author()->associate(Auth::user());
    }

    /**
     * @param Builder $query
     * @param Collection $filters
     * @return void
     */
    protected function filter($query, Collection $filters)
    {
        if ($filters->has('title')) {
            $query->where('gameplays.title', 'like', '%' . $filters->get('title') . '%');
        }

        if ($filters->has('channelid')) {
            $query->where('gameplays.channelid', $filters->get('channelid'));
        }
    }

    /**
     * @inheritdoc
     */
    protected function isSearchOne(Collection $filters)
    {
        return $filters->has('channelid');
    }

}
