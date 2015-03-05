@include('layout.header')
<h3>Package</h3>
<hr class="hrHeader"/>

<div class="k-block extended auto" style="width:30%">
Latest update:
<hr/>
@if( Session::get('message') ) <div class="message green">{{ Session::get('message') }}</div>@endif
<div id="gridPackage"></div>
</div>


<script type="text/javascript">
	$(document).ready(function(e){
		
	});
</script>
@include('layout.footer')