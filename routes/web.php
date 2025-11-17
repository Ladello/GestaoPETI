<?php

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ActivityController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CanvasController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ObjectiveController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\PrincipleController;
use App\Http\Controllers\ArchitectureUploadController;
use App\Http\Controllers\DashboardController;


Route::middleware('auth')->group(function () {

    Route::get('/', function () {
        return redirect()->route('dashboard');
    });

    // dashboard principal
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


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

    // principles (crud)
    Route::resource('principles', PrincipleController::class);

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

    // uploads de arquitetura (crud)
    Route::get('architecture', [ArchitectureUploadController::class, 'index'])->name('architecture.index');
    Route::get('architecture/create', [ArchitectureUploadController::class, 'create'])->name('architecture.create');
    Route::post('architecture', [ArchitectureUploadController::class, 'store'])->name('architecture.store');
    Route::get('architecture/{architecture}', [ArchitectureUploadController::class, 'show'])->name('architecture.show');
    Route::get('architecture/{architecture}/download', [ArchitectureUploadController::class, 'download'])->name('architecture.download');
    Route::delete('architecture/{architecture}', [ArchitectureUploadController::class, 'destroy'])->name('architecture.destroy');

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

