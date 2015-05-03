<?php

/**
 * Membership Payment Controller
 * -------------------
 * @author Somwang
 *
 */
class MembershipPaymentController extends BaseController {

	
	/*
	 * Membership Payment
	 * ------------------
	 */
	public function payment() {

		$membership_id = Route::input('membership_id');
		
		$membership = Membership::find($membership_id);
		
		$package = Package::find($membership->package_id);
		
		return View::make('membership/form_payment')->with('membership',$membership)->with('package',$package);
	}
	
	/*
	 * Membership Payment Submit
	 * -------------------------
	 */
	public function payment_save() {
		
		$membership_id = Input::get('membership_id');
		
		$rules = array (
				'payment_method' => 'required',

		);
		
		$messages = array (
				'payment_method.required' => 'Please select Payment Menthod',
		);
		
		$validator = Validator::make ( Input::all (), $rules, $messages );
		
		if ($validator->fails ()) {
		
			$messages = $validator->messages ();
		
			return Redirect::to ('membership/payment/'.$membership_id)->withErrors($validator)->withInput();
		
		} else {
		
			$exchange_rate = ExchangeRate::getData();

			$payment = new MembershipPayment();
			$payment->membership_id = $membership_id;
			$payment->payment_method = Input::get('payment_method');
			$payment->payment_note = Input::get('payment_note');
			$payment->exchange_rate_id = $exchange_rate['id'];
			$payment->discount = Input::get('discount');
			$payment->total = Input::get('total');
			$payment->cash_lak = 0;
			$payment->cash_thb = 0;
			$payment->cash_usd = 0;
			$payment->grand_total = Input::get('total') - (Input::get('total')*Input::get('discount')/100);
			$payment->user_id = Auth::id();
			$payment->save();

			$start_at = Tool::toMySqlDate(Input::get('paid_at'));
			 
			$membership = Membership::find($membership_id);
			
			# Find package
			$package = Package::find($membership->package_id);
			
			$expired_at = Tool::getNextDate($start_at, $package->days);

			$membership->start_at = $start_at;
			$membership->expired_at = $expired_at;
			$membership->status = 1;
			$membership->save();
			
			# Set expired membership to renewed stat
			Membership::where('member_id',$membership->member_id)->where('status',4)->update(array('status'=>5));
				
			return Redirect::to('membership')->with('message','Payment has been successfully made.');
		}

	}
	
	/*
	 * Get Data Json
	 * -------------
	 */
	public function getDataJson() {
		
		$data = Membership::getData();
		
		return Response::json($data)->setCallback(Input::get('callback'));
	}

}
