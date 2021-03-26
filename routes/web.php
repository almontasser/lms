<?php

use App\Http\Controllers\BarcodeController;
use App\Http\Controllers\FieldController;
use App\Http\Controllers\SpecialtyController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookInstanceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::delete('/logout', [LoginController::class, 'destroy'])->name('logout');
Route::get('/login-inactive', function () {
  return view('auth.login-inactive');
})->name('login-inactive');
Route::get('/login-banned', function () {
  return view('auth.login-banned');
})->name('login-banned');
Route::post('/login', [LoginController::class, 'store']);
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::get('/register-success', [RegisterController::class, 'registerSuccess'])->name('register-success');
Route::post('/register', [RegisterController::class, 'store']);


Route::get('/books/list', [BookController::class, 'list'])->name('books-list');
Route::get('books/show/{book}', [BookController::class, 'show'])->name('book-show');
Route::get('/books/{book}/download', [BookController::class, 'download'])->name('book-download');


Route::get('/papers', [HomeController::class, 'index'])->name('papers');
Route::get('/projects', [HomeController::class, 'index'])->name('projects');

Route::group(['middleware' => ['admin']], function () {
  Route::get('users/index', [UserController::class, 'index'])->name('users');
  Route::get('users/list', [UserController::class, 'list'])->name('users-list');
  Route::get('users/registrations', [UserController::class, 'registrations'])->name('users-registrations');
  Route::post('users/registrations/{user}', [UserController::class, 'accept_reject'])->name('users-registration-actions');
  Route::get('users/insert', [UserController::class, 'create'])->name('users-insert');
  Route::post('users/insert', [UserController::class, 'store']);
  Route::get('users/edit/{user}', [UserController::class, 'edit'])->name('users-edit');
  Route::put('users/edit/{user}', [UserController::class, 'update']);

  Route::get('users/get/{id}', [UserController::class, 'get'])->name('users-get');

  Route::get('/books/index', [BookController::class, 'index'])->name('books');
  Route::get('books/insert', [BookController::class, 'create'])->name('books-insert');
  Route::post('books/insert', [BookController::class, 'store']);
  Route::get('books/edit/{book}', [BookController::class, 'edit'])->name('book-edit');
  Route::post('books/edit/{book}', [BookController::class, 'update']);

  Route::get('books/json', [BookController::class, 'get_books_json'])->name('books-json');

  Route::get('books/{book}/instances', [BookInstanceController::class, 'index'])->name('book-instances');
  Route::post('books/{book}/instances', [BookInstanceController::class, 'store']);
  Route::get('books/{book}/instances/generate', [BookInstanceController::class, 'show_generate'])->name('book-instances-generate');
  Route::post('books/{book}/instances/generate', [BookInstanceController::class, 'generate'])->name('book-instances-generate');

  Route::post('books/instance/{book_instance}/lend', [BookInstanceController::class, 'lend'])->name('book-instances-lend');
  Route::post('books/instance/{book_instance}/return', [BookInstanceController::class, 'return_book'])->name('book-instances-return');
  Route::get('books/instance/{book_instance}', [BookInstanceController::class, 'show_instance'])->name('book-instance');

  Route::post('json/fields', [FieldController::class, 'json_search'])->name('json-fields');
  Route::post('json/fields/insert', [FieldController::class, 'json_store'])->name('json-fields-insert');
  Route::post('json/fields/get', [FieldController::class, 'json_get'])->name('json-fields-get');

  Route::post('json/specialties', [SpecialtyController::class, 'json_search'])->name('json-specialties');
  Route::post('json/specialties/insert', [SpecialtyController::class, 'json_store'])->name('json-specialties-insert');
  Route::post('json/specialties/get', [SpecialtyController::class, 'json_get'])->name('json-specialties-get');
});

Route::get('barcode/{barcode}', [BarcodeController::class, 'find_barcode'])->name('find-barcode');


// Route::group(['middleware' => ['admin']], function () {
//     Route::get('test', function () {
//         return 'asd';
//     });
// });

// Route::get('/', function () {
//     return view('landing');
// })->name('home');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');
// Route::view('/pages/slick', 'pages.slick');
// Route::view('/pages/datatables', 'pages.datatables');
// Route::view('/pages/blank', 'pages.blank');
