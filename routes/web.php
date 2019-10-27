<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

//checklist routes
$router->get('checklist', 'ChecklistController@getList');
$router->get('checklist/{id}', 'ChecklistController@getOne');
$router->post('checklist', 'ChecklistController@create');
$router->patch('checklist/{id}', 'ChecklistController@update');
$router->delete('checklist/{id}', 'ChecklistController@delete');