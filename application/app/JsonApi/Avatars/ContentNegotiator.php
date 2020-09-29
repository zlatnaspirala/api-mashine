<?php

namespace App\JsonApi\Avatars;

use App\Avatar;
use App\JsonApi\FileDecoder;
use CloudCreativity\LaravelJsonApi\Codec\EncodingList;
use CloudCreativity\LaravelJsonApi\Codec\Decoding;
use CloudCreativity\LaravelJsonApi\Http\ContentNegotiator as BaseContentNegotiator;

class ContentNegotiator extends BaseContentNegotiator
{

    /**
     * Supported encoding media types.
     *
     * Configure supported encoding media types for this negotiator here.
     * These are merged with the encoding media types from your API. The format
     * of this array is identical to the format in your API config.
     *
     * If you need to programmatically work out encoding media types, or need
     * to support media types for specific actions, refer to the Content
     * Negotiation documentation for which methods to overload.
     *
     * @var array
     */
    protected $encoding = [
       'image/jpg',
       'image/png'
    ];

    protected function encodingsForOne(?Avatar $avatar): EncodingList
    {
        $mediaType = optional($avatar)->media_type;

        return $this
            ->encodingMediaTypes()
            ->when($this->request->isMethod('GET'), $mediaType);
    }

    /**
     * Supported decoding media types.
     *
     * Configure supported decoding media types for this negotiator here.
     * These are merged with the decoding media types from your API. The format
     * of this array is identical to the format in your API config.
     *
     * If you need to programmatically work out decoding media types, or need
     * to support media types for specific actions, refer to the Content
     * Negotiation documentation for which methods to overload.
     *
     * @var array
     */
    protected $decoding = [
        'multipart/form-data' => FileDecoder::class,
        'multipart/form-data; boundary=*' => FileDecoder::class,
    ];

        protected function decodingsForResource(?Avatar $avatar): DecodingList
    {

         // $avatar
        //  $decoder = new MultipartDecoder();
         $decoder = new FileDecoder();

          \Log::warning("WHAT IS  avatar " . $avatar);

        return $this
            ->decodingMediaTypes();
            // ->when(is_null($avatar), Decoding::create('multipart/form-data', new FileDecoder()));
        //    ->when(is_null($avatar), Decoding::create('multipart/form-data; boundary=*',new FileDecoder()));
    }

}
