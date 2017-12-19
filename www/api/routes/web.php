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

$router->get('carros[/{id}]', 'CarsController@index');

$router->post('carros', 'CarsController@insert');

$router->put('carros/{id}', 'CarsController@update');

$router->delete('carros/{id}', 'CarsController@delete');

$router->get('marcas', 'CarsController@brands');