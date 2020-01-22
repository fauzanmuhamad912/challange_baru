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
$router->post('/siswa', [ 'uses' => 'SiswaController@store']);
$router->patch('/siswa/{id}', [ 'uses' => 'SiswaController@update']);
$router->delete('/siswa/{id}', [ 'uses' => 'SiswaController@delete']);
$router->get('/siswa', [ 'uses' => 'SiswaController@show']);
$router->get('/siswa/kelas/{id}', [ 'uses' => 'SiswaController@showrombel']);
$router->get('/siswa/kelas/sekolah/{id}', [ 'uses' => 'SiswaController@showBySekolah']);
$router->get('/siswa/sekolah/{id}', [ 'uses' => 'SiswaController@showSortir']);



$router->post('/kelas', ['uses' => 'KelasController@store']);
$router->get('/kelas', ['uses' => 'KelasController@show']);


$router->post('/sekolah', ['uses' => 'SekolahController@store']);
$router->get('/sekolah', ['uses' => 'SekolahController@show']);