<?php

namespace App\JsonApi\Gameplays;

use App\Gameplay;
use CloudCreativity\LaravelJsonApi\Validation\AbstractValidators;

class Validators extends AbstractValidators
{

    /**
     * The include paths a client is allowed to request.
     *
     * @var string[]|null
     *      the allowed paths, an empty array for none allowed, or null to allow all paths.
     */
    protected $allowedIncludePaths = ['author'];

    /**
     * The sort field names a client is allowed send.
     *
     * @var string[]|null
     *      the allowed fields, an empty array for none allowed, or null to allow all fields.
     */
    protected $allowedSortParameters = [
        'created-at',
        'updated-at',
        'title',
        'channelid'
    ];

    /**
     * The filters a client is allowed send.
     *
     * @var string[]|null
     *      the allowed filters, an empty array for none allowed, or null to allow all.
     */
    protected $allowedFilteringParameters = [
      'id',
      'title',
      'channelid',
    ];

    /**
     * Get resource validation rules.
     *
     * @param mixed|null $record
     *      the record being updated, or null if creating a resource.
     * @return mixed
     */
    protected function rules($record = null): array
    {
        $slugUnique = 'unique:gameplays,channelid';

        if ($record) {
            $slugUnique .= ',' . $record->getKey();
        }

        return [
            'title' => "required|string|between:1,255",
            'content' => "required|string|min:1",
            'channelid' => "required|alpha_dash|$slugUnique"
        ];
    }

    /**
     * Get query parameter validation rules.
     *
     * @return array
     */
    protected function queryRules(): array
    {
        return [
            'filter.title' => 'string|min:1',
            'filter.channelid' => 'sometimes|required|alpha_dash',
            'page.number' => 'integer|min:1',
            'page.size' => 'integer|between:1,50',
        ];
    }

}
