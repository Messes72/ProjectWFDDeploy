<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\DetailCourseController;
use App\Http\Controllers\PeriodController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\CourseManagementController;
use App\Http\Controllers\Admin\PendaftaranController as AdminPendaftaranController;
use Illuminate\Support\Facades\Auth;

// Route Dashboard
Route::get('/', [AuthController::class, 'viewLogin'])->name('user.login');
Route::get('/dashboard', [CourseController::class, 'dashboard'])->name('dashboard');

// Route Auth
Route::get('/register', [AuthController::class, 'viewRegister'])->name('user.register');
Route::post('/register', [AuthController::class, 'processRegister'])->name('user.register');
Route::get('/login', [AuthController::class, 'viewLogin'])->name('user.login');
Route::post('/login', [AuthController::class, 'processLogin'])->name('user.login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route Profile
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::get('/profile/{id}', [CourseController::class, 'pendaftaran'])->name('pendaftaran');
});

// Admin Routes
Route::prefix('admin')->group(function () {
    // Public Admin Routes
    Route::get('/login', [AdminAuthController::class, 'viewLogin'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'processLogin'])->name('admin.login.post');
    Route::get('/register', [AdminAuthController::class, 'viewRegister'])->name('admin.register');
    Route::post('/register', [AdminAuthController::class, 'processRegister'])->name('admin.register.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');

    
    // Protected Admin Routes (will check role=1 in controller)
    Route::middleware(['auth'])->group(function () {
        Route::get('/dashboard', [AdminAuthController::class, 'dashboard'])->name('admin.dashboard');
        
        // Period Management
        Route::get('/periods', [PeriodController::class, 'index'])->name('periods.index');
        Route::post('/periods', [PeriodController::class, 'store'])->name('periods.store');
        Route::put('/periods/{id}/set-active', [PeriodController::class, 'setActive'])->name('periods.setActive');
        Route::delete('/periods/{id}', [PeriodController::class, 'destroy'])->name('periods.destroy');
        
        // Registration Management
        Route::get('/history', [AdminPendaftaranController::class, 'index'])->name('admin.pendaftaran.index');
        Route::put('/pendaftaran/{pendaftaran}/status', [AdminPendaftaranController::class, 'updateStatus'])
            ->name('admin.pendaftaran.updateStatus');
            
        // Teachers Management
        Route::get('/teachers', [TeacherController::class, 'index'])->name('teachers.index');
        Route::get('/teachers/{id}/details', [TeacherController::class, 'details'])->name('teachers.details');
        Route::get('/teachers/create', [CourseController::class, 'getCoursesForTeachers'])->name('teachers.create');
        Route::get('/teachers/{id}/edit', [TeacherController::class, 'edit'])->name('teachers.edit');
        Route::post('/teachers/store', [TeacherController::class, 'store'])->name('teachers.store');
        Route::put('/teachers/{id}', [TeacherController::class, 'update'])->name('teachers.update');
        Route::delete('/teachers/{id}', [TeacherController::class, 'delete'])->name('teachers.delete');
        
        // Admin Courses Management
        Route::prefix('courses')->group(function () {
            Route::get('/', [CourseController::class, 'index'])->name('admin.courses.index');
            Route::get('/create', [CourseController::class, 'create'])->name('admin.courses.create');
            Route::post('/store', [CourseController::class, 'store'])->name('admin.courses.store');
            Route::get('/{id}/edit', [CourseController::class, 'edit'])->name('admin.courses.edit');
            Route::put('/{id}', [CourseController::class, 'update'])->name('admin.courses.update');
            Route::delete('/{id}', [CourseController::class, 'delete'])->name('admin.courses.delete');
        });
        
        // User Management
        Route::get('/user-management', [UserManagementController::class, 'index'])->name('user-management.index');
        Route::get('/user-management/{id}', [UserManagementController::class, 'show'])->name('user-management.show');

        // Assignments Management
        Route::prefix('assignments')->group(function () {
            Route::get('/', [AssignmentController::class, 'index'])->name('assignments.index');
            Route::get('/create/{id}', [AssignmentController::class, 'create'])->name('assignments.create');
            Route::post('/store', [AssignmentController::class, 'store'])->name('assignments.store');
            Route::get('/{id}/edit', [AssignmentController::class, 'edit'])->name('assignments.edit');
            Route::delete('/{id}', [AssignmentController::class, 'destroy'])->name('assignments.destroy');

        });

        // Course Management
        Route::prefix('course-management')->group(function () {
            Route::get('/', [CourseManagementController::class, 'index'])->name('course-management.index');
            Route::get('/{id}', [CourseManagementController::class, 'show'])->name('course-management.show');
        });
    });
});

// User Protected Routes
Route::middleware(['auth'])->group(function () {
    // Registration Routes
    Route::prefix('pendaftaran')->group(function () {
        Route::get('/{id}', [PendaftaranController::class, 'showRegistrationForm'])->name('pendaftaran.index');
        Route::post('/store', [PendaftaranController::class, 'store'])->name('pendaftaran.store');
        Route::post('/validate-payment', [PendaftaranController::class, 'validatePayment'])->name('pendaftaran.validatePayment');
    });
    
    // History Routes
    Route::get('/history', [UserController::class, 'history'])->name('user.history');
    Route::get('/history-detail/{id}', [UserController::class, 'showHistoryDetail'])->name('history-detail');

    // Submission Routes
    Route::get('/assignments/{id}/submit', [AssignmentController::class, 'showSubmissionForm'])->name('assignments.submit');
    Route::post('/assignments/{id}/submit', [AssignmentController::class, 'submitAssignment'])->name('assignments.submit.store');
});

// Public Routes
// Subjects/Courses Public Routes
Route::prefix('courses')->group(function () {
    Route::get('/', [CourseController::class, 'index'])->name('courses.index');
    Route::get('/create', [CourseController::class, 'create'])->name('courses.create');
    Route::post('/store', [CourseController::class, 'store'])->name('courses.store');
    Route::get('/{id}/details', [CourseController::class, 'details'])->name('courses.details');
    Route::get('/{id}/edit', [CourseController::class, 'edit'])->name('courses.edit');
    Route::put('/{id}', [CourseController::class, 'update'])->name('courses.update');
    Route::delete('/{id}', [CourseController::class, 'delete'])->name('courses.delete');
});

Route::get('/subjects', [CourseController::class, 'subjects'])->name('subjects.index');
Route::get('/subjects/{id}', [CourseController::class, 'details'])->name('subjects.show');

// Lessons Routes
Route::get('/lessons', [LessonController::class, 'index'])->name('lessons.index');
Route::post('/lessons/store', [LessonController::class, 'store'])->name('lessons.store');
Route::get('/lessons/create/{id}', [LessonController::class, 'create'])->name('lessons.create');
Route::middleware(['auth'])->group(function () {
  Route::get('/lessons/create/{id}', [LessonController::class, 'create'])->name('lessons.create');
});
Route::get('/lessons/edit/{id}', [LessonController::class, 'edit'])->name('lessons.edit');
Route::delete('/lessons/{id}', [LessonController::class, 'destroy'])->name('lessons.destroy');