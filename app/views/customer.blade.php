@extends('partials.master');

@section('content')

<section id="demo" style="position: relative; width: 100%">
 
	<article class="white-panel" style="position: absolute">
		<h1><a href="#">Album 1</a></h1>
		<p></p>
	</article>
	 
	<article class="white-panel" style="position: absolute">
		<h1><a href="#">Album 2</a></h1>
		<p>Description 2</p>
	</article>
	 
	<article class="white-panel" style="position: absolute">
		<h1><a href="#">Album 3</a></h1>
		<p>Description 3 ASDFHUWHERFQILWE5RFGL;EJ5QWHKLNV-=SDLQRUIA</p>
	</article>

	<article class="white-panel" style="position: absolute">
		<h1><a href="#">Album 4</a></h1>
		<p>Description 4 ASDFHUWHERFQILWE5RFGL;EJ5QWHKLNV-=SDLQRUIA</p>
	</article>

	<article class="white-panel" style="position: absolute">
		<h1><a href="#">Album 5</a></h1>
		<p>Description 5 ASDFHUWHERFQILW E5RFGL;EJ5Q WHKLNV-=SDL WATHU IW; EH;IUAQHUI   HFEWLI QRUIA nfj
		wwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww. NFEWJ.TKLNAJKFNE`QWALJKNNNF EJUEHEJLLNFAEJK;WFHJKHFA
		`5akjnfkjena.ANFJK.WEFJKNA W5EFKL.KJANWE5KN/ NWN. AF.KJ `5WTA/FEWALJNF`EKN EFNJAK`QWEN</p>
	</article>

	<article class="white-panel" style="position: absolute">
		<h1><a href="#">Album 6</a></h1>
		<p>Description 6 FWHAUQISL\UHFU28U589234TUYIOLHWEAFJKL</p>
	</article>

</section>

<script>
	$(document).ready(function() {
		$('#demo').pinterest_grid({
		no_columns: 3,
		padding_x: 10,
		padding_y: 10,
		margin_bottom: 50,
		single_column_breakpoint: 700
		});
	});
</script>

@stop

@section('scripts')
<script>
	$(document).ready(function(){
		$("#customerMenu").addClass("active");
	});
</script>
@stop