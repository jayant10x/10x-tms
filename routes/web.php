<?php

use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\MyProfileController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectTaskController;
use App\Http\Controllers\TeamMembersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthenticationController::class, 'login'])
        ->name('login');

    Route::post('/login', [AuthenticationController::class, 'authenticate'])
        ->name('login.authenticate');

});

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/sub-department/{department}', [AjaxController::class, 'getSubDepartments'])->name('sub_department_by_department');
    Route::get('/employees-reporting-to', [AjaxController::class, 'getReportingToEmployees'])->name('reporting_to_employees');
    Route::get('/show-modal-popup/add-edit', [AjaxController::class, 'getAddEditPopUpForms']);
    Route::get('/show-modal-popup/view', [AjaxController::class, 'getViewPopUpsPage']);

    Route::get('/notifications/{notification}/handle', [NotificationController::class, 'handle']
    )->name('notifications.handle');
    Route::post('/notifications/{notification}/read', [NotificationController::class, 'read'])->name('notifications.read');
    Route::post('/notifications/read-all', [NotificationController::class, 'readAll'])->name('notifications.readAll');

    Route::post('/admin-user/save/{emp_id}', [AdminUserController::class, 'store'])->name('admin_user.save');
    Route::put('/admin-user/update/{adm_id}', [AdminUserController::class, 'update'])->name('admin_user.update');

    Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.list');
    Route::get('employees/add', [EmployeeController::class, 'add'])->name('employees.add');
    Route::post('employees/save', [EmployeeController::class, 'store'])->name('employees.save');
    Route::get('employees/view/{emp_id}', [EmployeeController::class, 'view'])->name('employees.view');
    Route::get('employees/edit/{emp_id}', [EmployeeController::class, 'edit'])->name('employees.edit');
    Route::put('employees/update/{emp_id}', [EmployeeController::class, 'update'])->name('employees.update');

    Route::get('/my-profile', [MyProfileController::class, 'viewProfile'])->name('my_profile');
    Route::get('/my-profile/edit', [MyProfileController::class, 'editProfile'])->name('my_profile.edit');
    Route::put('/my-profile/update/personal-info', [MyProfileController::class, 'updateProfilePersonalInfo'])->name('my_profile.update.personal_info');
    Route::put('/my-profile/update/credentials-info', [MyProfileController::class, 'updateProfileCredentials'])->name('my_profile.update.credentials');
    Route::get('/logout', [AuthenticationController::class, 'logout'])->name('logout');

    Route::get('admin-users', [AdminUserController::class, 'allAdminUsers'])->name('admin_user_module.list');
    Route::get('admin-user/add', [AdminUserController::class, 'addAdmin'])->name('admin_user_module.add');
    Route::post('admin-user/store', [AdminUserController::class, 'saveAdmin'])->name('admin_user_module.store');
    Route::get('admin-user/edit/{adm_id}', [AdminUserController::class, 'editAdmin'])->name('admin_user_module.edit');
    Route::put('admin-user/update-admin/{adm_id}', [AdminUserController::class, 'updateAdmin'])->name('admin_user_module.update');
    Route::get('admin-user/view-admin/{adm_id}', [AdminUserController::class, 'viewAdmin'])->name('admin_user_module.view');

    Route::get('team-members', [TeamMembersController::class, 'index'])->name('team_members.list');
    Route::get('team-member/view/{called_from}/{member_id}/{pro_id?}', [TeamMembersController::class, 'viewTeamMember'])->name('team_member.view');

    Route::get('projects/', [ProjectController::class, 'index'])->name('projects.list');
    Route::get('projects/add', [ProjectController::class, 'addProject'])->name('projects.add');
    Route::post('projects/save', [ProjectController::class, 'saveProject'])->name('projects.save');
    Route::get('projects/view/{pro_id}', [ProjectController::class, 'viewProject'])->name('project.view');


    Route::post('task/create', [ProjectTaskController::class, 'store'])->name('task.create');
});
