@extends('partials.master');

@section('content')

<div class="jumbotron text-center" style="background-color: white">
	<div class="container">
		<h1 style="color: #FF8000">Not satisfied?</h1>
		<p style="color: #8A4B08">No problem! Manage refunds of items here.</p>
		{{ HTML::image('http://www.tutorialsscripts.com/free-icons/download-icons/orange-download-icon-256-x-256.gif', 'refund', array('height' => 150))}}

		
	</div>
</div>

<form role="form" class="col-lg-4" action="checkRefund" method="POST">
	<h2 style='color: #8A4B08'>Refund Items</h2>
  <div class="form-group" style="box-shadow: 5px 5px 5px #888888">
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