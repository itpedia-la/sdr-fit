@include('layout.header')
{{ Form::open(array('url' => 'user/remove/submit')) }}
<input type="hidden" value="{{ Route::input('user_id') }}" name="user_id">
<h3>Access Permission</h3>
<hr class="hrHeader"/>
<div align="center">

<div class="k-block extended auto" style="width:40%">
<b>Access denied ( Code: {{ @$permissionCode }} )</b>

<hr/>
 @if ($errors->has())
	 @foreach ($errors->all() as $error)
		<div class="message red">{{ $error }}<br/></div>
	 @endforeach
 @endif
	<table class="tableStyling" cellpadding="0" cellspacing="0" width="100%">

		<tr>
			<td align="center"><span class="message orange">Sorry, You are not allow to {{ @$permissionDescription }}</span></td>
		</tr>

		<tr>
			<td align="right">
			<button onclick="window.history.back()" type="button" class="k-button">Back</button> 
			<button type="button" class="k-button k-primary" id="btnBack" onclick="history.go(-1);">Ok</button>
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