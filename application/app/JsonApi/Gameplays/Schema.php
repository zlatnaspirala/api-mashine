<?php

namespace App\JsonApi\Gameplays;

use App\Gameplay;
use Neomerx\JsonApi\Schema\SchemaProvider;

class Schema extends SchemaProvider
{

    /**
     * @var string
     */
    protected $resourceType = 'gameplays';

    /**
     * @var array
     */
    protected $attributes = [
        'title',
        'channelid',
        'content',
        'published_at',
    ];

    /**
     * @var array
     */
    protected $relationships = [
        'author'
    ];

    /**
     * @param $resource
     *      the domain record being serialized.
     * @return string
     */
    public function getId($resource)
    {
        return (string) $resource->getRouteKey();
    }

    /**
     * @param $resource
     *      the domain record being serialized.
     * @return array
     */
    public function getAttributes($resource)
    {
         return [
            'created-at' => $resource->created_at->toAtomString(),
            'updated-at' => $resource->updated_at->toAtomString(),
            'title' => $resource->title,
            'channelid' => $resource->channelid,
            'content' => $resource->content,
            'published-at' => $publishedAt ? $publishedAt->toAtomString() : null,
        ];
    }


        /**
     * @param Post $resource
     * @param bool $isPrimary
     * @param array $includedRelationships
     * @return array
     */
    public function getRelationships($resource, $isPrimary, array $includedRelationships)
    {
        return [
            'author' => [
                self::SHOW_SELF => true,
                self::SHOW_RELATED => true,
                self::SHOW_DATA => isset($includedRelationships['author']),
                self::DATA => function () use ($resource) {
                    return $resource->author;
                },
            ]
        ];
    }

}
