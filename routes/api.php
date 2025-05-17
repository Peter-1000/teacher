<?php

use App\Http\Controllers\Teacher\TeacherClassesScheduleController;
use App\Http\Controllers\Admin\AdminClassesScheduleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\{
    TeacherAuthController,
    AdminAuthController,
};

Route::group([
    'prefix' => 'v1',
], function () {
    Route::post('teacher/login', [TeacherAuthController::class, 'login']);
    Route::post('admin/login', [AdminAuthController::class, 'login']);

    Route::group(['middleware' => ['auth:sanctum', 'checkIsTeacher']], function () {
        Route::resource('classes-schedule', TeacherClassesScheduleController::class);
    });

    Route::group(['middleware' => ['auth:sanctum', 'checkIsAdmin'], 'prefix' => 'admin'], function () {
        Route::resource('classes-schedule', AdminClassesScheduleController::class);
    });
});
