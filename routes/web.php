<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\ProfileController;
use App\Models\Category;
use App\Models\Events;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $usersData = User::with('roles')->get();
    $organizatorsData = User::role('organisator')->get();
    $bannedUsers = User::role('banned')->get();
    $categories = Category::all();
    $events = Events::all();

    $currentUser = Auth::user();

    $users = count(User::withCount('roles')->has('roles', 0)->get());
    $organizators = count($organizatorsData);


    return view('dashboard', compact('users', 'organizators', 'usersData', 'organizatorsData', 'categories', 'events', 'currentUser'));
})->middleware(['checkBan', 'auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/dashboard', [AdminController::class, 'ban'])->name('ban.user');
    Route::get('/categories', [CategoriesController::class, 'show'])->name('show.categories');
    Route::post('/categories', [CategoriesController::class, 'create'])->name('create.category');
    Route::post('/categories/edit', [CategoriesController::class, 'edit'])->name('edit.category');
    Route::post('/categories/delete', [CategoriesController::class, 'delete'])->name('delete.category');
    Route::post('/dashboard/addevent', [EventsController::class, 'create'])->name('create.event');
    Route::post('/dashboard/deleteEvent', [EventsController::class, 'delete'])->name('delete.event');
});


require __DIR__.'/auth.php';
