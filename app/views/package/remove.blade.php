@include('layout.header')
<h3>Package</h3>
<hr class="hrHeader"/>
<div align="center">
<div class="k-block extended auto" style="width:30%">
<div class="floatLeft">Remove Package</div>
<div class="floatRight">
	<!--  <button class="k-button k-primary" id="btn_add">Add new Package</button> <button class="k-button" id="btn_update">Update</button> <button class="k-button" id="btn_remove">Remove</button>-->
</div>
<div class="ClearFix"></div>
<hr/>
@if ($errors->has())<div class="message green">{{ $errors->all()['0'] }}</div>@endif
<form method="post" action="{{ URL::to('package/remove/submit') }}">
<input type="hidden" name="package_id" value="{{Route::input('package_id')}}">
<table class="tableStyling" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td>Would you like to remove "{{ $package->name }}"?</td>
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