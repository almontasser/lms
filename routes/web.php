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
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResearchPaperController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\StageController;
use JanisKelemen\Setting\Facades\Setting;

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

Route::get('papers/list', [ResearchPaperController::class, 'list'])->name('papers-list');
Route::get('papers/show/{paper}', [ResearchPaperController::class, 'show'])->name('paper-show');

Route::get('projects/list', [ProjectController::class, 'list'])->name('projects-list');
Route::get('projects/show/{project}', [ProjectController::class, 'show'])->name('project-show');

Route::get('/search', [SearchController::class, 'search'])->name('search');

Route::get('barcode/{barcode}', [BarcodeController::class, 'find_barcode'])->name('find-barcode');

if (!Setting::get('settings_initiated')) {
  Route::post('settings', [SettingsController::class, 'update'])->name('settings');
} else {
  Route::group(['middleware' => ['super.admin']], function () {
    Route::get('settings', [SettingsController::class, 'index'])->name('settings');
    Route::post('settings', [SettingsController::class, 'update']);
  });
}

Route::group(['middleware' => ['admin']], function () {
  Route::get('users/index', [UserController::class, 'index'])->name('users');
  Route::get('users/list', [UserController::class, 'list'])->name('users-list');
  Route::get('users/registrations', [UserController::class, 'registrations'])->name('users-registrations');
  Route::post('users/registrations/{user}', [UserController::class, 'accept_reject'])->name('users-registration-actions');
  Route::get('users/insert', [UserController::class, 'create'])->name('users-insert');
  Route::post('users/insert', [UserController::class, 'store']);
  Route::get('users/edit/{user}', [UserController::class, 'edit'])->name('users-edit');
  Route::put('users/edit/{user}', [UserController::class, 'update']);
  Route::post('users/activate/{user}', [UserController::class, 'activate'])->name('user-activate');
  Route::post('users/change-password/{user}', [UserController::class, 'changePassword'])->name('user-change-password');

  Route::get('users/get/{id}', [UserController::class, 'get'])->name('users-get');

  Route::get('users/import', [UserController::class, 'get_import'])->name('users-import');
  Route::post('users/import', [UserController::class, 'import']);

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

  Route::get('books/borrowed', [BookInstanceController::class, 'borrowed'])->name('books-borrowed');

  Route::post('json/fields', [FieldController::class, 'json_search'])->name('json-fields');
  Route::post('json/fields/insert', [FieldController::class, 'json_store'])->name('json-fields-insert');
  Route::post('json/fields/get', [FieldController::class, 'json_get'])->name('json-fields-get');

  Route::post('json/specialties', [SpecialtyController::class, 'json_search'])->name('json-specialties');
  Route::post('json/specialties/insert', [SpecialtyController::class, 'json_store'])->name('json-specialties-insert');
  Route::post('json/specialties/get', [SpecialtyController::class, 'json_get'])->name('json-specialties-get');

  Route::post('json/stages', [StageController::class, 'json_search'])->name('json-stages');
  Route::post('json/stages/insert', [StageController::class, 'json_store'])->name('json-stages-insert');
  Route::post('json/stages/get', [StageController::class, 'json_get'])->name('json-stages-get');

  Route::get('import-books-from-csv', [BookController::class, 'show_import_from_csv'])->name('import-from-csv');
  Route::post('import-books-from-csv', [BookController::class, 'import_from_csv']);

  Route::get('/papers/index', [ResearchPaperController::class, 'index'])->name('papers');
  Route::get('papers/insert', [ResearchPaperController::class, 'create'])->name('paper-insert');
  Route::post('papers/insert', [ResearchPaperController::class, 'store']);
  Route::get('papers/edit/{paper}', [ResearchPaperController::class, 'edit'])->name('paper-edit');
  Route::post('papers/edit/{paper}', [ResearchPaperController::class, 'update']);

  Route::get('papers/json', [ResearchPaperController::class, 'get_papers_json'])->name('papers-json');

  Route::get('/projects/index', [ProjectController::class, 'index'])->name('projects');
  Route::get('projects/insert', [ProjectController::class, 'create'])->name('project-insert');
  Route::post('projects/insert', [ProjectController::class, 'store']);
  Route::get('projects/edit/{project}', [ProjectController::class, 'edit'])->name('project-edit');
  Route::post('projects/edit/{project}', [ProjectController::class, 'update']);

  Route::get('projects/json', [ProjectController::class, 'get_projects_json'])->name('projects-json');
});

Route::group(['middleware' => ['active.user']], function () {
  Route::get('/books/{book}/content', [BookController::class, 'download'])->name('book-download');

  Route::get('/papers/{paper}/content', [ResearchPaperController::class, 'download'])->name('paper-download');

  Route::get('/projects/{project}/content', [ProjectController::class, 'download'])->name('project-download');
});
