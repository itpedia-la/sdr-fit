@include('layout.header')
{{ Form::open(array('url' => 'company/profile/update')) }}

<h3>Company Profile</h3>
<hr class="hrHeader"/>
<div align="center">
<div class="k-block extended auto" style="width:50%">
Update Company Information
<hr/>
@if( Session::get('message') ) <div class="message green">{{ Session::get('message') }}</div>@endif
	<table class="tableStyling" cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td width="30%">Company name:</td>
			<td><input type="text" class="k-textbox" name="company_name" value="{{ @$profile->company_name }}" style="width:100%"></td>
		</tr>
		<tr>
			<td>Logo:</td>
			<td><input type="text" class="k-textbox" name="logo" value="{{ @$profile->logo }}" style="width:100%"></td>
		</tr>
		<tr>
			<td>Address:</td>
			<td><input type="text" class="k-textbox" name="address" value="{{ @$profile->address }}" style="width:100%"></td>
		</tr>
		<tr>
			<td>Telephone:</td>
			<td><input type="text" class="k-textbox" name="telephone" value="{{ @$profile->telephone }}" style="width:100%"></td>
		</tr>
		<tr>
			<td>Mobile:</td>
			<td><input type="text" class="k-textbox" name="mobile" value="{{ @$profile->mobile }}" style="width:100%"></td>
		</tr>
		<tr>
			<td>Fax:</td>
			<td><input type="text" class="k-textbox" name="fax" value="{{ @$profile->fax }}" style="width:100%"></td>
		</tr>
		<tr>
			<td>Email: </td>
			<td><input type="text" class="k-textbox" name="email" value="{{ @$profile->email }}" style="width:100%"></td>
		</tr>
		<tr>
			<td>Website:</td>
			<td><input type="text" class="k-textbox" name="website" value="{{ @$profile->website }}" style="width:100%"></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			
			<td align="right">
			<a href="javascript:history.back()" class="k-button">Cancel</a>	
			{{Form::submit('Update', ['class' => 'k-button k-primary'])}}
	
			</td>
			
		</tr>
	</table>
</div>

</div>
{{Form::close()}}
<script type="text/javascript">
	$(document).ready(function(e){
		
	});
</script>
@include('layout.footer')