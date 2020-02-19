<?php

use App\User;
use App\Student;
use App\Location;
use App\Discipline;
use App\TestLocation;
use App\Mail\WelcomeEmail;
use App\Jobs\sendWelcomeMail;
use Illuminate\Support\Facades\Mail;

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

// Route::get('/', 'PagesController@index')->name('home')->middleware('verified', 'CheckBanned');
Route::get('/contact', 'PagesController@contact')->name('contact');
Route::post('/contact', 'PagesController@postContact')->name('contact.post');
Route::get('/privacy-policy', 'PagesController@privacy')->name('privacy');
Route::get('/terms-and-conditions', 'PagesController@terms')->name('terms');
Route::get('/ads', 'AdController@index')->name('ads')->middleware('auth', 'verified', 'CheckBanned');
Route::get('/create/ad', 'AdController@create')->name('createAd')->middleware('auth', 'verified', 'CheckBanned');
// Route::get('/find', 'TeacherController@find')->name('find');
Route::get('/messages', 'PagesController@messages')->name('messages')->middleware('auth', 'verified', 'CheckBanned');

Route::get('/profile', 'UserController@profile')->name('profile')->middleware('auth', 'verified', 'CheckBanned');
Route::get('/my-ads', 'AdController@myAds')->name('myAds')->middleware('auth', 'verified', 'CheckBanned');
Route::get('/favorites', 'FavoriteController@index')->name('favorites')->middleware('auth', 'verified', 'CheckBanned');
Route::get('/sessions', 'SessionController@index')->name('sessions')->middleware('auth', 'verified', 'CheckBanned');

Route::get('/payments', 'PaymentController@index')->name('payments')->middleware('auth', 'verified', 'CheckBanned');

Route::get('/user/{id}', 'UserController@userProfile')->name('userProfile')->middleware('auth', 'verified', 'CheckBanned');

// Find Tutors
Route::get('/find', 'TeacherController@index')->name('findTutors')->middleware('auth', 'verified', 'CheckBanned');

Route::post('/complete/booking', 'SessionController@pay')->middleware('auth', 'verified', 'CheckBanned');
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

Route::post('/get/min-wage', 'TeacherController@getMinWage');

Route::post('/search/tutors', 'TeacherController@search');
Route::post('/search/ads', 'AdController@search');

// POST Data
Route::post('post/favorite', 'UserController@postFavorite');
Route::post('post/student', 'StudentController@post');
Route::post('post/teacher', 'TeacherController@post');
Route::post('post/ad', 'AdController@post');
Route::post('post/plan', 'PlanController@post');
Route::post('post/avatar', 'UserController@postAvatar');
Route::post('post/complete-session', 'SessionController@complete');
Route::post('post/cancel-session', 'SessionController@postCancel');
Route::post('post/review', 'SessionController@postReview');
Route::post('/post/long-lat', 'UserController@updateLatLng');


Route::post('update/location', 'LocationController@updateUserLocation');
Route::post('update/user', 'UserController@updateUserProfile');
Route::post('update/password', 'UserController@updatePassword');
Route::post('update/payment-info', 'TeacherController@updatePayment');
Route::post('/update/plan', 'PlanController@update');
Route::post('update/ad', 'AdController@update');


// Delete
Route::post('/delete/my-ad', 'AdController@destroy');
Route::post('/delete/favorite', 'FavoriteController@destroy');
Route::post('/delete/plan', 'PlanController@destroy');

Route::get('/contacts', 'ContactsController@get');
Route::get('/conversation/{id}', 'ContactsController@getMessagesFor');
Route::post('/conversation/send', 'ContactsController@send');

Route::post('/check/hasConversation', 'ContactsController@hasConversationWith');
Route::post('/check/doILike', 'UserController@doILike');




