<?php

use Illuminate\Support\Facades\Route;

use App\Http\Middleware\InstructorMiddleware;
use App\Http\Middleware\AdminMiddleware;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ForumThreadController;
use App\Http\Controllers\ForumPostController;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserImportController;


Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('/generate', function(){
    \Illuminate\Support\Facades\Artisan::call('storage:link');
    echo 'ok';
 });

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('/close-modal', [HomeController::class, 'closeModal'])->name('modal.close');
// Route::get('/about', [HomeController::class, 'about'])->name('about');

Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create')->middleware(InstructorMiddleware::class);
Route::get('/articles/{id}', [ArticleController::class, 'show'])->name('articles.show');
Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');

Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/unit/{course_id}', [CourseController::class, 'unit'])->name('courses.unit');
Route::get('/courses/unit/{course_id}/material/{unit_id}', [CourseController::class, 'subUnit'])->name('courses.subUnit');
Route::get('/courses/unit/{course_id}/corridor/{unit_id}', [CourseController::class, 'corridor'])->name('courses.corridor');
// Route::get('/courses/unit/{course_id}/subUnit/{unit_id}/question/{sub_unit_id}', [CourseController::class, 'question'])->name('courses.question');
Route::get('/quiz/{subUnitId}/{questionNumber}', [CourseController::class, 'showQuestion'])
->name('quiz')
->where('questionNumber', '[0-9]+'); // Ensures question number is a valid integer

// Route to handle the submission of an answer
Route::post('/quiz/{subUnitId}/{questionNumber}/submit', [CourseController::class, 'submitAnswer'])
->name('submitAnswer')
->where('questionNumber', '[0-9]+'); // Ensures question number is a valid integer

Route::get('/forum/show/{thread_id}', [ForumThreadController::class, 'show'])->name('forum.thread.show');
Route::put('/forum/{thread_id}', [ForumThreadController::class, 'update'])->name('forum.thread.update');
Route::delete('/forum/{thread_id}', [ForumThreadController::class, 'destroy'])->name('forum.thread.destroy');
Route::get('/forum/{course_id}/{unit_id}', [ForumThreadController::class, 'index'])->name('forum.thread.index');
Route::post('/forum/store/{course_id}/{unit_id}', [ForumThreadController::class, 'store'])->name('forum.thread.store');

Route::post('/forum/post/{thread_id}', [ForumPostController::class, 'store'])->name('forum.post.store');
Route::put('/forum/post/{post_id}', [ForumPostController::class, 'update'])->name('forum.post.update');
Route::delete('/forum/post/{post_id}', [ForumPostController::class, 'destroy'])->name('forum.post.destroy');

Route::delete('/assessment/{assessment_id}', [AssessmentController::class, 'destroy'])->name('assessment.destroy');
Route::get('/assessment/show/{assessment_id}', [AssessmentController::class, 'show'])->name('assessment.show');
Route::get('/assessment/score/{assessment_id}', [AssessmentController::class, 'score'])->name('assessment.score');
Route::post('/assessment/saveScore/{assessment_id}', [AssessmentController::class, 'saveScore'])->name('assessment.saveScore');
Route::post('/assessment/store/{course_id}/{unit_id}', [AssessmentController::class, 'store'])->name('assessment.store');
Route::put('/assessment/update/{assessment_id}', [AssessmentController::class, 'update'])->name('assessment.update');
Route::get('/assessment/{course_id}/{unit_id}', [AssessmentController::class, 'index'])->name('assessment.index');

Route::post('/material/store/{course_id}/{unit_id}', [MaterialController::class, 'store'])->name('material.store');
Route::get('/material/show/{material_id}', [MaterialController::class, 'show'])->name('material.show');
Route::get('/material/edit/{material_id}', [MaterialController::class, 'edit'])->name('material.edit');
Route::put('/material/update/{material_id}', [MaterialController::class, 'update'])->name('material.update');
Route::delete('/material/{material_id}', [MaterialController::class, 'destroy'])->name('material.destroy');
Route::get('/material/{course_id}/{unit_id}', [MaterialController::class, 'index'])->name('material.index');

Route::resource('users', UserController::class);
Route::post('/import-users', [UserImportController::class, 'import'])->name('users.import');
