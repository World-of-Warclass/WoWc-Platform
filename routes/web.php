<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

Route::get("/", HomeController::class);

Route::view('/register-institution', 'layouts.register.register-institutions')->name('register.institution');

// API endpoints para JSON (sin autenticación para evitar CORS)
Route::get('/character/appearance/{id}', [PlayerController::class, 'get_character_sheet']);
Route::get('/character/ambience/{id}', [PlayerController::class, 'get_ambience']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::middleware('role:user')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    });
});

Route::view('/register-users', 'layouts/register/register-users');
Route::view('/type-users', 'layouts/register/type-users');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::post('/logouts', [LoginController::class, 'logout'])->name('logoutall');

Route::middleware('role:institution')->group(function () {
    Route::get('/institution', [TeacherController::class, 'index'])->name('teachers.index');
    Route::post('/teachers-store', [TeacherController::class, 'store'])->name('teachers.store');
    Route::get('/teachers/delete/{id}', [TeacherController::class, 'destroy'])->name('teachers.destroy');
});

Route::middleware('role:user')->group(function () {
    Route::prefix('main')->group(function () {
        Route::get('/inscription-courses/{token}', [CourseController::class, 'inscriptionCourse'])->name('course.inscription');
        Route::post('/validation-inscription', [InscriptionController::class, 'validation'])->name('validation.inscription');
        Route::get('/help/invitations', function () {
            return view('help.invitations');
        })->name('help.invitations');
        
        Route::prefix('{token}')->group(function () {
            // Rutas para jugadores (players)
            Route::prefix('/player')->controller(PlayerController::class)->group(function () {
                Route::get('/create-character', 'createCharacter')->name('player.create-character');
                Route::get('/character', 'character')->name('player.character');
                Route::get('/groups', 'groups')->name('player.groups');
                Route::get('/members', 'members')->name('player.members');
                Route::get('/tasks', 'tasks')->name('player.tasks');
                Route::get('/quizzes', 'quizzes')->name('player.quizzes');
                Route::post('quizzes/check',[QuizController::class,'check'] )->name('check.quiz');
                Route::get('/quizzes/start', 'quizzes_start')->name('player.quizzes.start');
                Route::get('/quizzes/score', 'score')->name('player.quizzes.score');

                Route::get('/', function (string $token) {
                    return redirect('/main/' . $token . '/player/character');
                })->name('player');
            });
        });
    });
});

// Rutas específicas para masters (separadas del middleware user)
Route::middleware('role:master')->group(function () {
    Route::prefix('main')->group(function () {
        Route::get('/create-courses/{id}', [MasterController::class, 'createCourse'])->name('master.create-courses');
        Route::post('/courses-store', [CourseController::class, 'store'])->name('course.store');
        
        Route::prefix('{token}')->group(function () {
            Route::prefix('/master')->controller(MasterController::class)->group(function () {
                Route::get('/create-invitation', 'createInvitation')->name('invitation.course');
                Route::post('/generate-invitation', 'invitations')->name('invitations.generate');
                Route::get('/invitations', 'listInvitations')->name('master.invitations');
                Route::get('/create-group', 'createGroup')->name('player.create-group');
                Route::get('/groups', 'groups')->name('master.groups');
                Route::get('/members', 'members')->name('master.members');
                Route::get('/tasks', 'tasks')->name('master.tasks');
                Route::get('/quizzes', 'quizzes')->name('master.quizzes');

                Route::get('/', function () {
                    return redirect()->route('master.create-group');
                })->name('master');
            });
        });
    });
});

//test-quizzes
Route::get('/quizzes', [QuizController::class, 'index'])->name('indexquiz');
Route::get('/quizzes/result', [QuizController::class, 'result'])->name('quizzes.score');
Route::post('/quizzes/check', [QuizController::class, 'check'])->name('quizzes.check');
