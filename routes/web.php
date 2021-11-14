<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Page\Todo;

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
Route::get('/', function(){
    return redirect()->route('login');
});
Route::get('/todo', [Todo::class, 'index'])->middleware('auth')->name('todo');
Route::get('/home', function(){
    return redirect()->route('login');
})->name('home');

Route::post('/done', [Todo::class, 'done'])->name('done');
Route::post('/newtodo', [Todo::class, 'createTodo'])->name('new_todo');
Route::post('/remove-todo', [Todo::class, 'removeTodo'])->name('remove');

Auth::routes();


