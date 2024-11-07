<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\LobController;
use App\Http\Controllers\Admin\SmeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\AssignmentController;
use App\Http\Controllers\Admin\TaController;
use App\Http\Controllers\Admin\ReportsController;
use App\Http\Controllers\Admin\CategoryController;

////Admin
Route::prefix('admin')->group( function(){

    Route::get("/login", [AuthController::class, 'loginshow'])->name('admin.login');
    Route::post("/login", [AuthController::class, 'login'])->name('admin.login.submit');
    Route::get("/logout", [AuthController::class, 'logout'])->name('admin.logout');
    Route::get("/forgot", [AuthController::class, 'forgotshow'])->name('admin.forgot');
    Route::post("/forgot", [AuthController::class, 'forgot'])->name('admin.forgot.submit');
    Route::get("/reset/{token}/{email}", [AuthController::class, 'resetshow'])->name('admin.reset');
    Route::post("/reset/{token}/{email}", [AuthController::class, 'reset'])->name('admin.reset.submit');

});

Route::middleware(['admin', 'role:1'])->prefix('admin')->group( function(){
   
    Route::get('/pdf/preview/{filename}', [DashboardController::class, 'previewPDF'])->name('admin.file.preview.pdf');
    Route::get('/video/preview/{filename}', [DashboardController::class, 'previewVideo'])->name('admin.file.preview.video');

    Route::get("/", [DashboardController::class, 'dashboard'])->name('home');
    Route::get("/dashboard", [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get("/profile", [DashboardController::class, 'profile'])->name('profile');
    Route::get("/profile/{slug}", [DashboardController::class, 'profile'])->name('profile.changepassword');
    Route::post("/profile", [DashboardController::class, 'profileupdate'])->name('profile.submit');
    Route::post("/profile/password/update", [DashboardController::class, 'updatepassword'])->name('profile.updatepassword');
  
    Route::get('/lob', [LobController::class, 'index'])->name('lob');
    Route::get("/lob/datatables", [LobController::class, 'datatables'])->name('lob.datatables');
    Route::get('/lob/create', [LobController::class, 'create'])->name('lob.create'); 
    Route::post('/lob', [LobController::class, 'store'])->name('lob.store'); 
    Route::get('/lob/{id}/edit', [LobController::class, 'edit'])->name('lob.edit'); 
    Route::put('/lob/{id}', [LobController::class, 'update'])->name('lob.update'); 
    Route::get('/lob/status/update/{id1}/{id2}', [LobController::class, 'updateStatus'])->name('lob.status.update');
    
    Route::get('/sme', [SmeController::class, 'index'])->name('sme');
    Route::get("/sme/datatables", [SmeController::class, 'datatables'])->name('sme.datatables');
    Route::get('/sme/create', [SmeController::class, 'create'])->name('sme.create'); 
    Route::post('/sme', [SmeController::class, 'store'])->name('sme.store'); 
    Route::get('/sme/{id}/edit', [SmeController::class, 'edit'])->name('sme.edit'); 
    Route::put('/sme/{id}', [SmeController::class, 'update'])->name('sme.update'); 
    Route::get('/sme/status/update/{id1}/{id2}', [SmeController::class, 'updateStatus'])->name('sme.status.update');
    Route::get('/sme/{id}/changepassword', [SmeController::class, 'changepassword'])->name('sme.changepassword'); 
    Route::put('/sme/{id}/updatepassword', [SmeController::class, 'updatepassword'])->name('sme.updatepassword'); 
   
    Route::get('/admin/list', [AdminController::class, 'index'])->name('admin.list');
    Route::get("/admin/datatables", [AdminController::class, 'datatables'])->name('admin.datatables');
    Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create'); 
    Route::post('/admin/store', [AdminController::class, 'store'])->name('admin.store'); 
    Route::get('/admin/{id}/edit', [AdminController::class, 'edit'])->name('admin.edit'); 
    Route::put('/admin/{id}', [AdminController::class, 'update'])->name('admin.update'); 
    Route::get('/admin/status/update/{id1}/{id2}', [AdminController::class, 'updateStatus'])->name('admin.status.update');
    Route::get('/admin/{id}/changepassword', [AdminController::class, 'changepassword'])->name('admin.changepassword'); 
    Route::put('/admin/{id}/updatepassword', [AdminController::class, 'updatepassword'])->name('admin.updatepassword'); 
   
   
    Route::get('/course/list', [CourseController::class, 'index'])->name('course');
    Route::get("/course/datatables", [CourseController::class, 'datatables'])->name('course.datatables');
    Route::get('/course/create', [CourseController::class, 'create'])->name('course.create'); 
    Route::post('/course/store', [CourseController::class, 'store'])->name('course.store'); 
    Route::get('/course/{id}/edit', [CourseController::class, 'edit'])->name('course.edit'); 
    Route::post('/course/{id}/update', [CourseController::class, 'update'])->name('course.update'); 
    Route::get('/course/status/update/{id1}/{id2}', [CourseController::class, 'updateStatus'])->name('course.status.update');
   
    Route::get("/course/{id}/quizdatatables", [CourseController::class, 'quiz_datatables'])->name('course.quiz.datatables');
    Route::get('/course/{id}/quiz', [CourseController::class, 'quiz'])->name('course.quiz'); 
    Route::post('/course/{id}/quiz', [CourseController::class, 'importQuizCsv'])->name('course.importquizcsv'); 
    Route::get('/course/editquiz', [CourseController::class, 'editQuiz'])->name('course.editquiz'); 
    Route::post('/course/updatequiz', [CourseController::class, 'quizupdate'])->name('course.updatequiz'); 
    
    Route::get('/course/{id}/module', [CourseController::class, 'module'])->name('course.module'); 
    Route::get('/course/module/{id}/create', [CourseController::class, 'create_module'])->name('course.module.create'); 
    Route::get("/course/{id}/moduledatatables", [CourseController::class, 'module_datatables'])->name('course.module.datatables');
    Route::post('/course/{id}/module', [CourseController::class, 'modulestore'])->name('course.modulestore'); 
    Route::get('/course/edit/module/{id1}/{id2}', [CourseController::class, 'editmodule'])->name('course.editmodule'); 
    Route::post('/course/{id}/updatemodule', [CourseController::class, 'moduleupdate'])->name('course.updatemodule'); 

    Route::get('/ta', [TaController::class, 'index'])->name('ta');
    Route::get("/ta/datatables", [TaController::class, 'datatables'])->name('ta.datatables');
    Route::get('/ta/create', [TaController::class, 'create'])->name('ta.create'); 
    Route::post('/ta', [TaController::class, 'store'])->name('ta.store'); 
    Route::get('/ta/{id}/edit', [TaController::class, 'edit'])->name('ta.edit'); 
    Route::put('/ta/{id}', [TaController::class, 'update'])->name('ta.update'); 
    Route::get('/ta/status/update/{id1}/{id2}', [TaController::class, 'updateStatus'])->name('ta.status.update');
    Route::get('/ta/{id}/changepassword', [TaController::class, 'changepassword'])->name('ta.changepassword'); 
    Route::put('/ta/{id}/updatepassword', [TaController::class, 'updatepassword'])->name('ta.updatepassword'); 
   
    Route::post("/reports/assignment/export", [ReportsController::class, 'assignmentExport'])->name('reports.assignment.export');
    Route::get("/reports/assignment/datatables", [ReportsController::class, 'assignmentDatatables'])->name('reports.assignment.datatables');
    Route::get("/reports/assignment/", [ReportsController::class, 'assignment'])->name('reports.assignment');

    Route::post("/reports/course/completion/export", [ReportsController::class, 'courseCompletionExport'])->name('reports.course.completion.export');
    Route::get("/reports/course/completion/datatables", [ReportsController::class, 'courseCompletionDatatables'])->name('reports.course.completion.datatables');
    Route::get("/reports/course/completion", [ReportsController::class, 'courseCompletion'])->name('reports.course.completion');

    Route::post("/reports/user/details/export", [ReportsController::class, 'userDetailsExport'])->name('reports.user.details.export');
    Route::get("/reports/user/details/datatables", [ReportsController::class, 'userDetailsDatatables'])->name('reports.user.details.datatables');
    Route::get("/reports/user/details", [ReportsController::class, 'userDetails'])->name('reports.user.details');

    Route::post("/reports/course/catalogue/export", [ReportsController::class, 'courseCatalogueExport'])->name('reports.course.catalogue.export');
    Route::get("/reports/course/catalogue/datatables", [ReportsController::class, 'courseCatalogueDatatables'])->name('reports.course.catalogue.datatables');
    Route::get("/reports/course/catalogue", [ReportsController::class, 'courseCatalogue'])->name('reports.course.catalogue');


    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
    Route::get("/categories/datatables", [CategoryController::class, 'datatables'])->name('categories.datatables');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create'); 
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store'); 
    Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit'); 
    Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update'); 
    Route::get('/categories/status/update/{id1}/{id2}', [CategoryController::class, 'updateStatus'])->name('categories.status.update');
    
   
     


});


Route::middleware(['admin', 'role:2'])->prefix('admin')->group( function(){
   
    Route::get('/assignment', [AssignmentController::class, 'index'])->name('assignment');
    Route::get("/assignment/datatables", [AssignmentController::class, 'datatables'])->name('assignment.datatables');
    Route::get('/assignment/{id}/edit', [AssignmentController::class, 'edit'])->name('assignment.edit'); 
    Route::put('/assignment/{id}', [AssignmentController::class, 'update'])->name('assignment.update'); 
    Route::post('/assignment/sme/update/', [AssignmentController::class, 'smeUpdate'])->name('assignment.sme.update');

});


Route::middleware(['admin', 'role:3'])->prefix('admin')->group( function(){
   
    Route::get('/user', [UserController::class, 'index'])->name('user');
    Route::get("/user/datatables", [UserController::class, 'datatables'])->name('user.datatables');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create'); 
    Route::post('/user/store', [UserController::class, 'store'])->name('user.store'); 
    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit'); 
    Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update'); 
    Route::get('/user/status/update/{id1}/{id2}', [UserController::class, 'updateStatus'])->name('user.status.update');
    Route::get('/user/{id}/changepassword', [UserController::class, 'changepassword'])->name('user.changepassword'); 
    Route::put('/user/{id}/updatepassword', [UserController::class, 'updatepassword'])->name('user.updatepassword'); 
    Route::get('/user/bulkupload', [UserController::class, 'bulkUpload'])->name('user.bulkupload'); 
    Route::post('/user/importusercsv', [UserController::class, 'importUserCsv'])->name('user.importusercsv'); 
    Route::get('/user/revoke/{id}', [UserController::class, 'revoke'])->name('user.revoke');
    Route::post("/user/export", [UserController::class, 'exportUser'])->name('user.export');

});