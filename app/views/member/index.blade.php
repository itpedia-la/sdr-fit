@include('layout.header')
<h3>Member</h3>
<hr class="hrHeader"/>
<div align="center">
<div class="k-block extended auto" style="width:100%">

<div class="floatRight">
	<button class="k-button k-primary" id="btn_add">Add new Member</button> <button class="k-button" id="btn_edit">Edit</button> <button class="k-button" id="btn_remove">Remove</button>
</div>
<div class="ClearFix"></div>
<hr/>
@if( Session::get('message') ) <div class="message green">{{ Session::get('message') }}</div>@endif
<div id="gridMember"></div>
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
			$("#btn_edit").data('member_id',id);
			$("#btn_remove").data('member_id',id);
		}

		function btn_reset() {
			btn_edit.enable(false);
			btn_remove.enable(false);
			$("#btn_edit").dataRemove('member_id');
			$("#btn_remove").dataRemove('member_id');
		}

		$("#btn_add").click(function(e){ e.preventDefault(); window.location.href = '{{ URL::to("member/add") }}' });
		$("#btn_edit").click(function(e){ e.preventDefault(); window.location.href = '{{ URL::to("member/edit") }}/'+$(this).data('member_id'); });
		$("#btn_remove").click(function(e){ e.preventDefault(); window.location.href = '{{ URL::to("member/remove") }}/'+$(this).data('member_id'); });
		
		var sourceMember = new kendo.data.DataSource({
			transport: {
		    	read:  {
		           		url: "{{ URL::to('member/json') }}",
		                dataType: "json"
		           },
		        },
			pageSize: 100,
		});

		$("#gridMember").kendoGrid({
			dataSource: sourceMember,
			pageable: true,
			selectable: true,
			sortable: true,
	
			height: 600,
			change: function(e) {
				  grid = e.sender;
				  var selectedValue = grid.dataItem(this.select());
				  btn_set(selectedValue.id)
			}, 
			filter: true,
		    	columns: [
		    	    { field:"id", title: "ID", width: '10%',},
		    	    { field:"fullname", title: "Fullname", width: '30%', encoded:false },
		    	    { field:"dob", title: "DOB", width: '15%', encoded:false },
					{ field:"rfid_code", title: "Code", width: '15%', encoded:false },
					{ field:"vip", title: "VIP", width: '20%', encoded:false },
					{ field:"updated_at", title: "Updated", width: '20%', encoded:false },
		        ],
		});
	});
</script>
@include('layout.footer')