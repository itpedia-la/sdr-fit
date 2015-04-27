@include('layout.header')
<h3>Membership</h3>
<hr class="hrHeader"/>
<div align="center">
<div class="k-block extended auto" style="width:30%">
<div class="floatLeft">Membership Unfreeze</div>
<div class="floatRight">
	<!--  <button class="k-button k-primary" id="btn_add">Add new Package</button> <button class="k-button" id="btn_update">Update</button> <button class="k-button" id="btn_remove">Remove</button>-->
</div>
<div class="ClearFix"></div>
<hr/>

<form method="post" action="{{ URL::to('membership/unfreeze/submit') }}">
<input type="hidden" name="membership_id" value="{{Route::input('membership_id')}}">
<table class="tableStyling" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td align="center">Would you like to unfreeze this membership?</td>
	</tr>
	<tr>
		<td align="right">Date: <input type="text" id="unfreezed_at" name="unfreezed_at" value="{{ date('d-M-Y') }}"</td>
	</tr>
	<tr>
		<td align="right"><a href="#" onClick="javascript:history.back()" class="k-button">Cancel</a> <button type="submit" class="k-button k-primary">Yes</button></td>
	</tr>
</table>
</form>
</div>
</div>

<script type="text/javascript">
	$(document).ready(function(e){
		$("#unfreezed_at").kendoDatePicker({
			format : "dd-MMM-yyyy"
		});
	});
</script>
@include('layout.footer')