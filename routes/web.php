<?php


use App\Http\Controllers\AssignmentsController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoutineController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\RecipeController;

// Ruta principal
Route::get('/', function () {
    return view('auth.login');
});

// Ruta para el dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rutas de perfil
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index2');

// Rutas protegidas con middleware de autenticación
Route::middleware('auth')->group(function () {

    // Rutas de rutinas
    Route::resource('/routines', RoutineController::class);
    Route::get('routines/download/{id}', [RoutineController::class, 'download'])->name('routines.download');

    // Rutas de usuarios
    Route::patch('/user/{id}', [UserController::class, 'updateRole'])->name('user.updateRole');
    Route::get('/user2', [UserController::class, 'show2'])->name('user.show2');
    Route::resource('/user', UserController::class);

    // Rutas de asignaciones de rutinas
    Route::prefix('assignments')->group(function () {
        Route::get('/routine/{routine_id}', [AssignmentsController::class, 'indexRoutine'])->name('assignments.indexRoutine');
        Route::get('/client/{client_id}', [AssignmentsController::class, 'indexClient'])->name('assignments.indexClient');
        Route::get('/{routine_id?}/{client_id?}', [AssignmentsController::class, 'index'])->name('assignments.index');
        Route::post('/assign', [AssignmentsController::class, 'assign'])->name('assignments.assign');
        Route::get('/{clientId}', [AssignmentsController::class, 'showAssignments'])->name('assignments.show');
        Route::delete('/{id}', [AssignmentsController::class, 'destroyAssignment'])->name('assignments.destroy');
    });

    // Rutas de ejercicios
    Route::prefix('exercises')->group(function () {
        Route::get('/', [ExerciseController::class, 'index'])->name('exercises.index');
        Route::get('/create', [ExerciseController::class, 'create'])->name('exercises.create');
        Route::post('/', [ExerciseController::class, 'store'])->name('exercises.store');
        Route::get('/{id}', [ExerciseController::class, 'show'])->name('exercises.show');
        Route::get('/{id}/edit', [ExerciseController::class, 'edit'])->name('exercises.edit');
        Route::put('/{id}', [ExerciseController::class, 'update'])->name('exercises.update');
        Route::delete('/{id}', [ExerciseController::class, 'destroy'])->name('exercises.destroy');
    });

    // Rutas de perfil del usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    // Rutas de ejercicios
    Route::prefix('recipes')->group(function () {
        Route::get('/', [RecipeController::class, 'index'])->name('recipes.index');
        Route::get('/create', [RecipeController::class, 'create'])->name('recipes.create');
        Route::post('/', [RecipeController::class, 'store'])->name('recipes.store');
        Route::get('/{id}', [RecipeController::class, 'show'])->name('recipes.show');
        Route::get('/{id}/edit', [RecipeController::class, 'edit'])->name('recipes.edit');
        Route::put('/{id}', [RecipeController::class, 'update'])->name('recipes.update');
        Route::delete('/{id}', [RecipeController::class, 'destroy'])->name('recipes.destroy');
    });


    /* // Ruta para mostrar el chat
Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');

// Ruta para enviar mensajes al chat
Route::post('/chat/send', [ChatController::class, 'sendMessage'])->name('chat.send');
  */
});

require __DIR__ . '/auth.php';
