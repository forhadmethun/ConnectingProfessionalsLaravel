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
*/
use Illuminate\Support\Facades\Input ;
use DB;

Route::group(['middleware' =>['web']],function(){

	Route::get('/', function () {
		Session::flush();
	    return view('index');
	});
	Route::get('/info',function(){
		$info=Input::get('search');
		//$name =Input::get('search');
		session(['info' => $info]);
	$rows = DB::table('profile')->where('Profile_name', 'like',$info.'%')->get();
       //$user = User::where('email', '=', Input::get('email'))->first();
/*if ($rows == null) {
   // user doesn't exist
	return view('index');
}
else{*/
	return view('searchpeople')->with('row',$rows);


		//return view('searchpeople')->with('info',$info);
	});

	Route::post('/submitinfo',function(){
		$Profile=new App\Profile;
		$Profile->Profile_name=Input::get('name');
		$Profile->Email=Input::get('email');
		$Profile->Password=bcrypt(Input::get('pass'));
		$name1=$Profile->Profile_name;
			//$Profile->Profession=Input::get('profession');
		//$Profile->Phone=Input::get('phone');
		$Profile->save();
		 session(['name' => $name1]);
		return view('/index');
		//return redirec('/index',['name'=>($Profile->Profile_name)]);
		//return 'hello';


	});
	Route::post('/checklogin',function(){
		
		return view('/index');
		//return redirec('/index',['name'=>($Profile->Profile_name)]);
		//return 'hello';


	});
	/*Route::post('/signin', [
		'uses' => 'UsersController@postSignIn',
		'as' => 'signin'
	]);|*/
	Route::get('/ashollogin', function () {
		
	    return view('/ashollogin');
	});

	Route::get('/profile/{name}','Profilecontroller@showmine');
	Route::get('/goto/{name}','Newprofilecontroller@gotopo');
	Route::get('/seereq/{id}','Newprofilecontroller@seereq');

	Route::get('/sendreq/{name}','Newprofilecontroller@sendreq');
	Route::get('/accept/{ids}/{idr}','Newprofilecontroller@acceptreq');
	Route::get('/reject/{ids}/{idr}','Newprofilecontroller@rejectreq');

		
		
       

	Route::get('/profile/editprofile/{name}','editProfileController@showabout');
	Route::get('/getprofile/{name}', 'faulController@show');
	Route::get('/index','Indexcontroller@showabout');
	Route::get('/about','Aboutcontroller@showabout');
	Route::get('/an_blog','Another_blogcontroller@showabout');
	Route::get('/blog','Blogcontroller@showabout');
	Route::get('/contact','Contactcontroller@showabout');
	Route::get('/extra','Extracontroller@showabout');
	Route::get('/jobs','Jobscontroller@showabout');
	Route::get('/login_index','Login_indexcontroller@showabout');
	Route::get('/network','Networkcontroller@showabout');
	//Route::get('/profile','Profilecontroller@showabout');
	Route::get('/portfolio','Portfoliocontroller@showabout');
	Route::get('/services','Servicescontroller@showabout');
	Route::get('/signout','Signoutcontroller@showabout');
	Route::get('/single-post','Single-postcontroller@showabout');
	Route::post('/updateprofile',function(){
		$Profile=new App\Profile;

		$Profile->Profile_name=Input::get('profile_name');
		$Profile->Email=Input::get('email');
		$Profile->Education=Input::get('education');
		$Profile->Interest=Input::get('interest');
		$Profile->Experience=Input::get('experience');
		$Profile->Languageskills=Input::get('languageskills');
		$Profile->Projects=Input::get('projects');
		$Profile->Courses=Input::get('courses');
		$Profile->Volunteer_exp=Input::get('volunteer_experiences');

		$name1=$Profile->Profile_name;
		DB::table('profile')
            ->where('Profile_name', $Profile->Profile_name)
            ->update(['Email' => $Profile->Email, 'Education' => $Profile->Education, 'Interest' => $Profile->Interest, 'Experience' => $Profile->Experience, 'Languageskills' => $Profile->Languageskills, 'Projects' => $Profile->Projects, 'Courses' => $Profile->Courses, 'Volunteer_exp' => $Profile->Volunteer_exp]);
		//$Profile->save();
		
		session(['name' => $name1]);
		return view('profile')->with('data', $Profile);

	});



});









