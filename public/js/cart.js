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
			cartItems.push(album);
		} else{
			setMessage("Item is already in cart");
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

	var init = function(){
		$scope.cartItems = cartItems;
	};

	init();

});