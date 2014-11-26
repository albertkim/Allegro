@extends('partials.master');

@section('content')

<div class="jumbotron text-center" style="background-color: black">
	<div class="container">
		<h1 style="color: #FFFFFF">Dashboard</h1>
		<p style="color: #C0C0C0">Manage the status of your store here</p>
	</div>
</div>
	
	<div class="col-lg-8">
		<div class="row">
			<div class="col-lg-12">
				<h2>Top 5 items:</h2>
				<br>
				<table class="table" ng-controller="topItemsController" ng-init="topItems=[]">
					<tr>
						<th>Album title</th>
						<th>Times sold</th>
					</tr>
					<tr ng-repeat="item in topItems">
						<td>@{{ item.TITLE }}</td>
						<td>@{{ item.SUM }}</td>
					</tr>
				</table>
			</div>
		</div> <!-- row -->

		<div class="row">
			<div class="col-lg-12">
				<h2>Daily Sales Report:</h2>
				<hr>
			<form class="form-group" action="getDailySalesReport" method="POST">
		    <div class="form-group">
		      <label>Select date:</label>
		      <input class="form-control" id="reportDate" placeholder="YYYY-MM-DD"></input>
		    </div>
		    <button type="submit" class="btn btn-primary">Get report</button>
			</form>
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
		</div> <!-- row -->
	</div>

	<div class="col-lg-4" ng-controller="addAlbumController" ng-init="songs=[]">
		<h2>Add an album</h2>
		<hr>
		<button id="addAlbum" class="btn btn-primary" ng-click="addAllSongs()">Auto-populate</button>
		<hr>
	  <!-- <form> -->
	    <div class="form-group">
	      <label>Album Title:</label>
	      <input class="form-control" ng-model="title" name="title" id="title" placeholder="Baby">
	    </div>
	    <div class="form-group">
	      <label>Artist Name</label>
	      <input class="form-control" ng-model="artist" id="artist" placeholder="Justin Bieber">
	    </div>
	    <div class="form-group">
	      <label>Genre</label>
	      <input class="form-control" ng-model="category" name="category" id="category" placeholder="Heavy Metal">
	    </div>
	    <div class="form-group">
	      <label>Year</label>
	      <input class="form-control" ng-model="year" name="year" id="year" placeholder="2020">
	    </div>
	    <div class="form-group">
	      <label>Company</label>
	      <input class="form-control" ng-model="company" name="company" id="company" placeholder="MouseVille">
	    </div>
	    <div class="form-group">
	      <label>Price</label>
	      <input class="form-control" ng-model="price" name="price" id="price" placeholder="$30">
	    </div>
	    <div class="form-group">
	      <label>Stock</label>
	      <input class="form-control" ng-model="stock" name="stock" id="stock" placeholder="5">
	    </div>
	    <div id="songContainer" class="form-group col-lg-12">
	    	<label>Songs:</label>
	    	<div class="song" ng-model="song" ng-repeat="x in songs">
	    		<div class="col-lg-8">
		    		<p>@{{ "Song title: " + x.title}}</p>
	    		</div>
	    		<div class="col-lg-4">
	    			<button class="btn btn-secondary" ng-click="deleteSong($index)">Delete</button>
	    		</div>
	    		<hr><br>
	    	</div>
	    </div>

	    <div class="form-group">
	      <label>Song Name</label>
	      <input id="songInput" class="form-control" ng-model="songTitle" id="songTitle" placeholder="Baby">
	    </div>
	    <button id="addAlbum" class="btn btn-primary" ng-click="addSong()">Add Song</button>
	    <button id="addAlbum" class="btn btn-primary pull-right" ng-click="addAlbum()">Submit Album</button>
	  <!-- </form> -->
  </div>

@stop

@section('scripts')
<script src="js/manager.js"></script>
<script>
	$(document).ready(function(){
		$("#managerMenu").addClass("active");
	});
</script>
@stop