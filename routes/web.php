<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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
$router->group(['prefix' => 'api'], function () use ($router) {
    // Rutas para tareas
    $router->get('/tareas', 'TareaController@index');
    $router->get('/tareas/{id}', 'TareaController@show');
    $router->post('/tareas', 'TareaController@store');
    $router->put('/tareas/{id}', 'TareaController@update');
    $router->delete('/tareas/{id}', 'TareaController@destroy');

    // Rutas para empleados
    $router->get('/empleados', 'EmpleadoController@index');
    $router->get('/empleados/{id}', 'EmpleadoController@show');
    $router->post('/empleados', 'EmpleadoController@store');
    $router->put('/empleados/{id}', 'EmpleadoController@update');
    $router->delete('/empleados/{id}', 'EmpleadoController@destroy');

    // Rutas para estados
    $router->get('/estados', 'EstadoController@index');
    $router->get('/estados/{id}', 'EstadoController@show');
    $router->post('/estados', 'EstadoController@store');
    $router->put('/estados/{id}', 'EstadoController@update');
    $router->delete('/estados/{id}', 'EstadoController@destroy');

    // Rutas para prioridades
    $router->get('/prioridades', 'PrioridadController@index');
    $router->get('/prioridades/{id}', 'PrioridadController@show');
    $router->post('/prioridades', 'PrioridadController@store');
    $router->put('/prioridades/{id}', 'PrioridadController@update');
    $router->delete('/prioridades/{id}', 'PrioridadController@destroy');
});
