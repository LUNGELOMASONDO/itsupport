<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');

Route::post('/login', 'Auth\LoginController@login');

Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');

Route::post('/register', 'Auth\RegisterController@create');

Route::get('/addtechnician', 'HomeController@showRegistrationForm')->name('technician.show.add');

Route::post('/addtechnician', 'HomeController@createTechnician')->name('technician.add');

Route::get('/technician/{id}', 'HomeController@showTechnician')->name('technician.show');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/support', 'SupportController@index');

Route::get('/test', function(){
    return App\Models\Technician::all();
});

