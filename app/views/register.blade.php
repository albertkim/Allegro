@extends('partials.master');

@section('content')

<div class="col-lg-6">
	<form class="form-group" action="addUser" method="POST">
		<br>
		<div class="form-group">
			<label>Username:</label>
			<input class="form-control input" name="username" placeholder="Username"></input>
		</div>
		<div class="form-group">
			<label>Password:</label>
			<input class="form-control input" name="password" type="password" placeholder="Password"></input>
		</div>
		<div class="form-group">
			<label>Confirm password:</label>
			<input class="form-control input" name="confirmPassword" type="password" placeholder="Confirm password"></input>
		</div>
		<div class="form-group">
			<label>Name:</label>
			<input class="form-control input" name="name" placeholder="BillyBob"></input>
		</div>
		<div class="form-group">
			<label>Address:</label>
			<input class="form-control input" name="address" placeholder="911 Main Street"></input>
		</div>
		<div class="form-group">
			<label>Phone Number:</label>
			<input class="form-control input" name="phoneNumber" placeholder="6043334444"></input>
		</div>
		<button id="registerButton" type="submit" class="btn btn-primary">Register</button>
	</form>
</div>

<div class="col-lg-6">
	<div class="container">
		<h2>Sign up, it's free!</h2>
		<p>Get access to the mest music collection in all of Greater Vancouver</p>
		<p>(Optional) Sign up for our weekly newsletter where we alert you on the hottest deals</p>
	</div>
</div>

@stop