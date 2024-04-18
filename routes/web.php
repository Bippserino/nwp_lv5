<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\TeacherMiddleware;
use App\Models\User;
use App\Models\Task;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = auth()->user();
    $role = $user->role;
    if ($role === 'admin') {
        $users = User::all();
        return view('dashboard', compact('role', 'users'));
    }
    elseif ($role === 'teacher') {
        $tasks = $user->tasks;
        return view('dashboard', compact('role', 'tasks'));
    }
    else {
        $tasks = Task::availableTasks();
        return view('dashboard', compact('role', 'tasks'));
    }
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin routs
Route::get('/admin/{id}/edit', [AdminController::class, 'edit'])->middleware(AdminMiddleware::class)->name('admin.edit');
Route::put('/admin/{id}', [AdminController::class, 'update'])->middleware(AdminMiddleware::class)->name('admin.update');

// Task related routs
Route::get('dashboard/tasks/create', [TaskController::class, 'create'])->middleware(TeacherMiddleware::class)->name('tasks.create');
Route::post('dashboard/tasks/create', [TaskController::class, 'store'])->middleware(TeacherMiddleware::class)->name('tasks.store');
Route::get('/dashboard/edit/{id}', [TaskController::class, 'edit'])->name('task.edit');
Route::put('/dashboard/update/{id}', [TaskController::class, 'update'])->name('task.update');
Route::delete('/dashboard/delete/{id}', [TaskController::class, 'destroy'])->name('task.destroy');
Route::post('/apply/{id}', [TaskController::class, 'apply'])->name('task.apply');
Route::post('/confirm', [TaskController::class, 'acceptStudent'])->name('confirm.student');

Route::get('language/{language}', [LanguageController::class, 'change'])->name('language.change');



require __DIR__.'/auth.php';
