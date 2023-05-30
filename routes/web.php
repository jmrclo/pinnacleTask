<?php


use App\Models\students;
use Barryvdh\DomPDF\Facade\Pdf;
use app\Controller\UserController;
use Illuminate\Support\Facades\Auth;
use app\Controller\StudentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnnouncementController;


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
Auth::routes([
    'verify' =>true
]);
// Route::group(['middleware' => ['auth', 'verified']], function(){
//main
Route::get('/', 'App\Http\Controllers\StudentController@index2')->middleware('auth','isAdmin');
//dashboard
Route::get('/dashboard', 'App\Http\Controllers\StudentController@index3')->middleware('auth','isAdmin');
//viewpdf
Route::get('/pdf', 'App\Http\Controllers\StudentController@pdf');
//excel
Route::get('/excel', 'App\Http\Controllers\StudentController@export');
//imports
Route::post('/import', 'App\Http\Controllers\StudentController@import');
//reports
Route::get('/reports', 'App\Http\Controllers\StudentController@index')->middleware('auth','isAdmin');
//create
Route::get('/reports/create', 'App\Http\Controllers\StudentController@create')->middleware('auth','isAdmin');
//store
Route::post('/reports', 'App\Http\Controllers\StudentController@store')->middleware('auth','isAdmin');
//edit
Route::get('/reports/{students}/edit', 'App\Http\Controllers\StudentController@edit')->middleware('auth');
//edit to update
Route::put('/reports/{students}', 'App\Http\Controllers\StudentController@update')->middleware('auth');
//delete
Route::delete('/reports/{students}', 'App\Http\Controllers\StudentController@destroy')->middleware('auth');
// show 
Route::get('/reports/{students}','App\Http\Controllers\StudentController@show')->middleware('auth' ,'isAdmin');


//studentside
Route::get('/main','App\Http\Controllers\StudentsPageController@index')->middleware('auth','verified');

//edit
Route::get('/profile/{students}/edit','App\Http\Controllers\StudentsPageController@edit')->middleware('auth');
//update
//edit to update
Route::put('/profile/{students}', 'App\Http\Controllers\StudentsPageController@update')->middleware('auth');

//show
Route::get('/profile/{students}','App\Http\Controllers\StudentsPageController@show')->middleware('auth');

// });
    // user login

//regerter
Route::get('/register', 'App\Http\Controllers\UserController@create')->middleware('auth','isAdmin');
//create user
Route::post('/users','App\Http\Controllers\UserController@store');
//logout
Route::post('/logout', 'App\Http\Controllers\UserController@logout')->middleware('auth' );
//login
Route::get('/login', 'App\Http\Controllers\UserController@login')->name('login')->middleware('guest');
//login user
Route::post('/users/authenticate', 'App\Http\Controllers\UserController@authenticate');

// Route::get('/layouts', function () {
  
//     return view('layouts');
// });

// Route::get('/chart', function () {
//     return view('chart');
// });



// Route for displaying the form to create a new announcement
Route::get('/announcements/create', [AnnouncementController::class, 'create'])->name('announcements.create')->middleware('auth','isAdmin');

// Route for storing the new announcement in the database
Route::post('/announcements', [AnnouncementController::class, 'store'])->name('announcements.store')->middleware('auth','isAdmin');

// Route for displaying the list of announcements
Route::get('/announcements', [AnnouncementController::class, 'index'])->name('announcements.index')->middleware('auth','isAdmin');
//show deleted
Route::get('/announcements/trashed','App\Http\Controllers\AnnouncementController@trashed')->middleware('auth','isAdmin');
//restore
Route::get('announcements/restore/{announcements}','App\Http\Controllers\AnnouncementController@restore')->middleware('auth','isAdmin');
//delete permanent
Route::get('announcements/delete/{announcements}','App\Http\Controllers\AnnouncementController@deletePermanent')->middleware('auth','isAdmin');
//shpw
Route::get('/announcements/{announcements}','App\Http\Controllers\AnnouncementController@show')->middleware('auth','isAdmin');
//edit
Route::get('/announcements/{announcement}/edit', 'App\Http\Controllers\AnnouncementController@edit')->middleware('auth','isAdmin');
//update
Route::put('/announcements/{announcement}',  'App\Http\Controllers\AnnouncementController@update')->middleware('auth','isAdmin');
//delete
Route::delete('/announcements/{announcement}', 'App\Http\Controllers\AnnouncementController@delete')->middleware('auth','isAdmin');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');




