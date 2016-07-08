<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/ //<li><a href="{{url('/github')}}" class="dropdown-toggle">Github</a></li>-->

Route::group(['middleware' => ['web']], function () {

    Route::get('/', function () {
        return view('login');
    })->middleware(['before']);
    //when click on login page
    Route::get('/login',[
        'as'    =>  'get.login',
        'uses'  =>  'loginController@getLogin'
    ]);
    Route::get('/signup',function(){
        return redirect('/');
    });
    
    Route::post('/login/',[
            'as'    =>  'post.login.check',
            'uses'  =>  'loginController@checkLogin'
    ])->middleware(['token']);

    Route::post('/signup/',[
            'as'    =>  'post.signup',
            'uses'  =>  'loginController@signup'
    ])->middleware(['token']);

    Route::get('/facebook',[
            'as'    =>  'get.facebook',
            'uses'  =>  'facebookController@facebook'
    ]);

    Route::get('/fb_callback',[
            'as'    =>  'get.facebook.callback',
            'uses'  =>  'facebookController@handleProviderCallback'
    ]);

    Route::get('/github',[
        'as'    =>  'get.github',
        'uses'  =>  'gitController@gitLogin'
    ]);

    Route::get('/githubresponse',[
        'as'    =>  'get.git.response',
        'uses'  =>  'gitController@githubresponse'
    ]);
});
Route::group(['middleware'=>['web','login','token']],function(){
   
    Route::post('/ridelist/',[
            'as'    => 'post.ride.search',
            'uses'  => 'rideController@rideSearch'
    ]);
    
    Route::post('/ridesearch/',[
            'as'    =>  'post.rideListSearch',
            'uses'  =>  'rideController@rideListSearch'
    ]);    

});

