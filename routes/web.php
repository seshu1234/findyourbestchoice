<?php

use Illuminate\Support\Facades\Route;
use Wave\Facades\Wave;
use Wave\Http\Controllers\BlogController;   // <-- FIXED
use App\Http\Controllers\ToolController;

/*
|--------------------------------------------------------------------------
| Wave routes
|--------------------------------------------------------------------------
*/
Wave::routes();

/*
|--------------------------------------------------------------------------
| Public tool submission form
|--------------------------------------------------------------------------
*/
Route::get('/tools/create', [ToolController::class, 'create'])->name('tools.create');
Route::post('/tools', [ToolController::class, 'store'])->name('tools.store');

/*
|--------------------------------------------------------------------------
| AI Tools Directory (Livewire)
|--------------------------------------------------------------------------
*/
use App\Http\Livewire\HomePage;
use App\Http\Livewire\ToolsList;
use App\Http\Livewire\ToolPage;
use App\Http\Livewire\CategoryPage;

Route::get('/', HomePage::class)->name('home');
Route::get('/tools', ToolsList::class)->name('tools.index');
Route::get('/tools/{slug}', ToolPage::class)->name('tools.show');
Route::get('/category/{slug}', CategoryPage::class)->name('category.show');

/*
|--------------------------------------------------------------------------
| Marketing Pages
|--------------------------------------------------------------------------
*/
Route::view('/pricing', 'pricing')->name('pricing'); // Make sure view exists

/*
|--------------------------------------------------------------------------
| Blog Routes (Wave built-in)
|--------------------------------------------------------------------------
*/
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/blog/{slug}', [BlogController::class, 'post'])->name('blog.post');