Route::get('/testadmin', function () {
    // Location::find(1)->update(['name' => 'Pakistan']);
    // Location::find(3)->update(['name' => 'Ohio']);
    // User::where('email', 'admin@tutors-hub.com')->first()->delete();
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




// Route::get('/mailit', function () {
    
//     $list = ["USMLE", "GRE", "Physics", "French", "Down Syndrome", "COMLEX", "LSAT", "Chemistry", "Spanish", "Autism", "Coursework", "SAT", "Biology", "Chinese", "Hearing/Visual Impearement", "Shelf Exams", "ACT", "Italian", "Other", "Admission", "SAT", "Russian", 
//                 "PSAT", "Japanese",
//                 "HSPT", "Arabic",
//                 "ISEE", "Portuguese",
//                 "SSAT", "Herbrew",
//                 "MCAT", "German", "Korean",
// ];
//     foreach($list as $dis)
//     {
//         Discipline::create(['name' => $dis]);
//     }
// });
// Route::get('/resetlat', function () {
    
//     foreach(User::all() as $user)
//     {
//         $user->update([
//             'latitude' => null,
//             'longitude' => null,
//         ]);
//     }
// });
// Route::get('/delloc', function () {
    
//     $locations = Location::all();
//     foreach($locations as $location)
//     {
//         $location->delete();
//     }
// });

// Route::get('/us1', function () {
    
//     Location::create(['name' => "United States", 'type' => 'country', 'parent_id' => 0]);
//     $jsonFile = file_get_contents(asset('usaa.json'));
//     $locations = json_decode($jsonFile);
//     // dd($locations);
//     foreach($locations as $country)
//     {
//         $us = Location::where("name", "United States")->get()->first();
//         $usid = $us->id;
//         foreach($country->states as $state)
//         {
//             $state_model = Location::create(['name' => $state->name, 'type' => 'state', 'parent_id' => $usid]);
//             // echo array_keys($state);

//             foreach($state->cities as $city)
//             {
//                 Location::create(['name' => $city, 'type' => 'city', 'parent_id' => $state_model->id]);
//             }
//         }
//         echo "DOne";
//     }


//     });
// Route::get('/us1a', function () {
    
//     $jsonFile = file_get_contents(asset('usa1.json'));
//     $locations = json_decode($jsonFile);
//     // dd($locations);
//     foreach($locations as $country)
//     {
//         $us = Location::where("name", "United States")->get()->first();
//         $usid = $us->id;
//         foreach($country->states as $state)
//         {
//             $state_model = Location::create(['name' => $state->name, 'type' => 'state', 'parent_id' => $usid]);
//             // echo array_keys($state);

//             foreach($state->cities as $city)
//             {
//                 Location::create(['name' => $city, 'type' => 'city', 'parent_id' => $state_model->id]);
//             }
//         }
//         echo "DOne";
//     }


//     });

// Route::get('/us2', function () {
    

//     $jsonFile = file_get_contents(asset('us2.json'));
//     $locations = json_decode($jsonFile);
//     // dd($locations);
//     foreach($locations as $country)
//     {
//         $us = Location::where("name", "United States")->get()->first();
//         $usid = $us->id;
//         foreach($country->states as $state)
//         {
//             $state_model = Location::create(['name' => $state->name, 'type' => 'state', 'parent_id' => $usid]);
//             // echo array_keys($state);

//             foreach($state->cities as $city)
//             {
//                 Location::create(['name' => $city, 'type' => 'city', 'parent_id' => $state_model->id]);
//             }
//         }
//         echo "DOne";
//     }

// });
// Route::get('/us2b', function () {
    

//     $jsonFile = file_get_contents(asset('us2b.json'));
//     $locations = json_decode($jsonFile);
//     // dd($locations);
//     foreach($locations as $country)
//     {
//         $us = Location::where("name", "United States")->get()->first();
//         $usid = $us->id;
//         foreach($country->states as $state)
//         {
//             $state_model = Location::create(['name' => $state->name, 'type' => 'state', 'parent_id' => $usid]);
//             // echo array_keys($state);

//             foreach($state->cities as $city)
//             {
//                 Location::create(['name' => $city, 'type' => 'city', 'parent_id' => $state_model->id]);
//             }
//         }
//         echo "DOne";
//     }

// });

// Route::get('/canada', function () {
    
//     Location::create(['name' => "Canada", 'type' => 'country',  'parent_id' => 0]);
//     $jsonFile = file_get_contents(asset('canada.json'));
//     $locations = json_decode($jsonFile);
//     // dd($locations);
//     foreach($locations as $country)
//     {
//         $us = Location::where("name", "Canada")->get()->first();
//         $usid = $us->id;
//         foreach($country->states as $state)
//         {
//             $state_model = Location::create(['name' => $state->name, 'type' => 'state',  'parent_id' => $usid]);
//             // echo array_keys($state);

//             foreach($state->cities as $city)
//             {
//                 Location::create(['name' => $city, 'type' => 'city',  'parent_id' => $state_model->id]);
//             }
//         }
//         echo "DOne";
//     }

// });
    
    Auth::routes();
    
    // Route::get('/home', 'HomeController@index')->name('home');
    
    
    
    
    // Route::get('/adminpanel', 'AdminController@adminpanel')->name('adminpanel');
    
Route::prefix('adminpanel')->middleware(['admin'])->group(function () {

    Route::get('/', 'AdminController@adminpanel')->name('adminpanel');
    Route::get('/contact/{id}/{ticket}', 'AdminController@contact')->name('admin.contact');

    Route::get('/tutors', 'AdminController@teachers')->name('admin.tutors');
    Route::get('/tutors/banned', 'AdminController@bannedTutors')->name('admin.tutors.banned');
    Route::get('/students', 'AdminController@students')->name('admin.students');
    Route::get('/students/banned', 'AdminController@bannedStudents')->name('admin.students.banned');
    Route::get('/user/{id}', 'AdminController@getUser')->name('admin.user');
    Route::get('/countries', 'AdminController@countries')->name('admin.countries');
    Route::get('/countries/{id}', 'AdminController@getCountry')->name('admin.country');
    Route::get('/state/{id}', 'AdminController@getState')->name('admin.state');
    Route::get('/city/{id}', 'AdminController@getCity')->name('admin.city');
    Route::get('/settings', 'AdminController@settings')->name('admin.settings');
    Route::get('/levels', 'AdminController@levels')->name('admin.levels');
    Route::get('/admins', 'AdminController@admins')->name('admin.admins');
    Route::get('/sessions', 'AdminController@sessions')->name('admin.sessions');
    Route::get('/sessions/{id}', 'AdminController@viewSession')->name('admin.session.view');
    Route::get('/ads', 'AdminController@ads')->name('admin.ads');
    Route::get('/ads/{id}', 'AdminController@viewAd')->name('admin.ad.view');
    Route::post('/delete-ad/{id}', 'AdController@deleteByAdmin')->name('admin.delete.ad');
    Route::post('/cancel-session', 'SessionController@cancel')->name('admin.cancel.session');
    Route::post('/verify-email', 'AdminController@verifyEmail')->name('admin.verifyemail');

    Route::get('/add-admin', 'AdminController@createAdmin')->name('admin.add.admin');
    Route::post('/add-admin', 'AdminController@postAdmin')->name('admin.post.admin');
    Route::get('/profile', 'AdminController@showAdmin')->name('admin.show.admin');
    Route::post('/update-password', 'AdminController@updatePassword')->name('admin.update.password');
    
    Route::post('/post-country', 'LocationController@postCountries')->name('admin.add.country');
    Route::get('/disciplines', 'AdminController@disciplines')->name('admin.disciplines');
    Route::get('/disciplines/{id}', 'AdminController@editDiscipline')->name('admin.discipline.edit');
    Route::post('/discipline-delete/{id}', 'DisciplineController@destroy')->name('admin.discipline.delete');
    Route::post('/disciplines/{id}', 'DisciplineController@update')->name('admin.discipline.update');
    Route::post('/levels', 'LevelController@post')->name('admin.add.level');
    Route::post('/disciplines', 'DisciplineController@post')->name('admin.add.discipline');
    Route::post('/update-fee', 'MetaController@updateFee')->name('admin.update.fee');
    Route::post('/location-hide/{id}', 'LocationController@hide')->name('admin.hide.location');
    
    Route::get('/levels/{id}', 'AdminController@editlevels')->name('admin.level.edit');
    Route::post('/levels/{id}', 'LevelController@update')->name('admin.level.update');
    Route::post('/level-delete/{id}', 'LevelController@destroy')->name('admin.level.delete');

    Route::post('/post-payment', 'PaymentController@post')->name('admin.post.payment');
    Route::post('/ban/{id}', 'UserController@ban')->name('admin.ban');
    
    Route::post('/login-as', 'AdminController@adminLoginAs')->name('admin.loginas');
    
});

Auth::routes(['verify' => true]);