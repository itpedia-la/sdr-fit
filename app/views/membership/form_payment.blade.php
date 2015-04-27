@include('layout.header')
<h3>Membership</h3>
<hr class="hrHeader"/>
<div align="center">
<div class="k-block extended auto" style="width:40%">
<div class="floatLeft">Membership Payment</div>
<div class="floatRight">

</div>
<div class="ClearFix"></div>
<hr/>
@if ($errors->has())<div class="message green">{{ $errors->all()['0'] }}</div>@endif
<form method="post" action="{{ URL::to('membership/payment/save') }}">
<input type="hidden" name="membership_id" value="{{Route::input('membership_id')}}">
<table class="tableStyling" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td>Payment Method: *</td>
		<td><input type="text" name="payment_method" id="payment_method"></td>
	</tr>

	<tr>
		<td>Total :</td>
		<td><input type="text" name="total" id="total" value="{{ number_format($package->price) }}" readonly="readonly" > LAK ({{ $package->name }})</td>
	</tr>
	<tr>
		<td>Discount:</td>
		<td><input type="text" name="discount" id="discount" value="0"> %</td>
	</tr>
	
	
	<!--  <tr>
		<td>Cahs in THB:</td>
		<td><input type="text" name="dob" id="dob" value="@if(Input::old('dob')){{ Input::old('dob') }}@else{{@$member->dob}}@endif"></td>
	</tr>
	<tr>
		<td>Cahs in USD:</td>
		<td><input type="text" name="dob" id="dob" value="@if(Input::old('dob')){{ Input::old('dob') }}@else{{@$member->dob}}@endif"></td>
	</tr>-->
	<tr>
		<td>Payment Date:</td>
		<td><input type="text" name="paid_at" id="paid_at"  value="{{ date('d-M-Y') }}"></td>
	</tr>
	<tr>
		<td>Payment Note:</td>
		<td><textarea style="width:100%" class="k-textbox"></textarea></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><button type="submit" class="k-button k-primary">Save</button> <button class="k-button" type="button" onClick="javascript:history.back()">Cancel</button></td>
	</tr>
</table>
</form>
</div>
</div>

<script type="text/javascript">
	$(document).ready(function(e){

		$("#cash_lak").kendoNumericTextBox();
		$("#total").kendoNumericTextBox();
		$("#paid_at").kendoDatePicker({
			format : "dd-MMM-yyyy"
		});

		
		$("#payment_method").ddPaymentMethod();
		
		$("#discount").kendoNumericTextBox();
		
		
		$("#start_at").kendoDatePicker({
			format : "dd-MMM-yyyy"
		});
		
		$("#title").ddTitle();

	});
</script>
@include('layout.footer')