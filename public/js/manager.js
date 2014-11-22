// This file will be loaded alongside the Manager page
var app = angular.module("Allegro", []);

app.controller("addAlbumController", function($scope){
	$scope.addSong = function(){
		$scope.songs.push({
			songName: $scope.songName,
			artistName: $scope.artistName
		});
	},
	$scope.addAlbum = function(){

	}
});