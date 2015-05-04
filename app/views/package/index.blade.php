@include('layout.header')
<h3>Package</h3>
<hr class="hrHeader"/>
<div align="center">
<div class="k-block extended auto" style="width:50%">

<div class="floatRight">
	<button class="k-button k-primary" id="btn_add">Add new Package</button> <button class="k-button" id="btn_edit">Edit</button> <button class="k-button" id="btn_remove">Remove</button>
</div>
<div class="ClearFix"></div>
<hr/>
@if( Session::get('message') ) <div class="message green">{{ Session::get('message') }}</div>@endif
<div id="gridPackage"></div>
</div>
</div>

<script type="text/javascript">
	$(document).ready(function(e){

		var btn_add = $("#btn_add").kendoButton().data('kendoButton');
		var btn_edit = $("#btn_edit").kendoButton({enable:false}).data('kendoButton');
		var btn_remove = $("#btn_remove").kendoButton({enable:false}).data('kendoButton');

		function btn_set(id) {
			btn_edit.enable(true);
			btn_remove.enable(true);
			$("#btn_edit").data('package_id',id);
			$("#btn_remove").data('package_id',id);
		}

		function btn_reset() {
			btn_edit.enable(false);
			btn_remove.enable(false);
			$("#btn_edit").dataRemove('package_id');
			$("#btn_remove").dataRemove('package_id');
		}

		$("#btn_add").click(function(e){ e.preventDefault(); window.location.href = '{{ URL::to("package/add") }}' });
		$("#btn_edit").click(function(e){ e.preventDefault(); window.location.href = '{{ URL::to("package/edit") }}/'+$(this).data('package_id'); });
		$("#btn_remove").click(function(e){ e.preventDefault(); window.location.href = '{{ URL::to("package/remove") }}/'+$(this).data('package_id'); });
		
		var sourcePackage = new kendo.data.DataSource({
			transport: {
		    	read:  {
		           		url: "{{ URL::to('package/json') }}",
		                dataType: "json"
		           },
		        },
			pageSize: 500,
		});

		$("#gridPackage").kendoGrid({
			dataSource: sourcePackage,
			pageable: false,
			selectable: true,
			sortable: true,
			height: 400,
			change: function(e) {
				  grid = e.sender;
				  var selectedValue = grid.dataItem(this.select());
				  btn_set(selectedValue.id)
			}, 
			filter: true,
		    	columns: [
		    	    { field:"id", title: "ID", width: '10%',},
		    	    { field:"name", title: "Package name", width: '30%', encoded:false },
		    	    { field:"months", title: "Months", width: '15%', encoded:false },
					{ field:"price", title: "Price", width: '15%', encoded:false },
					{ field:"updated_at", title: "Update", width: '20%', encoded:false },
		        ],
		});
	});
</script>
@include('layout.footer')