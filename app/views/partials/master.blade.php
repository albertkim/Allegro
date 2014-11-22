<html>
	<head>
		<meta charset="UTF-8">
		<title>Laravel PHP Framework</title>

		{{ HTML::style( asset('css/bootstrap.min.css')) }}
		{{ HTML::script('jquery-2.1.1.min.js') }}
		{{ HTML::script('bootstrap.min.js') }}
		{{ HTML::script('handlebars.js') }}
		{{ HTML::script('angular.min.js') }}
		{{ HTML::script('underscore.js') }}
		<!-- Pinterest Jquery plugin: http://www.jqueryscript.net/layout/Simple-jQuery-Plugin-To-Create-Pinterest-Style-Grid-Layout-Pinterest-Grid.html -->
		{{ HTML::script('pinterest_grid.js') }}

	</head>
  <body ng-app="Allegro">
  		Messages: {{{ isset($message) ? $message : "None" }}}
      @section('header')
			<nav class="navbar navbar-default" role="navigation" style="background-color: white">
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
				      	<button id="loginButton" type="submit" class="btn btn-default">button</button>
			      	</form>
			      </div>	<!-- navbar form -->

          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>
      @show

      <div class="container">
				@yield('content')
      </div>
  </body>
  @yield('scripts')
</html>