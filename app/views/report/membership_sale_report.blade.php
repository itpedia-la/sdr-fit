@include('layout.header')

<h3>Membership Sale Report</h3>
<hr class="hrHeader"/>
<div align="center">
<div class="k-block extended auto" style="width:100%">
<div class="floatLeft"><form method="get" action="report/">
Report from: <input type="text" name="start_at" id="start_at" value="{{ Route::input('start_at') }}"> to: <input type="text" name="end_at" id="end_at" value="{{ Route::input('end_at') }}"> <button type="button" id="btnReport" class="k-button k-primary">Search</button></form>
</div>
<div class="floatRight">
<a class="k-button" href="{{ URL::to('report/transaction/month') }}/{{ Route::input('month') }}?print=true" target="_blank">Print</a>
</div>
<div class="ClearFix"></div>
<hr/>
@if( Session::get('message') ) <div class="message green">{{ Session::get('message') }}</div>@endif
	<table class="tableStylingReport" cellpadding="0" cellspacing="0" width="100%">

		<tr style="background:#278BCB; color:#fff">
			<td colspan="2" align="center">Date / Name:</td>
           
            <td align="center">Package</td>
            <td align="center">Total</td>
            <td align="center">Discount</td>
            <td align="center">Grand Total</td>

		</tr>
		
		<tr style="background:#A8DFF4; color:#000">
			<td colspan="1">15-Jan-2015</td>
            <td></td>
            <td align="right">1 Year</td>
            <td align="right"></td>
            <td align="right"></td>
            <td align="right"></td>
            <td align="right"></td>
		</tr>
		<tr style="background:#FFF6DF; color:#000">
			<td align="right"></td>
            <td>Somwang Souksavatd</td>
            <td>{{ @$row['send_location'] }}</td>
            <td align="right">{{ @$row['sum_m3_child'] }}</td>
            <td align="right">{{ @$row['grand_total_html'] }}</td>
            <td align="right">{{ @$row['invoice_remain'] }}</td>
            <td align="right">{{ @$row['invoice_status_html'] }}</td>
            <td>{{ @$row['transaction_date'] }}</td>
		</tr>
		<tr style="background:#A8DFF4; color:#000">
			<td colspan="2">{{ @$row['index'] }}.) {{ @$row['customer'] }}</td>
            <td>{{ @$row['invoice_number'] }}</td>
            <td align="right">{{ @$row['sum_m3'] }}</td>
            <td align="right">{{ @$row['sum_grand_total_all'] }}</td>
            <td align="right">{{ @$row['invoice_paid'] }}</td>
            <td align="right">{{ @$row['invoice_remain'] }}</td>
            <td align="right">{{ @$row['invoice_status_html'] }}</td>
		</tr>

	</table>
</div>

</div>

<script type="text/javascript">
	$(document).ready(function(e){
		
		$("#start_at").kendoDatePicker({
	        start: "year",
	        depth: "year",
	        format: "MMMM yyyy",
	        /*change : function() {
	        	window.location.href = "{{ URL::to('/report/transaction') }}/month/"+$("#month").val();
	        }*/
		});

		$("#end_at").kendoDatePicker({
	        start: "year",
	        depth: "year",
	        format: "MMMM yyyy",
	        /*change : function() {
	        	window.location.href = "{{ URL::to('/report/transaction') }}/month/"+$("#month").val();
	        }*/
		});

		$("#btnReport").click(function(e){
			e.preventDefault();
			window.location.href = "{{ URL::to('/report/transaction') }}/month/"+$("#month").val();
		});
	});
</script>
@include('layout.footer')