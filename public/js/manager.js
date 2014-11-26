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
			category: $scope.category,
			year: $scope.year,
			company: $scope.company,
			price: $scope.price,
			stock: $scope.stock,
			songs: $scope.songs
		};

		console.log(album);

		// send the album object to server
		$http.post("addAlbum", album).success(function(response){
			console.log(response);
			setMessage(response);
		}).error(function(response){
			setMessage(response);
		});
	},

	$scope.deleteSong = function(index){
		$scope.songs.splice(index, 1);
	}

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
	}

});

function isNormalInteger(str) {
    var n = ~~Number(str);
    return String(n) === str && n >= 0;
}