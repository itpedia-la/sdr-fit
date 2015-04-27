@include('layout.header')
<h3>Membership Payment
</h3>
<hr class="hrHeader"/>
<div align="center">
<div class="k-block extended auto" style="width:40%">
<div class="floatLeft">@if(Route::input('member_id') > 0)Edit Membership @else Add new Membership @endif</div>
<div class="floatRight">

</div>
<div class="ClearFix"></div>
<hr/>
@if ($errors->has())<div class="message green">{{ $errors->all()['0'] }}</div>@endif
<form method="post" action="{{ URL::to('membership/save') }}">
<input type="hidden" name="member_id" value="{{Route::input('member_id')}}">
<input type="hidden" name="membership_id" value="{{Route::input('membership_id')}}">
<table class="tableStyling" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td>Title: *</td>
		<td><input type="text" name="title" id="title" value="@if(Input::old('title')){{ Input::old('title') }}@else{{@$member->title}}@endif" ></td>
	</tr>
	<tr>
		<td>Firstname: *</td>
		<td><input type="text" name="firstname" id="firstname" class="k-textbox" value="@if(Input::old('firstname')){{ Input::old('firstname') }}@else{{@$member->firstname}}@endif"  style="width: 100%"></td>
	</tr>
	<tr>
		<td>Lastname: *</td>
		<td><input type="text" name="lastname" id="lastname" class="k-textbox" value="@if(Input::old('lastname')){{ Input::old('lastname') }}@else{{@$member->lastname}}@endif"  style="width: 100%"></td>
	</tr>
	<tr>
		<td>Date of Birth:</td>
		<td><input type="text" name="dob" id="dob" value="@if(Input::old('dob')){{ Input::old('dob') }}@else{{@$member->dob}}@endif"></td>
	</tr>
	<tr>
		<td>RFID Code: *</td>
		<td><input type="text" name="rfid_code" id="rfid_code" class="k-textbox" value="@if(Input::old('rfid_code')){{ Input::old('rfid_code') }}@else{{@$member->rfid_code}}@endif"  style="width: 100%"></td>
	</tr>
	
	<tr>
		<td>Phone: *</td>
		<td><input type="text" name="phone" id="phone" class="k-textbox" value="@if(Input::old('phone')){{ Input::old('phone') }}@else{{@$member->phone}}@endif"  style="width: 100%"></td>
	</tr>
	
	<tr>
		<td>Email:</td>
		<td><input type="text" name="email" id="email" class="k-textbox" value="@if(Input::old('email')){{ Input::old('email') }}@else{{@$member->email}}@endif"  style="width: 100%"></td>
	</tr>
	@if(@$membership->status==0)
	<tr>
	<tr>
		<td colspan="2"><hr/></td>
	</tr>
	
		<td align="right">Member Package: *</td>
		<td><input type="text" name="package_id" id="package_id" value="{{ @$membership->package_id }}"></td>
	</tr>
	<tr>
		<td align="right">Start Date: *</td>
		<td><input type="text" name="start_at" id="start_at" value="{{ Tool::toDate(@$membership->start_at) }}"></td>
	</tr>
	@else
	<tr>
		<td colspan="2"><input type="hidden" value="{{ @$membership->package_id }}" name="package_id"><input type="hidden" value="{{ Tool::toMySqlDate($membership->start_at) }}" name="start_at"></td>
	</tr>
	@endif
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

		$("#package_id").ddPackage();
		
		$("#dob").kendoDatePicker({
			format : "dd-MMM-yyyy"
		});

		$("#start_at").kendoDatePicker({
			format : "dd-MMM-yyyy"
		});
		
		$("#title").ddTitle();

	});
</script>
@include('layout.footer')