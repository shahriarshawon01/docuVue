<?php
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('web.index');
});
Route::get('/pricing', 'WebController@index');
Route::get('/features', 'WebController@features');
Route::get('/demo_reg', 'WebController@demo');
Route::get('/pricing', function () {
    return view('web.pricing');
});
Route::get('/Registration', 'BranchRegistration@index');
Route::POST('/Branch_registration', 'BranchRegistration@Branch_registration');
// Route::get('/Registration', 'BranchRegistration@index');
// Route::POST('/Branch_registration', 'BranchRegistration@Branch_registration');

// Route::get('/', function () {
//     return view('auth.login');
// });
// Route::get('/Registration', 'BranchRegistration@index');
// Route::POST('/Branch_registration', 'BranchRegistration@Branch_registration')


/* ================== Homepage ================== */
// Route::get('/', 'HomeController@index');
// Route::get('/', 'HomeController@login_form');
Route::get('/register_form', 'HomeController@register_form');

Route::get('/home', 'HomeController@index');
Route::auth();

/* ================== Access Uploaded Files ================== */
Route::get('files/{hash}/{name}', 'LA\UploadsController@get_file');

/*
|--------------------------------------------------------------------------
| Admin Application Routes
|--------------------------------------------------------------------------
*/

$as = "";
if(\Dwij\Laraadmin\Helpers\LAHelper::laravel_ver() == 5.3) {
	$as = config('laraadmin.adminRoute').'.';
	
	// Routes for Laravel 5.3
	Route::get('/logout', 'Auth\LoginController@logout');
}

// Route::group(['as' => $as, 'middleware' => ['auth', 'permission:ADMIN_PANEL']], function () {

Route::group(['as' => $as, 'middleware' => ['auth']], function () {
	
	/* ================== Dashboard ================== */
	
	Route::get(config('laraadmin.adminRoute'), 'LA\DashboardController@index');
	Route::get(config('laraadmin.adminRoute'). '/dashboard', 'LA\DashboardController@index');
	
	/* ================== Users ================== */
	Route::resource(config('laraadmin.adminRoute') . '/users', 'LA\UsersController');
	Route::get(config('laraadmin.adminRoute') . '/user_dt_ajax', 'LA\UsersController@dtajax');
	
	/* ================== Uploads ================== */
	Route::resource(config('laraadmin.adminRoute') . '/uploads', 'LA\UploadsController');
	Route::post(config('laraadmin.adminRoute') . '/upload_files', 'LA\UploadsController@upload_files');
	Route::get(config('laraadmin.adminRoute') . '/uploaded_files', 'LA\UploadsController@uploaded_files');
	Route::post(config('laraadmin.adminRoute') . '/uploads_update_caption', 'LA\UploadsController@update_caption');
	Route::post(config('laraadmin.adminRoute') . '/uploads_update_filename', 'LA\UploadsController@update_filename');
	Route::post(config('laraadmin.adminRoute') . '/uploads_update_public', 'LA\UploadsController@update_public');
	Route::post(config('laraadmin.adminRoute') . '/uploads_delete_file', 'LA\UploadsController@delete_file');
	
	/* ================== Roles ================== */
	Route::resource(config('laraadmin.adminRoute') . '/roles', 'LA\RolesController');
	Route::get(config('laraadmin.adminRoute') . '/role_dt_ajax', 'LA\RolesController@dtajax');
	Route::post(config('laraadmin.adminRoute') . '/save_module_role_permissions/{id}', 'LA\RolesController@save_module_role_permissions');
	
	/* ================== Permissions ================== */
	Route::resource(config('laraadmin.adminRoute') . '/permissions', 'LA\PermissionsController');
	Route::get(config('laraadmin.adminRoute') . '/permission_dt_ajax', 'LA\PermissionsController@dtajax');
	Route::post(config('laraadmin.adminRoute') . '/save_permissions/{id}', 'LA\PermissionsController@save_permissions');
	
	/* ================== Departments ================== */
	Route::resource(config('laraadmin.adminRoute') . '/departments', 'LA\DepartmentsController');
	Route::get(config('laraadmin.adminRoute') . '/department_dt_ajax', 'LA\DepartmentsController@dtajax');
	
	/* ================== Employees ================== */
	Route::resource(config('laraadmin.adminRoute') . '/employees', 'LA\EmployeesController');
	Route::get(config('laraadmin.adminRoute') . '/employee_dt_ajax', 'LA\EmployeesController@dtajax');
	Route::post(config('laraadmin.adminRoute') . '/change_password/{id}', 'LA\EmployeesController@change_password');
	
	/* ================== Organizations ================== */
	Route::resource(config('laraadmin.adminRoute') . '/organizations', 'LA\OrganizationsController');
	Route::get(config('laraadmin.adminRoute') . '/organization_dt_ajax', 'LA\OrganizationsController@dtajax');

	/* ================== Backups ================== */
	Route::resource(config('laraadmin.adminRoute') . '/backups', 'LA\BackupsController');
	Route::get(config('laraadmin.adminRoute') . '/backup_dt_ajax', 'LA\BackupsController@dtajax');
	Route::post(config('laraadmin.adminRoute') . '/create_backup_ajax', 'LA\BackupsController@create_backup_ajax');
	Route::get(config('laraadmin.adminRoute') . '/downloadBackup/{id}', 'LA\BackupsController@downloadBackup');

	/* ================== Document_Managements ================== */
	Route::resource(config('laraadmin.adminRoute') . '/document_managements', 'LA\Document_ManagementsController');
	Route::get(config('laraadmin.adminRoute') . '/document_management_dt_ajax', 'LA\Document_ManagementsController@dtajax');

	/* ================== Document_Manages ================== */
	Route::resource(config('laraadmin.adminRoute') . '/document_manages', 'LA\Document_ManagesController');
	Route::get(config('laraadmin.adminRoute') . '/document_manage_dt_ajax', 'LA\Document_ManagesController@dtajax');

	/* ================== Document_Manages ================== */
	Route::resource(config('laraadmin.adminRoute') . '/document_manages', 'LA\Document_ManagesController');
	Route::get(config('laraadmin.adminRoute') . '/document_manage_dt_ajax', 'LA\Document_ManagesController@dtajax');
	Route::get(config('laraadmin.adminRoute') . '/add_new_document', 'LA\Document_ManagesController@add_new_document');

	/* ================== Add_Project_Titles ================== */
	Route::resource(config('laraadmin.adminRoute') . '/add_project_titles', 'LA\Add_Project_TitlesController');
	Route::get(config('laraadmin.adminRoute') . '/add_project_title_dt_ajax', 'LA\Add_Project_TitlesController@dtajax');

	/* ================== Settings ================== */
	Route::resource(config('laraadmin.adminRoute') . '/settings', 'LA\SettingsController');
	Route::get(config('laraadmin.adminRoute') . '/setting_dt_ajax', 'LA\SettingsController@dtajax');
});