Route::group(['middleware'=>['web','login']],function(){

    Route::get('/findride', function () {
        return view('findRide');
    });

    Route::get('/userProfile/{id}/{rideid}',[
        'as'    =>  'get.profile',
        'uses'  =>  'userController@getProfile'
    ]);

    Route::get('/offerride',[
        'as'    =>  'get.view.offer',
        'uses'  =>  'offerRideController@viewOfferRide'
    ]);

    Route::get('/logout',function(){
        session()->flush();
        if (isset($_SERVER['HTTP_COOKIE']))
        {
            $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
            foreach($cookies as $cookie)
            {
                $mainCookies = explode('=', $cookie);
                $name = trim($mainCookies[0]);
                setcookie($name, '', time()-1000);
                setcookie($name, '', time()-1000, '/');
            }
        }
        return redirect('/');
    });

    Route::get('/ridedetail/{id}',[
        'as'    =>  'get.ride.details',
        'uses'  =>  'rideController@getRideDetail'
    ]);
    Route::get('/rideinfo',[
        'as'    =>  'get.ride.seat',
        'uses'  =>  'rideController@getRideInfo'
    ]);
    Route::get('/OfferRideDetail/{id}',[
        'as'    =>  'get.ride.offer',
        'uses'  =>  'rideController@getRideOffer'
    ]);

    Route::get('/carowner', function () {
        return view('carOwner');
    });

    Route::get('/dashboard', [
        'as'    =>  'get.dashboard',
        'uses'  =>  'dashboardController@viewDashboard'
    ]);
    Route::get('/amount',[
        'as'    =>  'get.wallet.amount',
        'uses'  =>  'dashboardController@amount'
    ]);
    Route::get('/home', function () {
        return view('home');
    });
    //when click on url
    Route::get('/ridelist', [
        'as'    =>  'get.ride.list',
        'uses'  =>  'rideController@getRideList'
    ]);
    //when click on url
    Route::get('/ridelistsearch',function(){
        return view('rideList');
    });
    //get quantity
    Route::get('/userDetails',[
        'as'    =>  'get.user.details',
        'uses'  =>  'userController@getUserDetails'
    ]);

    Route::post('/userDetails',[
        'as'    =>  'post.user.details',
        'uses'  =>  'userController@updateUserDetails'
    ]);
    
    Route::post('/payment',[
        'as'    =>  'post.book.ccavenu.ride',
        'uses'  =>  'rideController@bookCcavenu'
    ]);
    Route::post('/emailConfirmation',[
        'as'    =>  'post.email.confirmation',
        'uses'  =>  'userController@emailConfirmation'
    ]);

    Route::post('/mobileConfirmation',[
        'as'    =>  'post.mobile.confirmation',
        'uses'  =>  'userController@mobileConfirmation' 
    ]);

    Route::post('/updateUserPreference',[
        'as'    =>  'post.user.preference',
        'uses'  =>  'userController@savePreference'
    ]);

    Route::post('/imagesubmit',[
        'as'    =>  'post.image.upload',
        'uses'  =>  'userController@imageUpload'
    ]);

    Route::post('/sendMobileCode',[
        'as'    =>  'post.send.mobile.code',
        'uses'  =>  'userController@sendMobileCode'
    ]);
    
    Route::post('/carAdd',[
        'as'    =>  'post.car.add',
        'uses'  =>  'carController@addCar'
    ]);

    Route::get('/getCarDetails',[
        'as'    =>  'get.car.detail',
        'uses'  =>  'carController@getCarDetails'
    ]);

    Route::post('/carUpdate',[
        'as'    =>  'post.car.update',
        'uses'  =>  'carController@updateCar'
    ]);

    //delete car
    Route::post('/deleteCar',[
        'as'    =>  'post.car.delete',
        'uses'  =>  'carController@deleteCar'
    ]);

    Route::get('/carList',[
        'as'    =>  'get.car.list',
        'uses'  =>  'carController@carList'
    ]);
    
    Route::get('/rideSearchList',[
        'as'    =>  'get.ride.list.data',
        'uses'  =>  'rideController@carList'
    ]);

    Route::get('/exchangeRating',[
        'as'    =>  'get.exchange.rating',
        'uses'  =>  'ratingController@getExchangeRating'
    ]);
    Route::post('/ratingExchange',[
        'as'    =>  'post.rating.exchange',
        'uses'  =>  'ratingController@ratingExchange'
    ]);

    //rating given list
    Route::get('/ratingGiven',[
        'as'    =>  'get.rating.given.list',
        'uses'  =>  'ratingController@ratingGiven'
    ]);
    //rating received list
    Route::get('/ratingReceived',[
        'as'    =>  'get.rating.received.list',
        'uses'  =>  'ratingController@ratingReceived'
    ]);

    Route::post('/offerride',[
        'as'    =>  'post.offer.ride',
        'uses'  =>  'offerRideController@createRide'
    ]);

    Route::get('/paidTransaction',[
        'as'    =>  'get.paid.transaction',
        'uses'  =>  'dashboardController@paidTransaction'
    ]);

    Route::get('/earnTransaction',[
        'as'    =>  'get.earn.transaction',
        'uses'  =>  'dashboardController@earnTransaction'
    ]);

    Route::get('/getMessage',[
        'as'    =>  'get.chat.message',
        'uses'  =>  'chatController@getMessage'
    ]);

    Route::post('/sendMessage',[
        'as'    =>  'post.send.message',
        'uses'  =>  'chatController@sendMessage'
    ]);

    Route::post('/isTyping',[
        'as'    =>  'post.is.typing',
        'uses'  =>  'chatController@isTyping'
    ]);

    Route::post('/isNotTyping',[
        'as'    =>  'post.not.typing',
        'uses'  =>  'chatController@isNotTyping'
    ]);

    Route::get('/retriveMessage',[
        'as'    =>  'get.retrive.message',
        'uses'  =>  'chatController@retriveMessage'
    ]);

    Route::post('/rideBook',[
        'as'    =>  'post.book.ride',
        'uses'  =>  'rideController@bookRide'
    ]);

    Route::get('/rideBookHistory',[
        'as'    =>  'get.ridebooked.history',
        'uses'  =>  'dashboardController@rideBookHistory'
    ]);
});