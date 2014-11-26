@extends('partials.master');

@section('content')

<div class="jumbotron text-center" style="background-color: black">
	<div class="container">
		<h1 style="color: #FFFFFF">Not satisfied?</h1>
		<p style="color: #C0C0C0">No problem! Manage refunds of items here.</p>
	</div>
</div>

<form role="form" class="col-lg-4" action="checkRefund" method="POST">
	<h2>Refund Items</h2>
  <div class="form-group">
    <label>Receipt Id:</label>
    <input class="form-control" name="receiptId" id="receiptId" placeholder="000000">
  </div>
	<button type="submit" class="btn btn-primary">Refund Item</button>
</form>

@stop

@section('scripts')
<script src="js/customer.js"></script>
<script>
	$("#clerkMenu").addClass("active");
</script>
@stop