@include('layout.header')
<h3>Membership Payment
</h3>
<hr class="hrHeader"/>
<div align="center">
<div class="k-block extended auto" style="width:50%">
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
		<td width="30%">Gender: *</td>
		<td><input type="text" name="gender" id="gender" value="@if(Input::old('gender')){{ Input::old('gender') }}@else{{@$member->gender}}@endif" ></td>
	</tr>
	<tr>
		<td>Fullname: *</td>
		<td><input type="text" name="fullname" id="fullname" class="k-textbox" value="@if(Input::old('fullname')){{ Input::old('fullname') }}@else{{@$member->fullname}}@endif"  style="width: 100%"></td>
	</tr>
	<!--  <tr>
		<td>Lastname: *</td>
		<td><input type="text" name="lastname" id="lastname" class="k-textbox" value="@if(Input::old('lastname')){{ Input::old('lastname') }}@else{{@$member->lastname}}@endif"  style="width: 100%"></td>
	</tr>  -->
	<!--<tr>
		<td>Date of Birth:</td>
		<td><input type="text" name="dob" id="dob" value="@if(Input::old('dob')){{ Input::old('dob') }}@else{{@$member->dob}}@endif"></td>
	</tr>-->
	<tr>
		<td>RFID Code: *</td>
		<td><input type="text" name="rfid_code" id="rfid_code" class="k-textbox" value="@if(Input::old('rfid_code')){{ Input::old('rfid_code') }}@else{{@$member->rfid_code}}@endif"  style="width: 100%"></td>
	</tr>
	
	<tr>
		<td>Phone:</td>
		<td><input type="text" name="phone" id="phone" class="k-textbox" value="@if(Input::old('phone')){{ Input::old('phone') }}@else{{@$member->phone}}@endif"  style="width: 100%"></td>
	</tr>
	
	<tr>
		<td>Email:</td>
		<td><input type="text" name="email" id="email" class="k-textbox" value="@if(Input::old('email')){{ Input::old('email') }}@else{{@$member->email}}@endif"  style="width: 100%"></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><input type="checkbox" name="vip" id="vip" value="1"> VIP Guest / Family / Group</td>
	</tr>
	@if(@$membership->status==0)
	<tr>
		<td align="right">Member Package:</td>
		<td><input type="text" name="package_id" id="package_id" value="{{ @$membership->package_id }}" style="width:100%"></td>
	</tr>
	<tr>
		<td align="right">Discount: *</td>
		<td><input type="text" name="discount" id="discount" >%</td>
	</tr>
	<tr>
		<td align="right">Total LAK: *</td>
		<td><input type="text" name="total_lak" id="total_lak" ></td>
	</tr>
	<tr>
		<td align="right">Total USD: *</td>
		<td><input type="text" name="total_usd" id="total_usd" ></td>
	</tr>
	<tr>
		<td align="right">Total THB: *</td>
		<td><input type="text" name="total_thb" id="total_thb" > </td>
	</tr>
	<tr>
		<td align="right">Issue Date: *</td>
		<td><input type="text" name="start_at" id="start_at" value="{{ Tool::toDate(@$membership->start_at) }}"></td>
	</tr>
	<tr>
		<td align="right">Remark:</td>
		<td><textarea class="k-textbox" name="remark" style="width:100%"></textarea></td>
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


		var total_lak = $("#total_lak").kendoNumericTextBox().data('kendoNumericTextBox');
			total_lak.enable(false);

			var total_usd = $("#total_usd").kendoNumericTextBox().data('kendoNumericTextBox');
			total_lak.enable(false);

			var total_thb = $("#total_thb").kendoNumericTextBox().data('kendoNumericTextBox');
			total_lak.enable(false);

		var discount = $("#discount").kendoNumericTextBox().data('kendoNumericTextBox');

		var dataCurrency = [
		                    { text: "LAK", value: "LAK" },
		                    { text: "USD", value: "USD" },
		                    { text: "THB", value: "THB" }
		                ];

        // create DropDownList from input HTML element
        var currency = $("#currency").kendoDropDownList({
            dataTextField: "text",
            dataValueField: "value",
            value : $(this).val(),
            dataSource: dataCurrency,
            index: 0,
            optionLabel: {
            	text: '- Currency -',
            	value: ""
	        },
	        enable: false
            
        }).data('kendoDropDownList');

		
		$('#vip').change(function(){

			var grid = $("#package_id").data("kendoDropDownList");
			
			if ($(this).is(':checked')) {
				
		        grid.dataSource.transport.options.read.url = "package/json/1";
		        grid.dataSource.read();

		        total_lak.enable(true);
		        total_lak.focus();
		        total_usd.enable(true);
		        total_thb.enable(true);

				discount.enable(false);
				discount.value("");
						        
			} else {
				
		        grid.dataSource.transport.options.read.url = "package/json/0";
		        grid.dataSource.read();

		      	total_lak.enable(false);
		      	total_thb.enable(false);
		      	total_usd.enable(false);
		        discount.enable(true);
		       
		        total_lak.value("");
		        total_thb.value("");
		        total_usd.value("");
		        
			}
		});

		


		
		/*var grid = $(this).data("kendoGrid");
        grid.dataSource.transport.options.read.url = "product/api/getByCategoryIdx/"+settings.category_idx;
        grid.dataSource.read(); */
        
		$("#package_id").kendoDropDownList({
			
			dataValueField: "id",
		    dataTextField: "name",
		    autoBind: true,
		    change: function(e) {
		    	var value = this.text();
		    	console.log(value);
		    },
		    optionLabel: {
		    	name: '- Package -',
		        id: ""
		    },
		    dataSource: {
		        transport: {
		            read: {
		            	url: "package/json/0",
		                dataType: "json",
		            }
		        }
		    }
		    
		});

		
		$("#dob").kendoDatePicker({
			format : "dd-MMM-yyyy"
		});

		$("#start_at").kendoDatePicker({
			format : "dd-MMM-yyyy"
		});
		
		$("#gender").ddGender();

	});
</script>
@include('layout.footer')