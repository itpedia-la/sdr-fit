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

		$rules = array (
			'title' => 'required',
			'firstname' => 'required',
			'lastname' => 'required',
			'rfid_code' => 'required',
			'package_id' => 'required',
			'start_at' => 'required'
		);
	
		$messages = array (
			'title.required' => 'Please select Member title',
			'firstname.required' => 'Please enter Firstname', 
			'lastname.required' => 'Please enter Lastname',
			'rfid_code.required' => 'Please enter RFID Code',
			'package_id.required' => 'Please select Package',
			'start_at.required' => 'Please select Start date',
		);
	
		$validator = Validator::make ( Input::all (), $rules, $messages );
	
		if ($validator->fails ()) {
			
			$messages = $validator->messages ();

			return Redirect::to ($membership_id > 0 ? 'membership/edit/'.$membership_id.'/'.$member_id : 'membership/add')->withErrors($validator)->withInput();
			
		} else {

			$member = $member_id > 0 ? Member::find($member_id) : new Member();
			$member->title = Input::get('title');
			$member->firstname = Input::get('firstname');
			$member->lastname = Input::get('lastname');
			$member->rfid_code = Input::get('rfid_code');
			$member->dob = Input::get('dob') ? Tool::toMySqlDate(Input::get('dob')) : NULL;
			$member->save();
			
			$start_at = Tool::toMySqlDate(Input::get('start_at'));
		
			$membership = $membership_id > 0 ? Membership::find($membership_id) : new Membership();
			$membership->member_id = $member->id;
			$membership->start_at = $start_at;
			$membership->package_id = Input::get('package_id');
			$membership->status = 0;

			# Find package
			$package = Package::find(Input::get('package_id'));
			
			$expired_at = Tool::getNextDate($start_at, $package->days);
			
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
		
		$data = Membership::getData();
		
		return Response::json($data)->setCallback(Input::get('callback'));
	}

}
