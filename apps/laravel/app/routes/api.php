<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**
 * Dingo API
 * https://github.com/dingo/api
 */
$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) {

    /**
     * Hi there.
     * If you want to check the routes out, do the following command:
     * $ php artisan api:routes
     */
    $api->get('/', function () {
        return 'It works!';
    });
});
