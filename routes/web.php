<?php

use App\Http\Controllers\AxiosController;
use App\Http\Controllers\BackController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\Talk_peopleController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/','Auth\RegisterController@showRegistrationForm')->name('signup.get');

Route::post('signup','Auth\RegisterController@register')->name('signup.post');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


// AxiosController
// Route::get('axios/userName', 'AxiosController@userName')
// ->name('backs.userName');
Route::post('/axios/logout', 'AxiosController@logout')
->name('axios.logout');





Route::prefix('players')->group(function () {
  
});

// MyhomeController
Route::resource('myhomes', 'MyhomeController')->only([
  'index'
]);



// ProfileController
Route::resource('profiles', 'ProfileController')->only([
  'index', 'update', 'show'
])->parameters([
  'profiles' => 'user'
]);


// Route::get('/profiles/image_update', 'ProfileController@image_update')
// ->name('profiles.image_update');
// Route::get('/profiles/profile_update', 'ProfileController@profile_update')
// ->name('profiles.profile_update');

// ImageController
Route::resource('images', 'ImagesController')->only([
  'update', 'show'
])->parameters([
  'images' => 'user'
]);


// FindController
Route::resource('finds', 'FindController')->only([
  'index'
]);

// FindResultController
// Route::resource('finds.results', 'FindResultController')->only([
//   'index', 'show'
// ]);

// ResultController
Route::resource('results', 'ResultController')->only([
  'index', 'show'
])->parameters([
  'results' => 'user'
]);


// ActivityController
Route::resource('activities', 'ActivityController')->only([
  'index', 'show'
])->parameters([
  'activities' => 'user'
]);


// Friend_followerController

// // ↓これは第一正規品
// Route::resource('friend_followers', 'Friend_followerController')->only([
//   'index', 'show'
// ])->parameters([
//   'friend_followers' => 'user'
// ]);

// Route::prefix('friend_follower')->group(function () {
//   Route::get('/', 'Friend_followerController@index')->name('friend_follower.index');
//   Route::get('/{user}', 'Friend_followerController@show')->name('friend_follower.show');
// });




// Friend_followController

// // ↓これは第一正規品
// Route::resource('friend_follows', 'Friend_followController')->only([
//   'index', 'show'
// ])->parameters([
//   'friend_follows' => 'user'
// ]);

// Route::prefix('friend_follow')->group(function () {
//   Route::get('/', 'Friend_followController@index')->name('friend_follow.index');
//   Route::get('/{user}', 'Friend_followController@show')->name('friend_follow.show');
// });



// FriendController
Route::resource('friends', 'FriendController')->only([
  'index', 'show'
])->parameters([
  'friends' => 'user'
]);





// Talk_userController
Route::resource('talk_users', 'Talk_userController')->only([
  'index', 'show'
  ])->parameters([
    'talk_users' => 'user'
    ]);
    
    
    // Talk_userContentController
    Route::get('/talk_users/{user}/contents/axios/userChange', 'Talk_userContentController@axios_userChange')->name('talk_users.contents.axios_userChange');
    
    Route::get('/talk_users/{user}/contents/axios/talkUpdate', 'Talk_userContentController@axios_talkUpdate')->name('talk_users.contents.axios_talkUpdate');

    Route::resource('talk_users.contents', 'Talk_userContentController')->only([
      'index', 'store'
      ])->parameters([
        'talk_users' => 'user'
        ]);
        
        

// Follow_listProfile
// Route::post('follow_lists', 'Follow_listProfile')->name('follow_lists.invoke');

// Follow_detailProfile
// Route::post('follow_details', 'Follow_detailProfile')->name('follow_details.invoke');


Route::resource('follows', 'FollowController')->only([
  'store', 'destroy'
])->parameters([
  'follows' => 'user'
]);




// BackController
Route::get('backs/from_details', 'BackController@fromDetails')
->name('backs.from_details');

Route::get('backs/from_talk_show', 'BackController@fromTalk_show')
->name('backs.from_talk_show');




