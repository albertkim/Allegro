@extends('partials.master');

@section('content')
<div ng-controller="itemsController" ng-init="albums=[]">
	<div class="jumbotron text-center" style="background-color: white">
		<div class="container">
			<h1 style="color: #FF8000">Explore!</h1>
			<p style="color: #8A4B08">Find your favorite songs here.</p>
			{{ HTML::image('https://lh5.ggpht.com/qy9vdQuksSTG3brgJe3OaND7XtxNquLxC2n2U6E_1UDafqLWj_DSCvlXZr_6RRmQcns=w300', 'basket', array('height' => 150))}}
		</div>	
	</div>

	<div class="ng-pristine ng-valid">
		<label for="searchCaption" style="color: #8A4B08">Search By:</label>
		<br>
		<label for="category" style="color: #8A4B08">Category:</label>
		<input placeholder="Rock" style="box-shadow: 2px 2px 1px #888888" ng-model="categoryInput" type="text" value="">

		<label for="title" style="color: #8A4B08">Title:</label>
		<input placeholder="Album Title" style="box-shadow: 2px 2px 1px #888888" ng-model="titleInput" type="text" value="">

		<label for="artist" style="color: #8A4B08">Artist:</label>
		<input placeholder="Justin Bieber" style="box-shadow: 2px 2px 1px #888888" ng-model="artistInput" type="text" value="">

		<button class="btn btn-primary" ng-click="search()">Search Item</button>
	</div>

	<?php
	if (!Auth::check())
	{
	    // The user is logged in...
		echo("<h4><b>Please login to purchase items.</b></h4>");
	}
	?>

	<section id="demo" style="position: relative; width: 100%">
		
		<article class="white-panel" ng-repeat="x in albums" style="position: absolute; border-style: solid; border-width: 1px; padding: 10px">
			<h1><a href="#">Album: @{{ x.title }}</a></h1>
			<hr>
			<h2>Artist: @{{ x.leadSinger }}</h2>
			<h4><h4>In Stock: @{{ x.stock }}</h4></h4>
			<h5>Category: @{{ x.category }}</h5>
			<h5>Year: @{{ x.year }}</h5>
			<hr>
			<p ng-repeat="song in x.songs">
				Song: @{{ song.title }}
			</p>
			<label> Quantity: </label>	
			<input class='quantity' name='quantity' id='quantity' placeholder='0'></input>
			<button class='btn btn-primary pull-right' ng-click='addItemToCart($index)'>Add to cart</button>
			
		</article>

	</section>
</div>

@stop

@section('scripts')
<script src="js/customer.js"></script>
<script>
	$("#managerMenu").addClass("active");
</script>
@stop