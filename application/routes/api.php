<?php

use CloudCreativity\LaravelJsonApi\Facades\JsonApi;
use CloudCreativity\LaravelJsonApi\Routing\RouteRegistrar as Api;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
| s App\Http\Controllers\AvatarsController
*/


JsonApi::register('v1')->defaultContentNegotiator('json')->routes(function ($api, $router) {




});

JsonApi::register('v1', ['namespace' => 'Api'], function (Api $api) {

  //     $api->resource('avatars')->contentNegotiator('custom');

      $api->resource('avatars', [
        'middleware' => 'json-api.auth:default',
        'controller' => true
    ]);

    $api->resource('comments', [
        'middleware' => 'json-api.auth:default',
        'has-one' => ['post', 'created-by'],
    ]);

    $api->resource('posts', [
        'middleware' => 'json-api.auth:default',
        'controller' => true,
        'has-one' => 'author',
        'has-many' => ['comments', 'tags']
    ]);

    $api->resource('gameplays', [
        'middleware' => 'json-api.auth:default',
        'controller' => true,
        'has-one' => 'author'
        // 'has-many' => []
    ]);

    $api->resource('sites');
});
