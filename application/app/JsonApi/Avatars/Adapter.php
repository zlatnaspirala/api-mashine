<?php
/**
 * Copyright 2020 Cloud Creativity Limited
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace App\JsonApi\Avatars;

use CloudCreativity\LaravelJsonApi\Eloquent\AbstractAdapter;
use App\Avatar;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Neomerx\JsonApi\Contracts\Encoder\Parameters\EncodingParametersInterface;

class Adapter extends AbstractAdapter
{

    /**
     * Adapter constructor.
     */
    public function __construct()
    {
        parent::__construct(new Avatar());
    }

    /**
     * @inheritdoc
     */
    public function create(array $document, EncodingParametersInterface $parameters)
    {

        if (request()->hasFile('avatar')) {
                \Log::info(" GOOOOOODDDDD avatar  ");
        }

         // try catch
        $path = request()->file('avatar')->store('avatars');

        $data = [
            'type' => 'avatars',
            'attributes' => [
                'path' => $path,
                'media-type' => Storage::disk('local')->mimeType($path)
            ],
        ];

        return parent::create(compact('data'), $parameters);
    }

    /**
     * @param Avatar $record
     * @param array $document
     * @param EncodingParametersInterface $parameters
     * @return mixed
     */
    public function update($record, array $document, EncodingParametersInterface $parameters)
    {

        \Log::warning("  public function update??? ");

        if ($this->didDecode('application/vnd.api+json')) {
            return parent::update($record, $document, $parameters);
        }

        $path = request()->file('avatar')->store('avatars');

        $data = [
            'type' => 'avatars',
            'id' => $record->getRouteKey(),
            'attributes' => [
                'path' => $path,
                'media-type' => Storage::disk('local')->mimeType($path),
            ],
        ];

        return parent::update($record, compact('data'), $parameters);
    }

    /**
     * @param Avatar $avatar
     * @return void
     */
    protected function creating(Avatar $avatar): void
    {
            \Log::warning("NEVER ENTER HERE 2??");
        $avatar->user()->associate(Auth::user());
    }

    /**
     * @inheritDoc
     */
    protected function filter($query, Collection $filters)
    {
        // TODO: Implement filter() method.
    }

}
