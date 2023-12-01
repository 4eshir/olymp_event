<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ChildrenEventController;



Route::get(
    'childrenEvent/index/{id}',
    [ChildrenEventController::class, 'show']
)->name('api.childrenEvent.show');

Route::get(
    'childrenEvent/all',
    [ChildrenEventController::class, 'showAllEvents']
)->name('api.childrenEvent.showAllEvents');

Route::get(
    'childrenEvent/subject/{subject}',
    [ChildrenEventController::class, 'showEventsforSubject']
)->name('api.childrenEvent.showEventsforSubject');

Route::get(
    'childrenEvent/integrityСheck',
    [ChildrenEventController::class, 'integrityСheck']
)->name('api.childrenEvent.integrityСheck');

Route::get(
    'childrenEvent/class/showEventsforClass',
    [ChildrenEventController::class, 'showEventsforClass']
)->name('api.childrenEvent.showEventsforClass');
