<?php

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ActivityController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CanvasController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ObjectiveController;
use App\Http\Controllers\GoalController;

Route::middleware('auth')->group(function () {

    Route::get('/', function () {
        return redirect()->route('projects.index');
    });

    // projects (crud)
    Route::resource('projects', ProjectController::class);

    // activities (nested + shallow)
    Route::resource('projects.activities', ActivityController::class)->shallow();

    // services (crud)
    Route::resource('services', ServiceController::class);

    // objectives (crud)
    Route::resource('objectives', ObjectiveController::class);

    // goals nested em objectives (shallow)
    Route::resource('objectives.goals', GoalController::class)->shallow();

    // canvas (crud)
    Route::resource('canvas', CanvasController::class)
        ->only(['index','create','store','edit','update','destroy'])
        ->parameters(['canvas' => 'canvas']);

    // exportar canvas para pdf
    Route::get('canvas/pdf', [CanvasController::class, 'exportPdf'])->name('canvas.pdf')->middleware('auth');

    // mudança rápida de status em projetos
    Route::post('projects/{project}/status', 
        [ProjectController::class, 'changeStatus']
    )->name('projects.changeStatus');

    // mudança rápida de status em atividades
    Route::post('activities/{activity}/status', 
        [ActivityController::class, 'changeStatus']
    )->name('activities.changeStatus');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function () {
    $credentials = request()->only('email', 'password');

    if (Auth::attempt($credentials)) {
        return redirect()->route('projects.index');
    }

    return back()->withErrors(['email' => 'Login inválido']);
});

Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');

