@include('layout.header')
{{ Form::open(array('url' => 'exchange/save')) }}

<h3>Currency Exchange Rate</h3>
<hr class="hrHeader"/>
<div align="center">
<div class="k-block extended auto" style="width:30%">
Latest update: {{ Tool::toDate($exchange->created_at) }}
<hr/>
@if( Session::get('message') ) <div class="message green">{{ Session::get('message') }}</div>@endif
	<table class="tableStyling" cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td>USD:</td>
			<td><input type="numeric" name="us" class="currency" min="0" value="{{ $exchange->USD }}"> $</td>
		</tr>
		<tr>
			<td>BATH:</td>
			<td><input type="numeric" name="bath" class="currency" min="0" value="{{ $exchange->THB }}"> ฿</td>
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
		$(".currency").kendoNumericTextBox();
	});
</script>
@include('layout.footer')