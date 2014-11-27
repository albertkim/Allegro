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
		log::info("POST add user");
		$username = Input::get("username");
		$password = Input::get("password");
		$confirmPassword = Input::get("confirmPassword");
		$name = Input::get("name");
		$address = Input::get("address");
		$phone_number = Input::get("phoneNumber");

		// Validate
		if(empty($username) || empty($password) || empty($confirmPassword) || empty($name) || empty($address) || empty($phone_number)){
			return View::make("register", array("message" => "Please fill in all fields before registering"));
		}
		if(!is_numeric($phone_number) || !(strlen($phone_number) == 6)){
			return View::make("register", array("message" => "Please enter a valid phone number (ie. 6043219352)"));
		}

		log::info("Received: ");
		log::info($username);
		log::info($password);
		log::info($confirmPassword);
		log::info($name);
		log::info($address);
		log::info($phone_number);

		if($password != $confirmPassword){
			log::info("Passwords do not match");
			return View::make("register", array("message" => "Passwords do not match"));
		}

		$hashedPassword = Hash::make($password);

		try{
			DB::table("customer")->insert(array(
				"username" => $username,
				"password" => $hashedPassword,
				"name" => $name,
				"address" => $address,
				"phone" => $phone_number
			));

			log::info("User successfully added");

			if(Auth::attempt(array("username" => $username, "password" => $password))){
				return View::make("customer", array("user" => $username, "message" => "Successfully logged in"));
			}

			return View::make("customer", array("message" => "Thanks for registering"));
		} catch(Exception $e){
			return View::make("customer", array("message" => "There was a problem registering. The username may already be taken"));
		}
		
	}

	public function login(){
		log::info("POST login");
		$username = Input::get("username");
		$password = Input::get("password");
		// Validate
		if(empty($username) || empty($password)){
			return View::make("hello", array("message" => "Please fill in all fields before logging in"));
		}

		if(Auth::attempt(array("username" => $username, "password" => $password))){
			return View::make("customer", array("user" => $username, "message" => "Successfully logged in"));
		} else{
			return View::make("hello", array("message" => "Invalid credentials"));
		}

	}

	public function logout(){
		log::info("POST logout");
		// $cookie = Cookie::forget("user");
		Auth::logout();
		return View::make("hello", array("message" => "Logged out"));
	}

}