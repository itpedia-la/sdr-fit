@include('layout.header')
<h3>Package</h3>
<hr class="hrHeader"/>
<div align="center">
<div class="k-block extended auto" style="width:30%">
<div class="floatLeft">Add new Package</div>
<div class="floatRight">
	<!--  <button class="k-button k-primary" id="btn_add">Add new Package</button> <button class="k-button" id="btn_update">Update</button> <button class="k-button" id="btn_remove">Remove</button>-->
</div>
<div class="ClearFix"></div>
<hr/>
@if ($errors->has())<div class="message green">{{ $errors->all()['0'] }}</div>@endif
<form method="post" action="{{ URL::to('package/save') }}">
<input type="hidden" name="package_id" value="{{Route::input('package_id')}}">
<table class="tableStyling" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td>Package name: *</td>
		<td><input type="text" class="k-textbox" name="name" id="name" value="@if(Input::old('name')){{ Input::old('name') }}@else{{@$package->name}}@endif" style="width: 100%"></td>
	</tr>
	<tr>
		<td>Days: *</td>
		<td><input type="text" name="days" id="days" value="@if(Input::old('days')){{ Input::old('days') }}@else{{@$package->days}}@endif"  style="width: 100%"></td>
	</tr>
	<tr>
		<td>Price: *</td>
		<td><input type="text" name="price" id="price" value="@if(Input::old('price')){{ Input::old('price') }}@else{{@$package->price}}@endif"  style="width: 100%"></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td align="right"><a href="#" onClick="javascript:history.back()" class="k-button">Cancel</a> <button type="submit" class="k-button k-primary">Save</button></td>
	</tr>
</table>
</form>
</div>
</div>

<script type="text/javascript">
	$(document).ready(function(e){

		$("#days").kendoNumericTextBox();
		$("#price").kendoNumericTextBox();

	});
</script>
@include('layout.footer')