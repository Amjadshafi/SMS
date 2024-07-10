<?php

use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\ComplaintsController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\RolesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrganizationsController;
use App\Http\Controllers\Auth\UserLoginRegisterController;
use App\Http\Controllers\ComplaintUsersController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CommitteeController;


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

Route::delete('/complaints/{id}', 'ComplaintController@destroy')->name('complaints.destroy');

Route::get('/newForm', function () {
    return view("users.userdashboard");
});
// Route::view('/form', 'users.userform')->name('users.userform');
// Route::Post('/form', [RolesController::class,'userform'])->name('users.userform');

Route::group(['namespace' => 'App\Http\Controllers'], function () {

    /**
     * Home Routes
     */
    // Route::get('/', 'HomeController@index')->name('home.index');
    // Route::get('/', 'LoginRegisterController@dashboard')->name('home.index');

    Route::get('/', function () {

        return view('welcome');
    });

    Route::controller(ComplaintsController::class)->group(function () {
        Route::get('/complaint', 'createComplaint')->name('createComplaint');
        Route::post('/complaint', 'storecomplaint')->name('storecomplaint');
    });

    Route::controller(LoginRegisterController::class)->group(function () {


        Route::get('/login', 'login')->name('login');
        Route::post('/authenticate', 'authenticate')->name('authenticate');

        Route::post('/language/change', 'changeLanguage')->name('lang.change');
    });


    Route::get('language/{locale}', function ($locale) {
        session(['locale' => $locale]); // Store locale in session
        App::setLocale($locale);
        return redirect()->back();
    })->name('language');

    /**
     * Register Routes
     */
    // Route::get('/register', 'RegisterController@show')->name('register.show');
    // Route::post('/register', 'RegisterController@register')->name('register.perform');

    /**
     * Login Routes
     */
    // Route::get('/login', 'LoginController@show')->name('login.show');
    // Route::post('/login', 'LoginController@login')->name('login.perform');


    Route::group(['middleware' => 'auth'], function () {
        Route::controller(LoginRegisterController::class)->group(function () {
            Route::post('/store', 'store')->name('register.perform');
            Route::post('/logout', 'logout')->name('logout.perform');
        });
        /**
         * User Routes
         */
        Route::group(['prefix' => 'users'], function () {
            Route::post('/create', 'UsersController@store')->name('users.store');
            Route::patch('/{user}/update', 'UsersController@update')->name('users.update');
            Route::delete('/{user}/delete', 'UsersController@destroy')->name('users.destroy');
            Route::patch('/users/{user}/password_update', 'UsersController@updatePassword')->name('users.updatePassword');
            Route::patch('/users/{user}/password_admin', 'UsersController@updateAdminPassword')->name('users.adminpassword');
        });

        Route::controller(ComplaintsController::class)->group(function () {
            Route::post('/update', 'editComplaint')->name('update.complaint');
            Route::post('/getComplaintData', 'getComplaintData')->name('getComplaintData');
        });
        Route::controller(OrganizationsController::class)->group(function () {
            Route::POST('/Organizaion/store', 'store')->name('createOrganizaion');
        });
    });

    Route::controller(LoginRegisterController::class)->group(function () {
        Route::get('/dashboard', 'dashboard')->name('dashboard');
        Route::get('/register', 'register')->name('register.show');
        // Route::post('/store', 'store')->name('register.perform');
        // Route::post('/logout', 'logout')->name('logout.perform');

    });

    Route::get('/logout', [UserLoginRegisterController::class, 'logout'])->name('logout');
    Route::get('/userdashboard', [UserLoginRegisterController::class, 'userdashboard'])->name('userdashboard')->middleware('auth');

    /**
     * Logout Routes
     */
    // Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
    // Route::post('/logout', 'LoginRegisterController@logout')->name('logout');

    /**
     * User Routes
     */
    Route::group(['prefix' => 'users'], function () {
        Route::get('/', 'UsersController@index')->name('users.index');
        Route::get('/create', 'UsersController@create')->name('users.create');
        // Route::post('/create', 'UsersController@store')->name('users.store');
        Route::get('/{user}/show', 'UsersController@show')->name('users.show');
        Route::get('/{user}/edit', 'UsersController@edit')->name('users.edit');
        // Route::patch('/{user}/update', 'UsersController@update')->name('users.update');
        // Route::delete('/{user}/delete', 'UsersController@destroy')->name('users.destroy');
    });

    Route::controller(ComplaintsController::class)->group(function () {
        Route::get('/complaints/all', 'index')->name('complaint.index');
        Route::get('/complaints/file', 'file')->name('complaint.file');
        Route::get('/complaints/status-summary', 'statusSummary')->name('complaints.status_summary');
        Route::get('/complaints/assigned_complaint', 'assignedComplaintSummary')->name('complaints.assigned_complaint_summary');
        Route::get('/complaints/manage_complaint', 'manage_complaint')->name('complaints.manage_complaint');
        Route::get('/complaints/pending', 'pending')->name('complaint.pending');
        Route::get('/complaints/inprocess', 'inprocess')->name('complaint.inprocess');
        Route::get('/complaints/cancelled', 'cancelled')->name('complaint.cancelled');
        Route::get('/complaints/completed', 'completed')->name('complaint.completed');
        // Route::post('/update','editComplaint')->name('update.complaint');
        // Route::post('/getComplaintData','getComplaintData')->name('getComplaintData');
        Route::get('/complaints/pdf', 'ComplaintsController@generatePDF')->name('complaint.generatePDF');
        Route::get('/complaints/{id}', 'show')->name('complaints.show');
       
    });
     
    Route::controller(ComplaintUsersController::class)->group(function () {
        Route::get('/otheruser/allcomplaints', 'index')->name('otheruser.complaints.index');
        Route::get('/otheruser/pending', 'pending')->name('otheruser.complaint.pending');
        Route::post('/addComment','addComment')->name('addComment');
        Route::POST('/getComplaintComments','getComplaintComments')->name('getComplaintComments');
        
        
    });

    Route::controller(OrganizationsController::class)->group(function () {
        Route::get('/organizations/all', 'index')->name('organizationsList');
        Route::get('/organizations/create', 'create')->name('createOrganizationForm');
        Route::post('/organizations/store', 'store')->name('storeOrganization');
        Route::get('/organizations/{id}', 'show')->name('organizations.show');
        Route::get('/organizations/{id}/edit', 'edit')->name('organizations.edit');
        Route::put('/organizations/{id}', 'update')->name('organizations.update');
    });

    Route::controller(CommitteeController::class)->group(function () {
        Route::get('/committee/all', 'index')->name('allcommittees');
        Route::get('/committee/create', 'create')->name('committee.create');
        Route::post('/committee/store', 'store')->name('committee.store');
        Route::get('/committee/{id}', 'show')->name('committee.show');
        Route::get('/committees/{id}/edit', 'edit')->name('committee.edit');
        Route::put('/committees/{id}', 'update')->name('committee.update');
    });

Route::group(['namespace' => 'App\Http\Controllers'], function () {
    Route::get('/categories/all', [CategoriesController::class, 'index'])->name('categories.all');
    Route::get('/categories/create', [CategoriesController::class, 'create'])->name('categories.create');
    Route::post('/categories/store', [CategoriesController::class, 'store'])->name('categories.store');
    Route::get('/categories/{id}', [CategoriesController::class, 'show'])->name('categories.show');
    Route::get('/categories/{id}/edit', [CategoriesController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{id}', [CategoriesController::class, 'update'])->name('categories.update');
});
Route::patch('/users/{user}', 'UsersController@update')->name('users.update');


    Route::resource('roles', RolesController::class);
    Route::resource('permissions', PermissionsController::class);
    
});




