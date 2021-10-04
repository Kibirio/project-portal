<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProposeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SupervisorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [LoginController::class, 'index'])->name('login');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);
Route::get('/propose-project', [ProposeController::class, 'index']);
Route::post('/propose-project', [ProposeController::class, 'store'])->name('propose');
Route::put('/fix-presentation', [ProposeController::class, 'fixPresentation'])->name('fixpresentation');  // Fix time to present project
Route::get('/presentation-list', [ProposeController::class, 'getPresentations']); // Fetch presentation details
Route::put('/presentation-list/award-project', [ProposeController::class, 'awardProject'])->name('award'); // Insert Score to db
Route::get('/projects-marks', [ProposeController::class, 'getMarks'])->name('getmarks'); // Insert Score to db
Route::get('/all-projects', [ProposeController::class, 'index'])->name('allprojects'); // Fetch all submitted projects

Route::get('/student-profile', [StudentController::class, 'profile'])->name('studentprofile');
Route::put('/student-profile', [StudentController::class, 'updateProfile'])->name('student.updateprofile');
Route::get('/student-dashboard', [StudentController::class, 'index'])->name('student1.dashboard'); // Fe
Route::get('/student-projects', [StudentController::class, 'projects'])->name('student.projects'); // Fetch all projects submitted
Route::get('/students-list', [StudentController::class, 'allStudents'])->name('student.allstudents'); // Fetch all students in school

// Admin Actions
Route::get('/admin-dashboard', [DashboardController::class, 'admin'])->name('admin');
Route::get('/admin-dashboard/projects', [DashboardController::class, 'projects'])->name('admin.projects');
Route::get('/admin-dashboard/pending', [DashboardController::class, 'pending'])->name('admin.pending');
Route::get('/admin-dashboard/approved', [DashboardController::class, 'approved'])->name('admin.approved');
Route::get('/admin-dashboard/cancelled', [DashboardController::class, 'cancelled'])->name('admin.cancelled');
Route::get('/admin-dashboard/students-list', [DashboardController::class, 'list'])->name('admin.list');

Route::get('/@root/scihub', [RegisterController::class, 'root'])->name('root');
Route::post('/@root/scihub', [RegisterController::class, 'createRoot'])->name('root.register');


Route::post('/supervisors', [SupervisorController::class, 'store'])->name('supervisors.store');
Route::get('/admin-dashboard/supervisors-list', [SupervisorController::class, 'supervisors'])->name('supervisors.supervisors'); // Fetch all supervisors 
Route::put('/supervisors', [SupervisorController::class, 'update'])->name('supervisors.update');
Route::get('/supervisors-assignment', [SupervisorController::class, 'assign'])->name('supervisors.assign'); // Automatically assign students route
Route::get('/supervisors-assignment-list', [SupervisorController::class, 'assignmentList'])->name('supervisors.assignmentList'); // Route to assignment  list
Route::get('/supervisors-student-list', [SupervisorController::class, 'studentsForSupervisor'])->name('supervisors.studentList'); // Route to assignment  list



// Route::group(['middleware' => ['auth']], function() {
    // Route::resource('roles', App\Http\Controllers\RoleController::class);
    // Route::resource('users', App\Http\Controllers\UserController::class);
    // Route::resource('projects', App\Http\Controllers\ProjectController::class);
// });

Route::get('{path}', [App\Http\Controllers\HomeController::class, 'index'])->where('path', '([A-z\d\-\/_.]+)?');