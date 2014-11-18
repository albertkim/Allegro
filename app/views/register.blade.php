@extends('partials.master');

@section('content')

<div class="col-lg-6">
	<form class="form-group" action="register">
		<br>
		<div class="form-group">
			<label>Email:</label>
			<input class="form-control input" placeholder="Email"></input>
		</div>
		<div class="form-group">
			<label>Password:</label>
			<input class="form-control input" type="password" placeholder="Password"></input>
		</div>
		<div class="form-group">
			<label>Confirm password:</label>
			<input class="form-control input" type="password" placeholder="Confirm password"></input>
		</div>
		<button id="registerButton" type="submit" class="btn btn-primary">Reigister</button>
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