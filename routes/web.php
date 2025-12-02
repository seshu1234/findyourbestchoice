<?php

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

use Wave\Facades\Wave;

// Wave routes
Wave::routes();

use App\Http\Controllers\ToolController;

// Public tool submission form
Route::get('/tools/create', [ToolController::class, 'create'])->name('tools.create');
Route::post('/tools', [ToolController::class, 'store'])->name('tools.store');
