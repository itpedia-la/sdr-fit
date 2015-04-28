@include('layout.header')
<h3>Membership</h3>
<hr class="hrHeader"/>
<div align="center">
<div class="k-block extended auto" style="width:100%">
<div class="floatLeft">
	<input type="text" class="k-textbox"> <button class="k-button k-primary">Search</button>
</div>
<div class="floatRight">
	<button class="k-button k-primary" id="btn_add">Add new Membership</button> <button class="k-button" id="btn_edit">Edit</button> <button class="k-button" id="btn_freeze">Freeze</button> <button class="k-button" id="btn_unfreeze">Unfreeze</button> <button class="k-button" id="btn_renew">Renew</button> <button class="k-button" id="btn_makepayment">Make Payment</button> <button class="k-button" id="btn_receipt_print">Receipt Print</button>
	<button class="k-button" id="btn_cancel">Cancel</button>
</div>
<div class="ClearFix"></div>
<hr/>
@if( Session::get('message') ) <div class="message green">{{ Session::get('message') }}</div>@endif
<hr/>
<div align="left">
<table>
	<tr>
		<td>Name:</td>
		<td><input class="k-textbox" value="Somwang Souksavatd"></td>
		<td>Phone:</td>
		<td><input class="k-textbox" value="+856 5999 8848"></td>
	</tr>
	<tr>
		<td>Name:</td>
		<td><input class="k-textbox"></td>
		<td>Name:</td>
		<td><input class="k-textbox"></td>
	</tr>
</table>
</div>
<div id="gridMembership"></div>
</div>
</div>

<script type="text/javascript">
	$(document).ready(function(e){

		var membership_id;
		var member_id;
		
		var btn_add = $("#btn_add").kendoButton().data('kendoButton');
		var btn_edit = $("#btn_edit").kendoButton({enable:false}).data('kendoButton');
		var btn_cancel = $("#btn_cancel").kendoButton({enable:false}).data('kendoButton');
		var btn_freeze = $("#btn_freeze").kendoButton({enable:false}).data('kendoButton');
		var btn_unfreeze = $("#btn_unfreeze").kendoButton({enable:false}).data('kendoButton');
		var btn_renew  = $("#btn_renew").kendoButton({enable:false}).data('kendoButton');
		var btn_makepayment = $("#btn_makepayment").kendoButton({enable:false}).data('kendoButton');
		var btn_receipt_print = $("#btn_receipt_print").kendoButton({enable:false}).data('kendoButton');
		
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

		function btnSet(membershipid, memberid, status) {

			membership_id = membershipid;
			member_id = memberid;
			
			console.log(membership_id+'-'+member_id+'-'+status);
			
			switch(status) {

				// Active
				case 1:
					btn_makepayment.enable(false);
					btn_cancel.enable(true);
					btn_freeze.enable(true);
					btn_unfreeze.enable(false);
					btn_edit.enable(true);
					btn_renew.enable(false);
					
					break;

				// Expiring
				case 2:

					btn_makepayment.enable(false);
					btn_cancel.enable(true);
					btn_freeze.enable(true);
					btn_unfreeze.enable(false);
					btn_edit.enable(true);
					btn_renew.enable(false);
					
					break;

				// Freezing
				case 3:

					btn_makepayment.enable(false);
					btn_cancel.enable(true);
					btn_freeze.enable(false);
					btn_unfreeze.enable(true);
					btn_edit.enable(false);
					btn_renew.enable(false);
					
					break;

				// Expired
				case 4:
					
					break;

				// Pending
				default:

					btn_makepayment.enable(true);
					btn_cancel.enable(true);
					btn_freeze.enable(false);
					btn_unfreeze.enable(false);
					btn_edit.enable(true);
					btn_renew.enable(false);
					break;
				
			}
			
		}

		function btnUnset() {

		}

		$("#gridMembership").kendoGrid({
			dataSource: sourceMember,
			pageable: true,
			selectable: true,
			sortable: true,
			height: 600,
			change: function(e) {
				  grid = e.sender;
				  var value = grid.dataItem(this.select());
				  btnSet(value.id, value.member_id, value.status)
			}, 
			filter: true,
		    	columns: [
		    	    { field:"id", title: "ID", width: '10%',},
		    	    { field:"fullname", title: "Fullname", width: '30%', encoded:false },
		    	    { field:"rfid_code", title: "rfid_code", width: '20%', encoded:false, hidden : true },
		    	    { field:"phone", title: "Phone", width: '20%', encoded:false },
		    	    { field:"package", title: "Package", width: '10%', encoded:false },
		    	    { field:"start_at", title: "Start at", width: '15%', encoded:false },
					{ field:"expired_at", title: "Expired at", width: '15%', encoded:false },
					{ field:"freezed_at", title: "Freezed", width: '15%', encoded:false },
					{ field:"unfreezed_at", title: "Unfreezed", width: '15%', encoded:false },
					{ field:"statusHtml", title: "Status", width: '20%', encoded:false },
		        ],
		});

		$("#btn_edit").click(function(e){
			e.preventDefault();
			window.location.href= '{{ URL::to("membership/edit/") }}/'+membership_id+'/'+member_id;
		});
		
		$("#btn_cancel").click(function(e){
			e.preventDefault();
			window.location.href= '{{ URL::to("membership/cancel/") }}/'+membership_id;
		});

		$("#btn_makepayment").click(function(e){
			e.preventDefault();

			window.location.href= '{{ URL::to("membership/payment/") }}/'+membership_id;
		});

		$("#btn_freeze").click(function(e){
			e.preventDefault();

			window.location.href= '{{ URL::to("membership/freeze/") }}/'+membership_id;
		});

		$("#btn_unfreeze").click(function(e){
			e.preventDefault();

			window.location.href= '{{ URL::to("membership/unfreeze/") }}/'+membership_id;
		});
	});
</script>
@include('layout.footer')