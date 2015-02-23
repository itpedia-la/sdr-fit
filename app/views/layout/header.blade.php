<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="app_mode" content="rms">

<base href="{{ Config::get('app.url') }}">
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/kendo.common.min.css" rel="stylesheet">
<link href="css/kendo.silver.min.css" rel="stylesheet">
<script src="js/jquery.min.js"></script>
<script src="js/kendo.all.min.js"></script>
<script src="js/main.js"></script>
<title>{{ Config::get('app.title') }} | {{ Config::get('app.name') }}</title>
</head>

<!-- <style>
.k-window
    {
        box-shadow: none !important;
    }
.k-overlay { opacity:0.1 !important }
@media print
{
   body { display: none; }
}
</style> -->

<body>
	<div id="wrapper">
		@if( Auth::id() ) 
		<div id="header">
			<img src="img/logo.png" class="floatLeft" width="60">
			<h2 style="padding:0px; margin:4px 0px 4px 0px; color:#005186">{{ Config::get('app.title') }}</h2>
			<h3 style="color:#ccc; margin:0px; padding:0px">{{ Config::get('app.name') }}</h3>
			<div class="ClearFix"></div>
		</div>
		<ul id="menu">

			<li><a href="{{ URL::to('dashboard') }}"><span class="sprite purchase-order-16">&nbsp;</span> Dashboard </a></li>	
			
			<li><span class="sprite area-chart-16">&nbsp;</span> ລາຍງານ
				<ul>
					<li><a href="{{ URL::to('report/delivery') }}/date/{{ date('01-m-Y') }}/{{ date('t-m-Y') }}">ລາຍລະອຽດ ການສົ່ງ (Delivery Report)</a></li>
					<li><a href="{{ URL::to('report/material/customer') }}/date/{{ date('01-m-Y') }}/{{ date('t-m-Y') }}">ການຜະລິດແຍກຕາມລູກຄ້າ (Material Report by Cust.)</a></li>
					<li><a href="{{ URL::to('report/transaction') }}/date/{{ date('01-m-Y') }}/{{ date('t-m-Y') }}">ລາຍລະອຽດ ການຂາຍ (Transaction Report)</a></li>
				</ul>
			</li>	
			<li><span class="sprite gear-2-16">&nbsp;</span> ຕັ້ງຄ່າ
				<ul>
					<li id="liUserManage"><a href="{{ URL::to('user/list') }}">ຜູ້ໃຊ້ງານ</a></li>
					<li id="liExchangeRate"><a href="{{ URL::to('exchange') }}">ອັດຕາແລກປ່ຽນ</a></li>
					<li id="liApplicationSetting"><a href="{{ URL::to('profile') }}">ຕັ້ງຄ່າທົ່ວໄປ</a></li>
				</ul></li>

			<li style="float: right" class="k-primary"> <span class="sprite businessman-16-white">&nbsp;</span>  {{ Auth::user()->firstname }}
				<ul>
					<li><a href="{{ URL::to('user/personal/change/password') }}">ປ່ຽນລະຫັດຜ່ານ</a></li>
					<li><a href="{{ URL::to('user/logout') }}">ອອກຈາກລະບົບ</a></li>
				</ul>
				
				
			</li>
		</ul>
		@else
		<div style="margin:50px"></div>
		@endif