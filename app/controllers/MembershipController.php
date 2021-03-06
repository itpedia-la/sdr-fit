<?php

/**
 * Membership Controller
 * -------------------
 * @author Somwang
 *
 */
class MembershipController extends BaseController {

	/*
	 * Index
	 * -----
	 */
	public function index() {


		return View::make('membership/index');
	}
	
	/*
	 * Add
	 * ---
	 */
	public function add() {
		
		return View::make('membership/form');
	}
	
	/*
	 * Edit
	 * ------
	 */
	public function edit() {
		
		$member = Member::find(Route::input('member_id'));
		$membership = Membership::find(Route::input('membership_id'));
		
		return View::make('membership/form')->with('member',$member)->with('membership',$membership);
	}
	
	/*
	 * Cancel
	 * ------
	 */
	public function cancel() {

		return View::make('membership/remove');

	}
	
	/*
	 * Cancel Submit
	 * -------------
	 */
	public function cancelSubmit() {
		
		$membership_id = Input::get('membership_id');
		$membership = Membership::find($membership_id);
		$membership->delete();
		
		return Redirect::to ( 'membership' )->with ( 'message', 'Membership has been successfully removed.' );
	}
	
	/*
	 * Save
	 * ----
	 */
	public function save() {

		$membership_id = Input::get('membership_id');
		$member_id = Input::get('member_id');

		if( Input::get('vip') == 1 ) {
			 
			$rules = array (
					'gender' => 'required',
					'fullname' => 'required',
					'rfid_code' => 'required',
					'package_id' => 'required',
					//'price' => 'required',
					//'currency' => 'required',
					'start_at' => 'required',
					
			
			);
			
			$messages = array (
					'gender.required' => 'Please select Gender',
					'fullname.required' => 'Please enter Fullname',
					'rfid_code.required' => 'Please enter RFID Code',
					'package_id.required' => 'Please select Package',
					//'price.required' => 'Please enter VIP Price',
					//'currency.required' => 'Please select currency',
					'start_at.required' => 'Please select Start date',
					
			);
			
		} else {
			
			$rules = array (
				'gender' => 'required',
				'fullname' => 'required',
				'rfid_code' => 'required',
				'package_id' => 'required',
				'start_at' => 'required',
				
			);
		
			$messages = array (
				'gender.required' => 'Please select Gender',
				'fullname.required' => 'Please enter Fullname', 
				'rfid_code.required' => 'Please enter RFID Code',
				'package_id.required' => 'Please select Package',
				'start_at.required' => 'Please select Start date',
			);
			
		}
	
		$validator = Validator::make ( Input::all (), $rules, $messages );
	
		if ($validator->fails ()) {
			
			$messages = $validator->messages ();

			return Redirect::to ($membership_id > 0 ? 'membership/edit/'.$membership_id.'/'.$member_id : 'membership/add')->withErrors($validator)->withInput();
			
		} else {

			
			$member = $member_id > 0 ? Member::find($member_id) : new Member();
			$member->gender = Input::get('gender');
			$member->fullname = Input::get('fullname');
			$member->rfid_code = Input::get('rfid_code');
			$member->phone = Input::get('phone');
			$member->email = Input::get('email');
			//$member->dob = Input::get('dob') ? Tool::toMySqlDate(Input::get('dob')) : NULL;
			$member->save();
			
			$start_at = Tool::toMySqlDate(Input::get('start_at'));
		
			$membership = $membership_id > 0 ? Membership::find($membership_id) : new Membership();
			$membership->member_id = $member->id;
			$membership->start_at = $start_at;
			$membership->package_id = Input::get('package_id');
			$membership->status = $membership_id > 0 ? $membership->status : 0;
			$membership->discount = Input::get('discount');
			$membership->remark = Input::get('remark');

			# Find package
			$package = Package::find(Input::get('package_id'));

			$price = Input::get('vip') == 1 ? Input::get('price') : $package->price;
			
			$discount = Tool::discountCalc($price, Input::get('discount'));

			$membership->total_usd = Input::get('total_usd');
	
			$membership->total_thb = Input::get('total_thb');
		
			$membership->total_lak =  Input::get('total_lak');
	
			$membership->grand_total = $discount['remain'];
			
			$expired_at = Tool::getNextDateByMonth($start_at, $package->months);
			
			$membership->expired_at = $expired_at;
			$membership->save();

			return Redirect::to ( 'membership' )->with ( 'message', 'Membership has been successfully saved.' );
		}

	}
	
