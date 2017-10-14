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

$router->post('/grup/{nama}', 'ControllerGrup@register');
$router->get('/grup/{id}', 'ControllerGrup@get_by_line_id');
$router->delete('/grup/{id}', 'ControllerGrup@unregister');

$router->post('/divisi', 'ControllerDivisi@register');
$router->get('/divisi/{id}', 'ControllerDivisi@get');
$router->delete('/divisi/{id}', 'ControllerDivisi@unregister');
$router->get('/divisi/{nama}/grup', 'ControllerGrup@get_grup_by_divisi');
