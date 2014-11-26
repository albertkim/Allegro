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

		// create the order object
		var order = {
			card_num: "1234",
			expiryDate: "2014-09-27",
			deliveredDate: "2014-09-30",
			items: cartItems
		};

		$http.post("buyItems", order).success(function(response){
			setMessage(response);
			// clear cart after purchase
			cartItems = [];
		}).error(function(response){
			setMessage(response);
		});
	};

	var init = function(){
		$scope.cartItems = cartItems;
		// get list of previously purchased items from user
		$http.get("getPurchasedItems").success(function(response){
			console.log(response);
			$scope.purchasedItems = response;
		});
	};

	init();

});