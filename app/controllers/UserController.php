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
		log::info("GET register page");
		return View::make("register");
	}

	public function addUser(){
		log::info("Adding user");
		$username = Input::get("username");
		$password = Input::get("password");
		$confirmPassword = Input::get("confirmPassword");

		log::info("Received: ");
		log::info($username);
		log::info($password);
		log::info($confirmPassword);

		if($password != $confirmPassword){
			log::info("Passwords do not match");
			return View::make("register", array("message" => "Passwords do not match"));
		}

		$hashedPassword = Hash::make($password);

		$rowsAffected = DB::insert("INSERT INTO CUSTOMER (USERNAME, PASSWORD) VALUES (?,?)", array($username, $password));
		if($rowsAffected != null){
			log::info("User successrfully added");
			Cookie::make("user", username, 60);
			return View::make("customer", array("message" => "Thanks for registering"));
		} else{
			log::info("User could not be added");
			return View::make("register", array("message" => "User could not be added"));
		}
		
	}

	public function login(){
		$username = Input::get("username");
		$password = Input::post("password");

		$userArray = DB::select("SELECT FROM CUSTOMER USERNAME WHERE USENAME=?", array($username));
		log::info($user);
		
		if(count($userArray) != 0){
			$user = $userArray[0];
			$hashedPassword = $user->password;
			if(Hash::check($password, $hashedPassword)){
				// set session for 1 hour
				Cookie::make("user", $username, 60);
				return View::make("customer", array("user" => $username, "message" => "Successfully logged in"));
			} else{
				// password was incorrect
				return View::make("hello", array("message" => "Invalid credentials"));
			}
		} else{
			// user did not exist
			return View::make("hello", array("message" => "User does not exist"));
		}
	}

}