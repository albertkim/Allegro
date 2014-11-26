$("#cartButton").on("click", function(){
	$("#cart").toggle();
});

app.factory("cartItems", function(){
	return [];
});

app.controller("itemsController", function($scope, $http, cartItems){

	$scope.addItemToCart = function(index){
		var album = $scope.albums[index];
		console.log(album);
		if(_.findWhere(cartItems, album) == undefined){
			album.quantity = 1;
			cartItems.push(album);
		} else{
			_.findWhere(cartItems, album).quantity++;
		}
		
	};

	var init = function(){
		$http.get("getItems").success(function(response){
			console.log(response);
			$scope.albums = response;
		}).error(function(response){
			setMessage(response);
		});
	};

	init();

});

app.controller("cartController", function($scope, $http, cartItems){

	$scope.buy = function(){
		$http.post("buyItems", cartItems).success(function(response){
			setMessage(response);
		}).error(function(response){
			setMessage(response);
		});
	};

	var init = function(){
		$scope.cartItems = cartItems;
	};

	init();

});