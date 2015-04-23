@include('layout.header')
<h3>Membership</h3>
<hr class="hrHeader"/>
<div align="center">
<div class="k-block extended auto" style="width:100%">

<div class="floatRight">
	<button class="k-button k-primary" id="btn_add">Add new Membership</button> <button class="k-button" id="btn_edit">Edit</button> <button class="k-button" id="btn_freeze">Freeze</button> <button class="k-button" id="btn_renew">Renew</button> <button class="k-button" id="btn_makepayment">Make Payment</button> 
	<button class="k-button" id="btn_cancel">Cancel</button>
</div>
<div class="ClearFix"></div>
<hr/>
@if( Session::get('message') ) <div class="message green">{{ Session::get('message') }}</div>@endif
<div id="gridMembership"></div>
</div>
</div>

<script type="text/javascript">
	$(document).ready(function(e){

		var btn_add = $("#btn_add").kendoButton().data('kendoButton');
		var btn_edit = $("#btn_edit").kendoButton({enable:false}).data('kendoButton');
		var btn_cancel = $("#btn_cancel").kendoButton({enable:false}).data('kendoButton');
		var btn_freeze = $("#btn_freeze").kendoButton({enable:false}).data('kendoButton');
		var btn_renew  = $("#btn_renew").kendoButton({enable:false}).data('kendoButton');
		var btn_makepayment = $("#btn_makepayment").kendoButton({enable:false}).data('kendoButton');
		
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

		$("#btn_add").click(function(e){ e.preventDefault(); window.location.href = '{{ URL::to("membership/add") }}' });
		$("#btn_edit").click(function(e){ e.preventDefault(); window.location.href = '{{ URL::to("membership/edit") }}/'+$(this).data('member_id'); });
		$("#btn_remove").click(function(e){ e.preventDefault(); window.location.href = '{{ URL::to("membership/remove") }}/'+$(this).data('member_id'); });
		
		var sourceMember = new kendo.data.DataSource({
			transport: {
		    	read:  {
		           		url: "{{ URL::to('membership/json') }}",
		                dataType: "json"
		           },
		        },
			pageSize: 100,
		});

		$("#gridMembership").kendoGrid({
			dataSource: sourceMember,
			pageable: true,
			selectable: true,
			sortable: true,
			height: 600,
			change: function(e) {
				  grid = e.sender;
				  var selectedValue = grid.dataItem(this.select());
				  //btn_set(selectedValue.id)
			}, 
			filter: true,
		    	columns: [
		    	    { field:"id", title: "ID", width: '10%',},
		    	    { field:"fullname", title: "Fullname", width: '30%', encoded:false },
		    	    { field:"package", title: "Package", width: '20%', encoded:false },
		    	    { field:"start_at", title: "Start at", width: '15%', encoded:false },
					{ field:"expired_at", title: "Expired at", width: '15%', encoded:false },
					{ field:"freezed_at", title: "Freezed", width: '20%', encoded:false },
					{ field:"status", title: "Status", width: '20%', encoded:false },
		        ],
		});
	});
</script>
@include('layout.footer')