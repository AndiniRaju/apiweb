<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\RfidController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ReportController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function() {
    Route::get('/',DashboardController::class)->name('home');

    Route::resource('departments', DepartmentController::class)->except('show');
    Route::get('departments/ajax/datatable', [DepartmentController::class, 'datatable'])->name('departments.ajax.datatable');

    Route::resource('positions', PositionController::class)->except('show');
    Route::get('positions/ajax/datatable', [PositionController::class, 'datatable'])->name('positions.ajax.datatable');

    Route::resource('rfids', RfidController::class)->only(['index', 'destroy']);
    Route::get('rfids/ajax/datatable', [RfidController::class, 'datatable'])->name('rfids.ajax.datatable');
    
    Route::resource('staff', StaffController::class);
    Route::get('staff/ajax/datatable', [StaffController::class, 'datatable'])->name('staff.ajax.datatable');
    
    Route::resource('devices', DeviceController::class)->except('show');
    Route::get('devices/ajax/datatable', [DeviceController::class, 'datatable'])->name('devices.ajax.datatable');

    Route::resource('roles', RoleController::class)->except('show');
    Route::get('roles/ajax/datatable', [RoleController::class, 'datatable'])->name('roles.ajax.datatable');

    Route::resource('users', UserController::class)->except('show');
    Route::get('users/ajax/datatable', [UserController::class, 'datatable'])->name('users.ajax.datatable');

    Route::resource('presences', PresenceController::class)->only('index');
    Route::get('presences/ajax/datatable', [PresenceController::class, 'datatable'])->name('presences.ajax.datatable');

    Route::resource('settings', SettingController::class)->only(['index', 'store']);

    Route::get('reports/date', [ReportController::class, 'reportDate'])->name('reports.date');
    Route::get('reports/date/ajax/datatable', [ReportController::class, 'reportDateDatatable'])->name('reports.date.ajax.datatable');
    Route::get('reports/date/export', [ReportController::class, 'reportDateExport'])->name('reports.date.export');
    
    Route::get('reports/staff', [ReportController::class, 'reportStaff'])->name('reports.staff');
    Route::get('reports/staff/ajax/datatable', [ReportController::class, 'staffDatatable'])->name('reports.staff.ajax.datatable');
    Route::get('reports/staff/{id}/presences', [ReportController::class, 'StaffPresence'])->name('reports.staff.presences');
    Route::get('reports/staff/{id}/presences/ajax/datatable', [ReportController::class, 'staffPresenceDatatable'])->name('reports.staff.presences.ajax.datatable');
    Route::get('reports/staff/{id}/presences/export', [ReportController::class, 'reportStaffExport'])->name('reports.staff.export');
});

