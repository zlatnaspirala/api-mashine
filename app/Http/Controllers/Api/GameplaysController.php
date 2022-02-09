<?php

namespace App\Http\Controllers\Api;

use App\Events\GameplayCreated;
use App\Gameplay;
use CloudCreativity\LaravelJsonApi\Http\Controllers\JsonApiController;

class GameplaysController extends JsonApiController
{

    /**
     * @param Gameplay $post
     * @return void
     */
    public function created(Gameplay $post)
    {
        event(new GameplayCreated($post));
    }
}