	/*
	 * Get Data Json
	 * -------------
	 */
	public function getDataJson() {
		
		$year = Route::input('year');
		$data = Membership::getData($year);
		
		return Response::json($data)->setCallback(Input::get('callback'));
	}
	
	/*
	 * Membership Freeze
	 * -----------------
	 */
	public function freeze() {

		return View::make('membership/form_freeze');
	}
	
	/*
	 * Membership Freeze submit
	 * ------------------------
	 */
	public function freeze_submit() {
		
		$membership_id = Input::get('membership_id');

		$membership = Membership::find($membership_id);
		$membership->status = 3;
		$membership->freezed_at = Tool::toMySqlDate(Input::get('freezed_at'));
		$membership->save();
		
		return Redirect::to ( 'membership' )->with ( 'message', 'Membership has been successfully freezing.' );
	}
	
	/*
	 * Membership Unfreeze
	 * -------------------
	 */
	public function unfreeze() {
	
		return View::make('membership/form_unfreeze');
	}
	
	/*
	 * Membership Unfreeze submit
	 * ------------------------
	 */
	public function unfreeze_submit() {
	
		$membership_id = Input::get('membership_id');
	
		$membership = Membership::find($membership_id);
		$membership->status = 1;
		$membership->unfreezed_at = Tool::toMySqlDate(Input::get('unfreezed_at'));
		$membership->save();
	
		return Redirect::to ( 'membership' )->with ( 'message', 'Membership has been successfully unfreezing.' );
	}
	
	/*
	 * Membership Renew
	 * ----------------
	 */
	public function renew() {

		$member = Member::find(Route::input('member_id'));
		
		$membership = Membership::find(Route::input('membership_id'));
		
		return View::make('membership/form_renew')->with('member',$member)->with('membership',$membership);
	}
	
	/* 
	 * Membership Renew save
	 * -----------------------
	 */
	public function renew_save() {
		
		
		$membership_id = Input::get('membership_id');
		$member_id = Input::get('member_id');
		
		$rules = array (
				'gender' => 'required',
				'fullname' => 'required',
				//'lastname' => 'required',
				'rfid_code' => 'required',
				//'phone' => 'required',
				'package_id' => 'required',
				'start_at' => 'required',
					
		);
		
		$messages = array (
				'gender.required' => 'Please select Gender',
				'fullname.required' => 'Please enter Fullname',
				//'lastname.required' => 'Please enter Lastname',
				'rfid_code.required' => 'Please enter RFID Code',
				//'phone.required' => 'Please enter phone number',
				'package_id.required' => 'Please select Package',
				'start_at.required' => 'Please select Start date',
		);
		
		$validator = Validator::make ( Input::all (), $rules, $messages );
		
		if ($validator->fails ()) {
				
			$messages = $validator->messages ();
		
			return Redirect::to ($membership_id > 0 ? 'membership/edit/'.$membership_id.'/'.$member_id : 'membership/add')->withErrors($validator)->withInput();
				
		} else {
		
			$member = Member::find($member_id);
			$member->gender = Input::get('gender');
			$member->fullname = Input::get('fullname');
			//$member->lastname = Input::get('lastname');
			$member->rfid_code = Input::get('rfid_code');
			$member->phone = Input::get('phone');
			$member->email = Input::get('email');
			//$member->dob = Input::get('dob') ? Tool::toMySqlDate(Input::get('dob')) : NULL;
			$member->save();
				
			$start_at = Tool::toMySqlDate(Input::get('start_at'));
		
			$membership = new Membership();
			$membership->member_id = $member->id;
			$membership->start_at = $start_at;
			$membership->package_id = Input::get('package_id');
			$membership->status = 0;
			
			# Find package
			$package = Package::find(Input::get('package_id'));
				
			$expired_at = Tool::getNextDateByMonth($start_at, $package->months);
				
			$membership->expired_at = $expired_at;
			$membership->save();

			return Redirect::to ( 'membership' )->with ( 'message', 'Membership has been successfully renewed.' );
		}
	}

}
