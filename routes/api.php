<?php

use Dingo\Api\Routing\Router;

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

$api = app(Router::class);

$api->version('v1', function ($api) {
    $api->group([
        'namespace' => 'App\Http\Controllers\Api',
    ], function ($api) {
        $api->post('login', 'AuthController@login');

        $api->group([
            'middleware' => [
                'auth:api',
            ],
        ], function ($api) {
            $api->post('logout', 'AuthController@logout');
            $api->post('refresh', 'AuthController@refresh');
            $api->post('me', 'AuthController@me');

            $api->get('users', 'UserController@index');
            $api->post('users', 'UserController@create');
            $api->get('users/{id}', 'UserController@show')
                ->where('id', '[0-9]+');
            $api->put('users/{id}', 'UserController@update')
                ->where('id', '[0-9]+');
            $api->delete('users/{id}', 'UserController@delete')
                ->where('id', '[0-9]+');
        });
    });
});
