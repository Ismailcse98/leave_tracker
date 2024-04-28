<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\LeaveTypeController;
use App\Http\Controllers\Admin\LeaveApplicationController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeApplicationController;

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




Route::middleware(['auth','IsUser'])->group(function () {

    Route::get('/', [EmployeeController::class, 'index'])->name('dashboard');
    Route::resource('employee-leave-application', EmployeeApplicationController::class);
    Route::get('/employee/leave-approved-list', [EmployeeApplicationController::class, 'approvedList'])->name('employee.leave-approve-list');
    Route::get('/employee/leave-rejected-list', [EmployeeApplicationController::class, 'rejectedList'])->name('employee.leave-reject-list');

});




Route::middleware(['auth','IsAdmin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    Route::get('/admin/employee-list', [AdminController::class, 'employeeList'])->name('admin.employee_list');
    Route::post('/admin/employee-active/{id}', [AdminController::class, 'activeNow'])->name('employee.activeNow');
    Route::post('/admin/employee-inactive/{id}', [AdminController::class, 'inactiveNow'])->name('employee.inactiveNow');


    Route::resource('leave-type', LeaveTypeController::class);
    Route::post('leave-type/leavetype-active/{id}', [LeaveTypeController::class, 'activeNow'])->name('leavetype.activeNow');
    Route::post('leave-type/leavetype-inactive/{id}', [LeaveTypeController::class, 'inactiveNow'])->name('leavetype.inactiveNow');

    Route::resource('leave-application', LeaveApplicationController::class);
    Route::get('/admin/leave-approved-list', [LeaveApplicationController::class, 'approvedList'])->name('admin.leave-approve-list');
    Route::get('/admin/leave-rejected-list', [LeaveApplicationController::class, 'rejectedList'])->name('admin.leave-reject-list');
    
});


require __DIR__.'/auth.php';
