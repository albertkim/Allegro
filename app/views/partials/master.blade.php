<html>
	<head>
		<meta charset="UTF-8">
		<title>CPSC 304 - Allegro Music Store!</title>

		{{ HTML::style( asset('css/bootstrap.min.css')) }}
		{{ HTML::style( asset('css/cart.css')) }}

		{{ HTML::script('jquery-2.1.1.min.js') }}
		{{ HTML::script('bootstrap.min.js') }}
		{{ HTML::script('handlebars.js') }}
		{{ HTML::script('angular.min.js') }}
		{{ HTML::script('underscore.js') }}
		<!-- Pinterest Jquery plugin: http://www.jqueryscript.net/layout/Simple-jQuery-Plugin-To-Create-Pinterest-Style-Grid-Layout-Pinterest-Grid.html -->
		{{ HTML::script('pinterest_grid.js') }}

	</head>
  <body ng-app="Allegro">
    @section('header')

		<nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="background-color: white">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/Allegro/public">ALLEGRO</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="customer">Customer</a></li>
            <li><a href="clerk">Clerk</a></li>
            <li><a href="manager">Manager</a></li>
          </ul>

          @if(Auth::check())
          <div class="nav navbar-form navbar-right">
          	<button id="cartButton" class="btn btn-default">Cart</button>
          </div>
		      <div class="nav navbar-form navbar-right">
		      	<form role="form" action="logout" method="POST">
			      	<div class="form-group" hidden>
			      		<input id="usernameInput" name="username" type="text" class="form-control">
			      	</div>
			      	<button id="logoutButton" type="submit" class="btn btn-default">Logout</button>
		      	</form>
		      </div>

		      <!-- shopping cart -->
		      <div id="cart" ng-controller="cartController" ng-model="cartItems">
		      	<div class="container">
			      	<h3>Shopping cart (@{{ cartItems.length  }})</h3>
			      	<hr>
			      	<div ng-model="cartItem" ng-repeat="item in cartItems">
			      		<p>@{{ "Album: " + item.title }}</p>
			      		<p>@{{ "Quantity: " + item.quantity}}
			      		<hr>
			      	</div>
			      	<button class="btn btn-primary" ng-click="buy()">Buy</button>
		      	</div>
		      </div>

		      @else
          <ul class="nav navbar-nav navbar-right">
            <li><a id="registerButton" href="register" class="btn btn-default">Register</a></li>
          </ul>
		      <div class="nav navbar-form navbar-right">
		      	<form role="form" action="login" method="POST">
			      	<div class="form-group">
			      		<input id="usernameInput" name="username" type="text" class="form-control" placeholder="Username">
			      	</div>
			      	<div class="form-group">
			      		<input id="passwordInput" name="password" type="password" class="form-control" placeholder="Password">
			      	</div>
			      	<button id="loginButton" type="submit" class="btn btn-default">Login</button>
		      	</form>
		      </div>	<!-- navbar form -->
		      @endif

        </div><!--/.nav-collapse -->
      </div><!--/.container-fluid -->
    </nav>
    <div style="height: 50px"></div>
    @show

    <div class="container">
			@yield('content')
    </div>

    <div style="height: 70px"></div>

		<nav class="navbar navbar-default navbar-fixed-bottom">
			<div class="navbar-inner navbar-content-center">
				<div id="footer" class="footer">
					<div class="container">
						<p id="message">{{{ isset($message) ? $message : "Welcome" }}}</p>
					</div>
				</div>
			</div>
		</nav>

  </body>
  <script>
  	var app = angular.module("Allegro", []);
  	// global function for setting message
  	var setMessage = function(message){
  		$("#message").text(message);
  	}
  </script>
  @yield('scripts')
  <script src="js/cart.js"></script>
</html>