// This file will be loaded alongside the Manager page
var app = angular.module("Allegro", []);

app.controller("addAlbumController", function($scope, $http){
	$scope.addSong = function(){
		// don't allow duplicate songs
		$scope.songs.push({
			songName: $scope.songName,
			artistName: $scope.artistName
		});
	},

	$scope.addAlbum = function(){
		// make album object
		var album = {
			title: $scope.title,
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
			console.log("RESPONSE: " + response);
		});
	},

	$scope.deleteSong = function(index){
		$scope.songs.splice(index, 1);
	}
});