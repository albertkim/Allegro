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

		var quantity = $(".quantity:eq(" + index + ")").val();
		if(quantity > album.stock){
			setMessage("You cannot order more than what's in stock");
			return;
		}

		if(_.findWhere(cartItems, album) == undefined){
			album.quantity = quantity;
			cartItems.push(album);
			$("#cart").show();
		} else{
			_.findWhere(cartItems, album).quantity = quantity;
		}
		
	};

	$scope.search = function(){
		var category = $scope.categoryInput;
		var title = $scope.titleInput;
		var artist = $scope.artistInput;
		var request = {
			category: category,
			title: title,
			artist: artist
		}
		$http.post("searchItem", request).success(function(response){
			console.log(response);
			$scope.albums = response;
		});

	}

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
			location.reload();
		}).error(function(response){
			setMessage(response);
		});
	};

});