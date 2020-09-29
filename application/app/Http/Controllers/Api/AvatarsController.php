<?php

namespace App\Http\Controllers\Api;

use CloudCreativity\LaravelJsonApi\Http\Controllers\JsonApiController;
use App\Avatar;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;
use finfo;

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

       // return Storage::disk('public')->download($avatar->path);

        if ($this->willNotEncode($avatar->media_type)) {
            \Log::warning("DEBUG >>>>>>>>WIL NOT ENCODE>>>>>>>>>> " . $avatar->path);
            return null;
        }

         $files = Storage::files('avatar');
         // \Log::warning("DEBUG >>>>>>>>files>>>>>>>>>> " . $files);

        \Log::warning("DEBUG >>>>>>>>reading>>>>>>>>>> " . $avatar->path);

        abort_unless(

           // Storage::disk('local')->exists('public/avatar/avatar.jpg'),
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
