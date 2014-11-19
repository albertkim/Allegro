<?php

class UserController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function getRegister(){
		return View::make("register");
	}

	public function addUser(email, password){
		$email = Input::get("email");
		$pasword = Input::post("password");
		// compare the password using bcrypt
		$hashedPassword = $passoword;
		DB:insert("INSERT INTO USERS (EMAIL, PASSWORD) VALUES (?,?)", array($email, $password));
	}

	public function login(){
		$email = Input::get("email");
		$pasword = Input::post("password");
		// compare the password using bcrypt
		$hashedPassword = $passoword;
		$user = DB::select("SELECT FROM USERS EMAIL WHERE EMAIL=?", array($email);
		if($user != null){
			if($user.password == $hashedPassword){
				// set session for 1 hour
				Cookie::make("user", $user, 60);
				return View::make("customer", array("user" => $user));
			} else{
				// password was incorrect
				return 
			}
		} else{
			// user did not exist
			return
		}
	}

}