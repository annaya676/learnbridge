<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\FrontController;

//Front
Route::get("/", [UserController::class, 'dashboard'])->name('user.home')->middleware('auth');
Route::get("/about", [FrontController::class, 'about'])->name('about');


// User
Route::middleware('auth')->group( function(){
    Route::get('/pdf/preview/{filename}', [UserController::class, 'previewPDF'])->name('file.preview.pdf');
    Route::get('/video/preview/{filename}', [UserController::class, 'previewVideo'])->name('file.preview.video');

    Route::get("/dashboard", [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::get("/course/{id}", [UserController::class, 'courses'])->name('user.courses');
    Route::get("/course/details/{id}", [UserController::class, 'course'])->name('user.course');
    
    Route::get("/course/details/{id1}/{slug}/{id2}", [UserController::class, 'course'])->name('user.course.module');
 
    Route::get("/course/assignments/download/{id}", [UserController::class, 'assignments_download'])->name('user.assignments.download');
    Route::get("/course/assignments/{id}", [UserController::class, 'assignments'])->name('user.assignments');
    Route::post("/course/assignments/upload/{id}", [UserController::class, 'assignments_upload'])->name('user.assignments.upload');
  
    Route::get('course/quiz/{courseId}', [UserController::class, 'showQuiz'])->name('quiz.index');
    Route::get('course/quiz/{courseId}/{questionindex}', [UserController::class, 'showQuestion'])->name('quiz.question');
    Route::post('quiz/{courseId}/{questionId}', [UserController::class, 'storeAnswer'])->name('quiz.answer');
    Route::get('quiz/result/{courseId}', [UserController::class, 'showResult'])->name('quiz.result');
    Route::get('quiz/{courseId}/retake', [UserController::class, 'retakeQuiz'])->name('quiz.retake');

    Route::post('/pdf-status/{id1}/{id2}', [UserController::class, 'updatePdfReadStatus'])->name('pdf.status');
    Route::post('/video-status/{id1}/{id2}', [UserController::class, 'updateVideoReadStatus'])->name('video.status');

});

Route::get("/login", [AuthController::class, 'loginshow'])->name('login');
Route::post("/login", [AuthController::class, 'login'])->name('login.submit');
Route::get("/logout", [AuthController::class, 'logout'])->name('logout');



require __DIR__.'/admin.php';