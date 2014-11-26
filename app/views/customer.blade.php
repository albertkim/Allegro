@extends('partials.master');

@section('content')
<div class="jumbotron text-center" style="background-color: black">
	<div class="container">
		<h1 style="color: #FFFFFF">Explore!</h1>
		<p style="color: #C0C0C0">Find your favorite songs here</p>
	</div>	
</div>

{{ Form::open(array('action' => 'CustomerController@searchItem')) }}
{{ Form::label('searchCaption', 'Search By:') }}
<br>
{{ Form::label('category', 'Category:') }}
{{ Form::text('categoryInput', '', array('placeholder' => 'Rock'))}}

{{ Form::label('title', 'Title:') }}
{{ Form::text('titleInput', '', array('placeholder' => 'Album Title'))}}

{{ Form::label('artist', 'Artist:') }}
{{ Form::text('artistInput', '', array('placeholder' => 'Justin Bieber'))}}

{{ Form::label('quantity', 'Quantity:') }}
{{ Form::text('quantityInput', '', array('placeholder' => '10'))}}

{{ Form::submit('Search Item', array('class' => 'btn btn-primary'))}}
{{ Form::close() }}

<!--

<label>Search By: </label><br>
Category: <input ng-model="category" name="category" id="category" placeholder="Rock">
Title: <input ng-model="title" name="title" id="title" placeholder="Album Title">
Artitst: <input ng-model="artist" name="artiest" id="artist" placeholder="Justin Bieber">
Quantity: <input ng-model="quantity" name="quantity" id="quantity" placeholder="50"> &nbsp;

<button type="submit" id="search" class="btn btn-primary" ng-click="search">Search</button>
<br><hr>
-->


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
		<button class="btn btn-primary pull-right" ng-click="addItemToCart($index)">Add to cart</button>
	</article>

</section>

@stop

@section('scripts')
<script src="js/customer.js"></script>
<script>
	$("#managerMenu").addClass("active");
</script>
@stop