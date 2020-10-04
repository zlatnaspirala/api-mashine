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
          // \Log::info(print_r($post, true));
          \Log::info(" creating AvatarsController{ ");
    }

      protected function created(Avatar $post)
    {
      //   \Log::info("TEST   public function created (Avatar post)AvatarsController { ");
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
            return null;
        }

         $files = Storage::files('avatar');
         \Log::warning(">>>>>>>>reading avatar->path >>>>>>>>>> " . $avatar->path);

        abort_unless(
            Storage::disk('local')->exists($avatar->path),
            404,
            'The image file does not exist.'
        );

        return Storage::disk('local')->download($avatar->path);
    }

}
