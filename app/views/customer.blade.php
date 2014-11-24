@extends('partials.master');

@section('content')

<section id="demo" style="position: relative; width: 100%">
 
 	@foreach($albums as $album)
	<article class="white-panel" style="position: absolute; border-style: solid; border-width: 1px; padding: 10px">
		<h1><a href="#">Album: {{ $album->title }}</a></h1>
		<h2>Artist: {{ $album->leadSinger }}</h2>
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