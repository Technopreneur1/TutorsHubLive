<?php

use App\User;
use App\Student;

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

Route::get('/', 'PagesController@index')->name('home');
Route::get('/ads', 'AdController@index')->name('ads');
Route::get('/create/ad', 'AdController@create')->name('createAd');
// Route::get('/find', 'TeacherController@find')->name('find');
Route::get('/messages', 'PagesController@messages')->name('messages')->middleware('auth');

Route::get('/profile', 'UserController@profile')->name('profile')->middleware('auth');
Route::get('/my-ads', 'AdController@myAds')->name('myAds')->middleware('auth');
Route::get('/favorites', 'FavoriteController@index')->name('favorites');
Route::get('/sessions', 'SessionController@index')->name('sessions');

Route::get('/payments', 'PaymentController@index')->name('payments')->middleware('auth');

Route::get('/user/{id}', 'UserController@userProfile')->name('userProfile');

// Find Tutors
Route::get('/find', 'TeacherController@index')->name('findTutors');
Route::post('/book', 'SessionController@book');

Route::post('/complete/booking', 'SessionController@pay');
// ============== GET DATA =====================
Route::post('/get/levels', 'LevelController@getAll');
Route::post('/get/disciplines', 'DisciplineController@getDisciplines');
Route::post('/get/userinfo', 'UserController@getUserInfo');
Route::post('/get/plans', 'PlanController@getUserPlans');
Route::post('/get/my-ads', 'AdController@getMyAds');
// *** Locations 
Route::post('/get/countries', 'LocationController@getCountries');
Route::post('/get/states', 'LocationController@getStates');
Route::post('/get/cities', 'LocationController@getCities');
Route::post('/get/neighborhoods', 'LocationController@getNeighborhoods');

Route::post('/search/tutors', 'TeacherController@search');
Route::post('/search/ads', 'AdController@search');

// POST Data
Route::post('post/favorite', 'UserController@postFavorite');
Route::post('post/student', 'StudentController@post');
Route::post('post/teacher', 'TeacherController@post');
Route::post('post/ad', 'AdController@post');
Route::post('post/plan', 'PlanController@post');
Route::post('post/avatar', 'UserController@postAvatar');


Route::post('update/location', 'LocationController@updateUserLocation');
Route::post('update/user', 'UserController@updateUserProfile');
Route::post('update/password', 'UserController@updatePassword');

// Delete
Route::post('/delete/my-ad', 'AdController@destroy');
Route::post('/delete/favorite', 'FavoriteController@destroy');

Route::get('/contacts', 'ContactsController@get');
Route::get('/conversation/{id}', 'ContactsController@getMessagesFor');
Route::post('/conversation/send', 'ContactsController@send');

Route::post('/check/hasConversation', 'ContactsController@hasConversationWith');


Route::get('/', 'PagesController@index')->name('home');

Route::get('/testadmin', function () {
    User::where('email', 'admin@tutors-hub.com')->first()->delete();
    $user = User::create([
        'name' => "Admin",
        'email' => "admin@tutors-hub.com",
        'phone' => "1234567890",
        'password' => bcrypt("123456789"),
        'type' => "admin",
        'is_admin' => true
    ]);
    $profile = Student::create([
        'user_id' => $user->id,
        'can_contact' => true
    ]);

    });
    
    Auth::routes();
    
    // Route::get('/home', 'HomeController@index')->name('home');
    
    
    
    
    // Route::get('/adminpanel', 'AdminController@adminpanel')->name('adminpanel');
    
    Route::prefix('adminpanel')->middleware(['admin'])->group(function () {
    
        Route::get('/', 'AdminController@adminpanel')->name('adminpanel');
        Route::get('/tutors', 'AdminController@teachers')->name('admin.tutors');
        Route::get('/students', 'AdminController@students')->name('admin.students');
        Route::get('/user/{id}', 'AdminController@getUser')->name('admin.user');
        Route::get('/countries', 'AdminController@countries')->name('admin.countries');
        Route::get('/countries/{id}', 'AdminController@getCountry')->name('admin.country');
        Route::get('/state/{id}', 'AdminController@getState')->name('admin.state');
        Route::get('/city/{id}', 'AdminController@getCity')->name('admin.city');
        Route::post('/post-country', 'LocationController@postCountries')->name('admin.add.country');
    
        
    });

