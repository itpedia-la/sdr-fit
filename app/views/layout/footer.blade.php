@if( Auth::id() ) 
<hr style="margin:50px 0px 0px 0px"/><p style="color:#666;  font-size:10px" align="center">Copyright &copy; 2015 - {{ Config::get('app.title') }}  | Developed by: IT Pedia Sole.,Ltd</p> 
@else
<p style="color:#666; line-height:2em; font-size:10px" align="center">Copyright &copy; 2015 - {{ Config::get('app.title') }}  <br/> Developed by: IT Pedia Sole.,Ltd</p>
@endif
</div>

<script>
	$(document).ready(function() {
		// Main Menu
		$("#menu").kendoMenu();
		
	});
</script>
</body>
</html>