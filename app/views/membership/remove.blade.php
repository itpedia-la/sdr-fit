@include('layout.header')
<h3>Membership</h3>
<hr class="hrHeader"/>
<div align="center">
<div class="k-block extended auto" style="width:30%">
<div class="floatLeft">Membership Cancel</div>
<div class="floatRight">
	<!--  <button class="k-button k-primary" id="btn_add">Add new Package</button> <button class="k-button" id="btn_update">Update</button> <button class="k-button" id="btn_remove">Remove</button>-->
</div>
<div class="ClearFix"></div>
<hr/>

<form method="post" action="{{ URL::to('membership/cancel/submit') }}">
<input type="hidden" name="membership_id" value="{{Route::input('membership_id')}}">
<table class="tableStyling" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td>Would you like to cancel this membership?</td>
	</tr>
	<tr>
		<td align="right"><a href="#" onClick="javascript:history.back()" class="k-button">Cancel</a> <button type="submit" class="k-button k-primary">Remove</button></td>
	</tr>
</table>
</form>
</div>
</div>

<script type="text/javascript">
	$(document).ready(function(e){

	});
</script>
@include('layout.footer')