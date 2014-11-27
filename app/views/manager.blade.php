@extends('partials.master');

@section('content')

<div class="jumbotron text-center" style="background-color: white">
	<div class="container">
		<h1 style="color: #FF8000">Hello Boss. </h1>
		<p style="color: #8A4B08">Welcome back. Let's do our job. </p>
		{{ HTML::image('http://macombcountymi.gov/CLERKSOFFICE/images/icon_document.png', 'boss', array('height' => 150))}}


	</div>
</div>
	
	<div class="col-lg-8">
		<div class="row" ng-controller="topItemsController" ng-init="topItems=[]; numTopItemsView=5; topItemsDateView='all time'">
			<div class="col-lg-12" style="box-shadow: 5px 5px 5px #888888">

		      <label> Select date:</label>
		      <input ng-model="topItemsDate" placeholder="YYYY-MM-DD"></input>
		      <label>Number of elements:</label>
		      <input ng-model="numTopItems" placeholder="5"></input>
		      <button type="submit" class="btn btn-primary" ng-click="getTopItemsByDate()">Get items</button>

				<h2 style="color: #8A4B08">Top @{{ numTopItemsView }} items for @{{ topItemsDateView }}:</h2>
				<br>
				<table class="table">
					<tr>
						<th>Album title</th>
						<th>Company</th>
						<th>In stock</th>
						<th>Times sold</th>
					</tr>
					<tr ng-repeat="item in topItems">
						<td>@{{ item.title }}</td>
						<td>@{{ item.company }}</td>
						<td>@{{ item.stock }}</td>
						<td>@{{ item.sum }}</td>
					</tr>
				</table>
			</div>

		</div> <!-- row -->

		<div class="row" ng-controller="dailyReportController", ng-init="dailyReportItems=[]" style="box-shadow: 5px 5px 5px #888888">
			<div class="col-lg-12">
				<h2 style="color: #8A4B08">Daily Sales Report:</h2>
				<hr>
		    <div class="form-group">
		      <label >Select date:</label>
		      <input class="form-control" ng-model="dailyReportDate" placeholder="YYYY-MM-DD"></input>
		    </div>
		    <button type="submit" class="btn btn-primary" ng-click="getDailyReport()">Get report</button>
				<h3 style="color: #8A4B08">Items sold:</h3>
				<table class="table">
					<tr>
						<th>UPC</th>
						<th>Category</th>
						<th>Price</th>
						<th>Units</th>
						<th>Total value</th>
					</tr>
					<tr ng-repeat="item in dailyReportItems">
						<td>@{{ item.upc }}</td>
						<td>@{{ item.category }}</td>
						<td>@{{ item.price }}</td>
						<td>@{{ item.sum }}</td>
						<td>@{{ item.sum * item.price }}</td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td>Total daily units: @{{ totalUnits() }}</td>
						<td>Total daily sales:  @{{ totalValue() }}</td>
					</tr>
				</table>
			</div>
		</div> <!-- row -->

		<div class="row">
			<div class="col-lg-8" ng-controller="deliveryController" ng-init="undeliveredOrders=[]; deliveryDates=[]" style="box-shadow: 5px 5px 5px #888888">
				<h2 style="color: #8A4B08">Set delivery dates</h2>
				<br>
				<table class="table">
					<tr>
						<th>Receipt ID</th>
						<th>Expected Date</th>
						<th>Delivery Date</th>
						<th></th>
					</tr>
					<tr ng-repeat="order in undeliveredOrders">
						<td>@{{ order.id }}</td>
						<td>@{{ order.expectedDate }}</td>
						<td><input class="deliveryDate" placeholder="YYYY-MM-DD"></input></td>
						<td><button class="btn btn-secondary" ng-click="setDeliveryDate($index)">Set delivery date</button></td>
					</tr>
				</table>
			</div>
		</div>

	</div>

	<div class="col-lg-4" ng-controller="addAlbumController" ng-init="songs=[]" style="box-shadow: 5px 5px 5px #888888">
		<h2 style="color: #8A4B08">Add an album</h2>
		<hr>
		<button id="addAlbum" class="btn btn-primary" ng-click="addAllSongs()">Auto-populate</button>
		<hr>
	  <!-- <form> -->
	  <div class="form-group">
	      <label>Type: </label>
	      <select ng-model="type" name="type" id="type">
					<option value="CD">CD</option>
					<option value="DVD">DVD</option>
				</select>
	    </div>
	    <div class="form-group">
	      <label>Album Title:</label>
	      <input class="form-control" ng-model="title" name="title" id="title" placeholder="Baby">
	    </div>
	    <div class="form-group">
	      <label>Artist Name</label>
	      <input class="form-control" ng-model="artist" id="artist" placeholder="Justin Bieber">
	    </div>
	    <div class="form-group">
	      <label>Genre: </label>
	      <select ng-model="category" name="category" id="category">
					<option value="Rock">Rock</option>
					<option value="Pop">Pop</option>
					<option value="Rap">Rap</option>
					<option value="Country">Country</option>
					<option value="Classical">Classical</option>
					<option value="New Age">New Age</option>
					<option value="Instrumental">Instrumental</option>
				</select>
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