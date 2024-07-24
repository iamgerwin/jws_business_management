<?php

use App\Http\Controllers\Api\TaskListController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Api\BusinessController;

enum TaskableEnum: string {
    case business = 'business';
    case person = 'person';
}


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('categories', CategoryController::class)->name('api.categories.index');
Route::get('tags', TagController::class)->name('api.tags.index');
Route::get('businesses', BusinessController::class)->name('api.businesses.index');
Route::get('task/{type}/{id}', TaskListController::class)->whereIn('type', TaskableEnum::cases())->name('api.tasklist.show');
