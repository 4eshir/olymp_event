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
    'childrenEvent/subject/{subject_id}',
    [ChildrenEventController::class, 'showEventsforSubject']
)->name('api.childrenEvent.showEventsforSubject');

Route::get(
    'childrenEvent/integrityСheck',
    [ChildrenEventController::class, 'integrityСheck']
)->name('api.childrenEvent.integrityСheck');

Route::get(
    'childrenEvent/showEventsforClass/{class_number}',
    [ChildrenEventController::class, 'showEventsforClass']
)->name('api.childrenEvent.showEventsforClass');

Route::get(
    'childrenEvent/showEventsforSubjectAndClass/{subject_id},{class_number}',
    [ChildrenEventController::class, 'showEventsforSubjectAndClass']
)->name('api.childrenEvent.showEventsforSubjectAndClass');
