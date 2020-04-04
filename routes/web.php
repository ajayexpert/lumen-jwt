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

  return 'Lumen with JWT token based app - '.$router->app->version();

});


$router->post('register', 'RegisterController@register');

$router->post('login', 'AuthController@authenticate');


// protect route must be in this group
$router->group(['middleware' => 'jwt.auth'], function() use ($router) {

  // after auth all auth routes will be hare  

  $router->post('user', function() use ($router) {
    return Auth::user();
  });


});