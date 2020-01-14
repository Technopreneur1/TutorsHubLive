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
Route::get('/contact', 'PagesController@contact')->name('contact');
Route::post('/contact', 'PagesController@postContact')->name('contact.post');
Route::get('/privacy-policy', 'PagesController@privacy')->name('privacy');
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
Route::post('post/complete-session', 'SessionController@complete');
Route::post('post/review', 'SessionController@postReview');


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


Route::get('/', 'PagesController@index')->name('home');

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

// Route::get('/lt', function () {
    

//     $jsonFile = file_get_contents(asset('locations.json'));
//     $locations = json_decode($jsonFile);
//     // dd($locations);
//     foreach($locations as $country)
//     {
//         // $country_model = TestLocation::create(['name' => $country->name]);
//         // echo "Intsert " . $country->name . "<br>";
//         foreach($country->states as $state)
//         {
//             $state_model = TestLocation::create(['name' => $state->name, 'parent_id' => 28102]);
//             // echo array_keys($state);

//             foreach($state->cities as $city)
//             {
//                 TestLocation::create(['name' => $city, 'parent_id' => $state_model->id]);
//             }
//         }
//         echo "DOne";
//     }


//     });


Route::get('/mailit', function () {
    
    $list = ["USMLE", "GRE", "Physics", "French", "Down Syndrome", "COMLEX", "LSAT", "Chemistry", "Spanish", "Autism", "Coursework", "SAT", "Biology", "Chinese", "Hearing/Visual Impearement", "Shelf Exams", "ACT", "Italian", "Other", "Admission", "SAT", "Russian", 
                "PSAT", "Japanese",
                "HSPT", "Arabic",
                "ISEE", "Portuguese",
                "SSAT", "Herbrew",
                "MCAT", "German", "Korean",
];
    foreach($list as $dis)
    {
        Discipline::create(['name' => $dis]);
    }
});
Route::get('/delus', function () {
    
    Location::find(41813)->delete();
});
Route::get('/delloc', function () {
    
    $locations = Location::all();
    foreach($locations as $location)
    {
        $location->delete();
    }
});

Route::get('/us1', function () {
    
    Location::create(['name' => "United States", 'type' => 'country', 'parent_id' => 0]);
    $jsonFile = file_get_contents(asset('usaa.json'));
    $locations = json_decode($jsonFile);
    // dd($locations);
    foreach($locations as $country)
    {
        $us = Location::where("name", "United States")->get()->first();
        $usid = $us->id;
        foreach($country->states as $state)
        {
            $state_model = Location::create(['name' => $state->name, 'type' => 'state', 'parent_id' => $usid]);
            // echo array_keys($state);

            foreach($state->cities as $city)
            {
                Location::create(['name' => $city, 'type' => 'city', 'parent_id' => $state_model->id]);
            }
        }
        echo "DOne";
    }


    });
Route::get('/us1a', function () {
    
    $jsonFile = file_get_contents(asset('usa1.json'));
    $locations = json_decode($jsonFile);
    // dd($locations);
    foreach($locations as $country)
    {
        $us = Location::where("name", "United States")->get()->first();
        $usid = $us->id;
        foreach($country->states as $state)
        {
            $state_model = Location::create(['name' => $state->name, 'type' => 'state', 'parent_id' => $usid]);
            // echo array_keys($state);

            foreach($state->cities as $city)
            {
                Location::create(['name' => $city, 'type' => 'city', 'parent_id' => $state_model->id]);
            }
        }
        echo "DOne";
    }


    });

Route::get('/us2', function () {
    

    $jsonFile = file_get_contents(asset('us2.json'));
    $locations = json_decode($jsonFile);
    // dd($locations);
    foreach($locations as $country)
    {
        $us = Location::where("name", "United States")->get()->first();
        $usid = $us->id;
        foreach($country->states as $state)
        {
            $state_model = Location::create(['name' => $state->name, 'type' => 'state', 'parent_id' => $usid]);
            // echo array_keys($state);

            foreach($state->cities as $city)
            {
                Location::create(['name' => $city, 'type' => 'city', 'parent_id' => $state_model->id]);
            }
        }
        echo "DOne";
    }

});
Route::get('/us2b', function () {
    

    $jsonFile = file_get_contents(asset('us2b.json'));
    $locations = json_decode($jsonFile);
    // dd($locations);
    foreach($locations as $country)
    {
        $us = Location::where("name", "United States")->get()->first();
        $usid = $us->id;
        foreach($country->states as $state)
        {
            $state_model = Location::create(['name' => $state->name, 'type' => 'state', 'parent_id' => $usid]);
            // echo array_keys($state);

            foreach($state->cities as $city)
            {
                Location::create(['name' => $city, 'type' => 'city', 'parent_id' => $state_model->id]);
            }
        }
        echo "DOne";
    }

});

Route::get('/canada', function () {
    
    Location::create(['name' => "Canada", 'type' => 'country',  'parent_id' => 0]);
    $jsonFile = file_get_contents(asset('canada.json'));
    $locations = json_decode($jsonFile);
    // dd($locations);
    foreach($locations as $country)
    {
        $us = Location::where("name", "Canada")->get()->first();
        $usid = $us->id;
        foreach($country->states as $state)
        {
            $state_model = Location::create(['name' => $state->name, 'type' => 'state',  'parent_id' => $usid]);
            // echo array_keys($state);

            foreach($state->cities as $city)
            {
                Location::create(['name' => $city, 'type' => 'city',  'parent_id' => $state_model->id]);
            }
        }
        echo "DOne";
    }

});
    
    Auth::routes();
    
    // Route::get('/home', 'HomeController@index')->name('home');
    
    
    
    
    // Route::get('/adminpanel', 'AdminController@adminpanel')->name('adminpanel');
    
    Route::prefix('adminpanel')->middleware(['admin'])->group(function () {
    
        Route::get('/', 'AdminController@adminpanel')->name('adminpanel');
        Route::get('/contact/{id}', 'AdminController@contact')->name('admin.contact');

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
        
        Route::get('/levels/{id}', 'AdminController@editlevels')->name('admin.level.edit');
        Route::post('/levels/{id}', 'LevelController@update')->name('admin.level.update');
        Route::post('/level-delete/{id}', 'LevelController@destroy')->name('admin.level.delete');

        Route::post('/post-payment', 'PaymentController@post')->name('admin.post.payment');
        Route::post('/ban/{id}', 'UserController@ban')->name('admin.ban');

        
    });

