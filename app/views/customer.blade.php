@extends('partials.master');

@section('content')
<div class="jumbotron text-center" style="background-color: white">
	<div class="container">
		<h1 style="color: #FF8000">Explore!</h1>
		<p style="color: #8A4B08">Find your favorite songs here</p>
		{{ HTML::image('https://lh5.ggpht.com/qy9vdQuksSTG3brgJe3OaND7XtxNquLxC2n2U6E_1UDafqLWj_DSCvlXZr_6RRmQcns=w300', 'basket', array('height' => 150))}}
	</div>	
</div>

{{ Form::open(array('action' => 'CustomerController@searchItem')) }}
{{ Form::label('searchCaption', 'Search By:', array('style' => 'color: #8A4B08')) }}
<br>
{{ Form::label('category', 'Category:', array('style' => 'color: #8A4B08')) }}
{{ Form::text('categoryInput', '', array('placeholder' => 'Rock', 'style' => 'color: #8A4B08'))}}

{{ Form::label('title', 'Title:', array('style' => 'color: #8A4B08')) }}
{{ Form::text('titleInput', '', array('placeholder' => 'Album Title', 'style' => 'color: #8A4B08'))}}

{{ Form::label('artist', 'Artist:', array('style' => 'color: #8A4B08')) }}
{{ Form::text('artistInput', '', array('placeholder' => 'Justin Bieber', 'style' => 'color: #8A4B08'))}}

{{ Form::submit('Search Item', array('class' => 'btn btn-primary'))}}
{{ Form::close() }}



<?php
if (!Auth::check())
{
    // The user is logged in...
	echo("<h4><b>Please login to purchase items.</b></h4>");
}
?>

<section id="demo" style="position: relative; width: 100%" ng-controller="itemsController" ng-init="albums=[]">


	
	<article class="white-panel" ng-repeat="x in albums" style="position: absolute; border-style: solid; border-width: 1px; padding: 10px">
		<h1><a href="#">Album: @{{ x.title }}</a></h1>
		<hr>
		<h2>Artist: @{{ x.leadSinger }}</h2>
		<h4>In Stock: @{{ x.stock }}</h4>
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

@stop

@section('scripts')
<script src="js/customer.js"></script>
<script>
	$("#managerMenu").addClass("active");
</script>
@stop