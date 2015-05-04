<?php

/**
 * Report Controller
 * -------------------
 * @author Somwang
 *
 */
class ReportController extends BaseController {

	/*
	 * Payment Report
	 * --------------
	 */
	public function membership_sale_report() {
		
		$start_at = Tool::toMySqlDate(Route::input('start_at'));
		$end_at = Tool::toMySqlDate(Route::input('end_at'));
		
		//$payment = MembershipPayment::where('created_at','>=','2015-01');
		
		return View::make('report/membership_sale_report');
	}

}
