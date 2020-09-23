<?php

namespace App\Http\Controllers\Api;

use App\Events\PostCreated;
use App\Post;
use CloudCreativity\LaravelJsonApi\Http\Controllers\JsonApiController;

class GameplaysController extends JsonApiController
{

    /**
     * @param Gameplay $post
     * @return void
     */
    public function created(Gameplay $post)
    {
        event(new PostCreated($post));
    }
}
