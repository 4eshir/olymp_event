<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ChildrenEventController;

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

//Route::get('/subject', [SubjectController::class, 'showAll']);

/*Route::get('show/{id}', [ChildrenEventController::class, 'show']);
Route::get('show', [ChildrenEventController::class, 'showAllEvents']);
Route::get('showSubject/{subject}', [ChildrenEventController::class, 'showEventsforSubject']);
Route::get('integrityСheck', [ChildrenEventController::class, 'integrityСheck']);*/
