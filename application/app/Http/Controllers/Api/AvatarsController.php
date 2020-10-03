<?php

namespace App\Http\Controllers\Api;

use CloudCreativity\LaravelJsonApi\Http\Controllers\JsonApiController;
use App\Avatar;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AvatarsController extends JsonApiController
{


    protected function creating ($post) {
      //
        // \Log::info(print_r($document, true));
          \Log::info("TEST   public function Avatar (Avatar post) AvatarsController{ ");
    }

      protected function created(Avatar $post)
    {
        \Log::info("TEST   public function created (Avatar post)AvatarsController { ");
       //   event(new GameplayCreated($post));
    }

    /*
     protected function saving(App\Avatar $post)
    {

       //   event(new GameplayCreated($post));
    }
    */


    /**
     * @param Avatar $avatar
     * @return StreamedResponse|null
     */
    protected function reading(Avatar $avatar): ?StreamedResponse
    {

        if ($this->willNotEncode($avatar->media_type)) {
            // \Log::warning("DEBUG >>>>>>>>WIL NOT ENCODE>>>>>>>>>> " . $avatar->path);
            return null;
        }

         $files = Storage::files('avatar');
         \Log::warning("DEBUG >>>>>>>>reading>>>>>>>>>> " . $avatar->path);

        abort_unless(
            Storage::disk('local')->exists($avatar->path),
            404,
            'The image file does not exist.'
        );

        return Storage::disk('local')->download($avatar->path);
    }

}
