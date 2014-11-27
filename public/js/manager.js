$("#cart").hide();

app.controller("addAlbumController", function($scope, $http){
	$scope.addSong = function(){
		// don't allow duplicate songs
		$scope.songs.push({
			title: $scope.songTitle,
		});
		$("#songInput").val("");
	},

	$scope.addAlbum = function(){
		// form validation
		if(!isNormalInteger($scope.year)){
			setMessage("Year must be an integer");
			return;
		}
		if(!isNormalInteger($scope.price)){
			setMessage("Price must be an integer");
			return;
		}
		if(!isNormalInteger($scope.stock)){
			setMessage("Stock must be an integer");
			return;
		}

		// make album object
		var album = {
			title: $scope.title,
			artist: $scope.artist,
			type: $scope.type,
			category: $scope.category,
			year: Number($scope.year),
			company: $scope.company,
			price: Number($scope.price),
			stock: Number($scope.stock),
			songs: $scope.songs
		};

		console.log(album);

		// send the album object to server
		$http.post("addAlbum", album).success(function(response){
			console.log(response);
			setMessage("Album successfully added");
		}).error(function(response){
			setMessage("Error adding album");
		});
	},

	$scope.deleteSong = function(index){
		$scope.songs.splice(index, 1);
	},

	$scope.addAllSongs = function(){
		var albums = [
			{
				title: "4x4=12",
				artist: "Deadmau5",
				type: "CD",
				category: "Electronic",
				year: 2010,
				company: "Mau5trap",
				price: 15,
				stock: 20,
				songs: [
					{title: "I Said"},
					{title: "Sofi Needs a Ladder"},
					{title: "Some Chords"},
					{title: "Animal Rights"},
					{title: "Right This Second"},
					{title: "Raise Your Weapon"}
				]
			},
			{
				title: "MGMT",
				artist: "MGMT",
				type: "CD",
				category: "Electronic",
				year: 2013,
				company: "Columbia",
				price: 15,
				stock: 20,
				songs: [
					{title: "Alien Days"},
					{title: "Cool Song No. 2"},
					{title: "Mystery Disease"},
					{title: "Introspection"},
					{title: "A Good Sadness"},
					{title: "An Orphan of Fortune"}
				]
			}
		];

		for(var i=0; i<albums.length; i++){
			$http.post("addAlbum", albums[i]).success(function(response){
				console.log(response);
			});
		}
		setMessage("Songs added");
	};

})

function isNormalInteger(str) {
    var n = ~~Number(str);
    return String(n) === str && n >= 0;
}

app.controller("topItemsController", function($scope, $http){

	$scope.getTopItemsByDate = function(){
		var request = {
			date: $scope.topItemsDate,
			number: $scope.numTopItems
		};
		$http.post("getTopItemsByDate", request).success(function(response){
			console.log(response);
			$scope.topItems = response;
			$scope.topItemsDateView = $scope.topItemsDate;
			$scope.numTopItemsView = $scope.numTopItems;
		});
	}

	var init = function(){
		$http.get("getTopItems").success(function(response){
			console.log(response);
			$scope.topItems = response;
		});
	};

	init();
});

app.controller("topItemsByDateController", function($scope, $http){
	var init = function(){

	};

	init();
});

app.controller("dailyReportController", function($scope, $http){

	$scope.getDailyReport = function(){
		var request = {
			date: $scope.dailyReportDate
		}
		$http.post("getDailyReport", request).success(function(response){
			console.log(response);
			$scope.dailyReportItems = response;
		});
	},

	$scope.totalUnits = function(){
    var total = 0;
    angular.forEach($scope.dailyReportItems, function(item) {
        total += Number(item.sum);
    })

    return total;
	}

	$scope.totalValue = function(){
    var total = 0;
    angular.forEach($scope.dailyReportItems, function(item) {
        total += item.price * item.sum;
    })

    return total;
	}

});

app.controller("deliveryController", function($scope, $http){

	$scope.setDeliveryDate = function(index){
		console.log("Setting delivery");
		var date = $scope.deliveryDate;
		var order = $scope.undeliveredOrders[index];
		var request = {
			date: date,
			id: order.id
		};
		$http.post("setDeliveryDate", request).success(function(response){
			console.log(response);
			$scope.undeliveredOrders.splice(index, 1);
			setMessage(response);
		}).error(function(){
			setMessage("The delivery date could not be set due to an error");
		});
	}

	var init = function(){
		$http.get("getUndeliveredOrders").success(function(response){
			console.log(response);
			$scope.undeliveredOrders = response;
		});
	}

	init();

});