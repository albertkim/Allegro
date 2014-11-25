@extends('partials.master');

@section('content')

<div class="jumbotron text-center" style="background-color: black">
	<div class="container">
		<h1 style="color: #FFFFFF">Dashboard</h1>
		<p style="color: #C0C0C0">Manage refunds of items here</p>
	</div>
</div>

<div class="col-lg-4" ng-controller="checkRefundController" ng-init="">
		<div class="row">
			<div class="col-lg-12">
				<h2>Refund Items</h2>

				<!-- <form> -->
	    <div class="form-group">
	      <label>Receipt Id:</label>
	      <input class="form-control" ng-model="receiptId" name="receiptId" id="receiptId" placeholder="000000">
	      </div>

	      <button id="checkRefundController" class="btn btn-primary" ng-click="checkRefund()">Refund Item</button>
	    
	    @if(Session::has('refundedMsg'))
	    	<div class = "alert alert-info">{{ Session::get('refundedMsg')}}</div>
	    @endif

	    @if(Session::has('daysMsg'))
	    	<div class = "alert alert-info">{{ Session::get('daysMsg')}}</div>
	    @endif

	     @if(Session::has('receiptMsg'))
	    	<div class = "alert alert-info">{{ Session::get('receiptMsg')}}</div>
	    @endif


</div>

@stop

<script src="js/customer.js"></script>
<script>
	$("#clerkMenu").addClass("active");
</script>
@stop