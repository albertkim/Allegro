@extends('partials.master');

@section('content')

<div class="jumbotron text-center" style="background-color: black">
	<div class="container">
		<h1 style="color: #FFFFFF">Dashboard</h1>
		<p style="color: #C0C0C0">Manage the status of your store here</p>
	</div>
</div>

<div class="row">
	<div class="col-lg-8">
		<h2>Top selling items:</h2>
		<br>
		<table class="table">
			<tr>
				<th>UPC</th>
				<th>Category</th>
				<th>Price</th>
				<th>Units</th>
				<th>Total value</th>
			</tr>
			<tr>
				<td>2244</td>
				<td>Classical</td>
				<td>10.50</td>
				<td>10</td>
				<td>105.00</td>
			</tr>
			<tr>
				<td>2245</td>
				<td>Rock</td>
				<td>5.00</td>
				<td>15</td>
				<td>20.00</td>
			</tr>
		</table>
	</div>
	<div class="col-lg-4">
		Something
	</div>
</div>

<div class="row">

	<div class="col-lg-8">
		<h2>Daily Sales Report:</h2>
		<hr>
    <div class="form-group">
      <label>Select date:</label>
      <input class="form-control" id="date" placeholder="YYYY/MM/DD">
    </div>
    <button type="submit" class="btn btn-primary">Get report</button>
		<h3>Items sold:</h3>
		<table class="table">
			<tr>
				<th>UPC</th>
				<th>Category</th>
				<th>Price</th>
				<th>Units</th>
				<th>Total value</th>
			</tr>
			<tr>
				<td>2244</td>
				<td>Classical</td>
				<td>10.50</td>
				<td>10</td>
				<td>105.00</td>
			</tr>
			<tr>
				<td>2245</td>
				<td>Rock</td>
				<td>5.00</td>
				<td>15</td>
				<td>20.00</td>
			</tr>
		</table>

	</div>

	<div class="col-lg-4">
		<h2>Add an album</h2>
		<hr>
	  <form>
	    <div class="form-group">
	      <label>Album Name:</label>
	      <input class="form-control" id="albumName" placeholder="XYZ">
	    </div>
	    <div class="form-group">
	      <label>Artist Name</label>
	      <input class="form-control" id="artistName" placeholder="Justin Bieber">
	    </div>
	    <div>
	    	Songs:
	    </div>
	    <hr>
	    <div class="form-group">
	      <label>Song Name</label>
	      <input class="form-control" id="songName" placeholder="Baby">
	    </div>
	    <div class="checkbox">
	      <label><input type="checkbox"> Explicit</label>
	    </div>
	    <button type="submit" class="btn btn-primary">Add</button>
	  </form>

  </div>

<div class="row">
@stop

@section('scripts')
<script>
	$(document).ready(function(){
		$("#managerMenu").addClass("active");
	});
</script>
@stop