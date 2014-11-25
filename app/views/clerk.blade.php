@extends('partials.master');

@section('content')

<div class="jumbotron text-center" style="background-color: black">
	<div class="container">
		<h1 style="color: #FFFFFF">Not satisfied?</h1>
		<p style="color: #C0C0C0">No problem! Manage refunds of items here.</p>
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
	    
		<br>
		<br>

	    {{Form::open(array('action' => 'ClerkController@checkRefund')) }}

	    {{Form::label('label_name', 'Receipt Id:')}}

	    <br>

	    {{Form::text('receipt_id', '000000')}}

	   	<br>
	    <br>

	   @if ($message = Session::get('message'))
<div class="alert alert-success alert-block">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<h4>Success</h4>
	{{ $message }}
</div>
@endif

	    {{Form::submit('Refund')}}

	    {{ Form::close()}}
	   



</div>

@stop

@section('scripts')
<script src="js/customer.js"></script>
<script>
	$("#clerkMenu").addClass("active");
</script>
@stop