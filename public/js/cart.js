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
		$("#purchasePopup").show();
	};

	var init = function(){
		$scope.cartItems = cartItems;
		// get list of previously purchased items from user
		$http.get("getPurchasedItems").success(function(response){
			$scope.purchasedItems = response;
		});
	};

	init();

});

app.controller("purchaseController", function($scope, $http, cartItems){

	$scope.buy = function(){

		$("#purchasePopup").hide();

		console.log(cartItems);

		if(cartItems.length == 0){
			setMessage("There are no items in the cart");
			return;
		}

		// create the order object
		var order = {
			card_num: Number($scope.cardnum),
			expiryDate: $scope.expiryDate,
			items: cartItems
		};

		$http.post("buyItems", order).success(function(response){
			setMessage(response);
			// clear cart after purchase
			cartItems = [];
			$scope.cartItems = [];
			init();
		}).error(function(response){
			setMessage(response);
		});
	};

});