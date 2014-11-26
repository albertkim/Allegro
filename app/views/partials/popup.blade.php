<div id="popup" hidden>
	<div class="container" style="padding-top: 50px">
		<h4 id="message"></h4>
		<button id="closePopup" class="btn btn-primary" style="position: absolute; bottom: 10px; right: 20px">Close</button>
	</div>
</div>

<div id="purchasePopup" ng-controller="purchaseController" hidden>
	<div class="container" style="padding-top: 50px">
		<h3>Confirm your purchase</h3>
		<div class="form-group">
    	<label>Credit card number:</label>
    	<input class="form-control input" ng-model="cardnum" placeholder="" style="width: 460px"></input>
  	</div>
		<div class="form-group">
    	<label>Expiry date:</label>
    	<input class="form-control input" ng-model="expiryDate" placeholder="yyyy-mm-dd" style="width: 460px"></input>
  	</div>
  	<h3>We'll try to deliver within one week</h3>
  	<button id="getTopSellingItemsButton" ng-click="buy()" class="btn btn-primary">Buy!</button><br>
	</div>
</div>