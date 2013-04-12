<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array('as'=>'home',function()
{
	return View::make('home');
}));

Route::get('login', array('as' => 'login', function () {
	return View::make('login');
}))->before('guest');

Route::post('login', function () { 

    $user = array(
        'email' => Input::get('username'),
        'password' => Input::get('password')
    );
    
    if (Auth::attempt($user)) {
        return Redirect::route('home')
            ->with('flash_notice', 'You are successfully logged in.');
    }
    
    // authentication failure! lets go back to the login page
    return Redirect::route('login')
        ->with('flash_error', 'Your username/password combination was incorrect.')
        ->withInput();

});

Route::get('signup',function(){
	return View::make('register');
});

Route::post('signup',function(){

	$id = LMongo::collection('users')->insert(
	    array('username' => Input::get('username'),'email' => Input::get('email'), 'password' => Hash::make(Input::get('password')))
	);	

	if($id){
	    return Redirect::to('signup')
	        ->with('flash_notice', 'Registration Complete')
	        ->withInput();
    }else{
	    return Redirect::to('signup')
	        ->with('flash_error', 'Registration Failed')
	        ->withInput();
    }
});

Route::get('logout', array('as' => 'logout', function () { 
	Auth::logout();
    return Redirect::route('home')
        ->with('flash_notice', 'You are successfully logged out.');

}))->before('auth');

Route::get('profile', array('as' => 'profile', function () { 
	print_r(Auth::user());

}))->before('auth');

Route::get('testdb',function(){
	$LMongo = LMongo::connection();

	$mongo = $LMongo->getMongoClient();

	$databases = $mongo->listDBs();

	print_r($databases);

});

Route::get('testmongol',function(){
	$Mongol = Mongol::connection();

	$databases = $Mongol->listDBs();

	print_r($databases);

});

Route::get('testmongovel',function(){
	$attendee = new Attendee();
	$attendees = $attendee->getCollection();
	print($attendees);

});

Route::get('testauth',function(){
	print_r(Auth::user());
});