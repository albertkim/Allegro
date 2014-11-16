<html>
	<head>
		<meta charset="UTF-8">
		<title>Laravel PHP Framework</title>

		{{ HTML::style( asset('css/bootstrap.min.css')) }}
		{{ HTML::script('jquery-2.1.1.min.js') }}
		{{ HTML::script('bootstrap.min.js') }}
		<!-- Pinterest Jquery plugin: http://www.jqueryscript.net/layout/Simple-jQuery-Plugin-To-Create-Pinterest-Style-Grid-Layout-Pinterest-Grid.html -->
		{{ HTML::script('pinterest_grid.js') }}

	</head>
  <body>
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
            <a class="navbar-brand" href="/Allegro/public">Allegro</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li><a href="#">About</a></li>
              <li><a href="#">FAQ</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#">Action</a></li>
                  <li><a href="#">Another action</a></li>
                  <li><a href="#">Something else here</a></li>
                  <li class="divider"></li>
                  <li class="dropdown-header">Nav header</li>
                  <li><a href="#">Separated link</a></li>
                  <li><a href="#">One more separated link</a></li>
                </ul>
              </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li id="customerMenu"><a href="customer">Customer</a></li>
              <li id="clerkMenu"><a href="clerk">Clerk</a></li>
              <li id="managerMenu"><a href="manager">Manager</a></li>
            </ul>
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