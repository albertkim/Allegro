@extends('partials.master');

@section('content')
<div class="jumbotron text-center" style="background-color: black">
	<div class="container">
		<h1 style="color: #FFFFFF">Explore!</h1>
		<p style="color: #C0C0C0">Find your favorite songs here</p>
	</div>
</div>
<label>Search By: </label><br>
Category: <input ng-model="category" name="category" id="category" placeholder="Rock">
Title: <input ng-model="title" name="title" id="title" placeholder="Album Title">
Artitst: <input ng-model="artist" name="artiest" id="artist" placeholder="Justin Bieber">
Quantity: <input ng-model="quantity" name="quantity" id="quantity" placeholder="50"> &nbsp;
<button id="search" class="btn btn-primary" ng-click="search()">Search</button>
<br><hr>


<section id="demo" style="position: relative; width: 100%">
 
 	@foreach($albums as $album)
	<article class="white-panel" style="position: absolute; border-style: solid; border-width: 1px; padding: 10px">
		<h1><a href="#">Album: {{ $album->title }}</a></h1><hr>
		<h2>Artist: {{ $album->leadSinger }}</h2>
		<h4>In Stock: {{$album->stock}}</h4>
		<h5>Category: {{$album->category}}</h5><hr>
		@foreach($album->songs as $song)
			<p>Song: {{ $song->title }}</p>
		@endforeach
		<button class="btn btn-primary pull-right">Add to cart</button>
	</article>
	@endforeach

</section>

@stop

@section('scripts')
<script src="js/customer.js"></script>
<script>
	$("#managerMenu").addClass("active");
</script>
@stop