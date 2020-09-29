<?php

namespace App\Http\Controllers\Api;

use CloudCreativity\LaravelJsonApi\Http\Controllers\JsonApiController;
use App\Avatar;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;


class AvatarsController extends JsonApiController
{

      public function created(Avatar $post)
    {
       //   event(new GameplayCreated($post));
    }

    /**
     * @param Avatar $avatar
     * @return StreamedResponse|null
     */
    protected function reading(Avatar $avatar): ?StreamedResponse
    {
        if ($this->willNotEncode($avatar->media_type)) {
            return null;
        }

        \Log::warning("DEBUG >>>>>>>>>>>>>>>>>> " . $avatar->path);

        abort_unless(
            Storage::disk('local')->exists($avatar->path),
            404,
            'The image file does not exist.'
        );

        return Storage::disk('local')->download($avatar->path);
    }

    /*
     public function index()
    {
        // return view('home');
    }
    */

}
