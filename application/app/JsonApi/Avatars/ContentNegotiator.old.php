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

use App\JsonApi\FileDecoder;
use CloudCreativity\LaravelJsonApi\Codec\EncodingList;
use CloudCreativity\LaravelJsonApi\Http\ContentNegotiator as BaseContentNegotiator;
use App\Avatar;
use CloudCreativity\LaravelJsonApi\Codec\Decoding;

class ContentNegotiator extends BaseContentNegotiator
{

    /**
     * @var array
     */
/*
    protected $decoding = [
        'multipart/form-data' => FileDecoder::class,
        'multipart/form-data; boundary=*' => FileDecoder::class,
    ];
*/


    /**
     * @param Avatar|null $avatar
     * @return EncodingList
     */
    protected function encodingsForOne(?Avatar $avatar): EncodingList
    {

        \Log::warning("WHAT IS  avatar2 " . $avatar);

        $mediaType = optional($avatar)->media_type;

        return $this
            ->encodingMediaTypes()
            ->when($this->request->isMethod('GET'), $mediaType);
    }

    /**
     * @param Avatar|null $avatar
     * @return DecodingList
     */

    protected function decodingsForResource(?Avatar $avatar): DecodingList
    {

         // $avatar
        //  $decoder = new MultipartDecoder();
         $decoder = new FileDecoder();

          \Log::warning("WHAT IS  avatar " . $avatar);

        return $this
            ->decodingMediaTypes()
            ->when(is_null($avatar), Decoding::create('multipart/form-data', new FileDecoder()))
            ->when(is_null($avatar), Decoding::create('multipart/form-data; boundary=*',new FileDecoder()));
    }

}