<?php

/**
 * Member Controller
 * -------------------
 * @author Somwang
 *
 */
class MemberController extends BaseController {

	/*
	 * Index
	 * -----
	 */
	public function index() {
		
		return View::make('member/index');
	}
	
	/*
	 * Add
	 * ---
	 */
	public function add() {
		
		return View::make('member/form');
	}
	
	/*
	 * Edit
	 * ------
	 */
	public function edit() {
		
		$member = Member::find(Route::input('member_id'));
		
		return View::make('member/form')->with('member',$member);
	}
	
	/*
	 * Remove
	 * ------
	 */
	public function remove() {
		
		$member = Member::where('id',Route::input('member_id'))->get()->toArray();
		foreach($member as $key => $value) {
			$member[$key]['fullname'] = $value['title'].'. '.$value['firstname'].' '.$value['lastname'];
		}
		$member = $member[0];
		return View::make('member/remove')->with('member',$member);

	}
	
	/*
	 * Remove Submit
	 * -------------
	 */
	public function removeSubmit() {
		
		$member_id = Input::get('member_id');

		$member = Member::find($member_id);
		$member->delete();
		
		return Redirect::to ( 'member' )->with ( 'message', 'Member has been successfully removed.' );
	}
	
	/*
	 * Save
	 * ----
	 */
	public function save() {

		$member_id = Input::get('member_id');

		$rules = array (
			'title' => 'required',
			'firstname' => 'required',
			'lastname' => 'required',
			'rfid_code' => 'required',
		);
	
		$messages = array (
			'title.required' => 'Please select Member title',
			'firstname.required' => 'Please enter Firstname', 
			'lastname.required' => 'Please enter Lastname',
			'rfid_code.required' => 'Please enter RFID Code',
		);
	
		$validator = Validator::make ( Input::all (), $rules, $messages );
	
		if ($validator->fails ()) {
			
			$messages = $validator->messages ();

			return Redirect::to ($member_id > 0 ? 'member/edit/'.$member_id : 'member/add')->withErrors($validator)->withInput();
			
		} else {

			$member = $member_id > 0 ? Member::find($member_id) : new Member();
			$member->title = Input::get('title');
			$member->firstname = Input::get('firstname');
			$member->lastname = Input::get('lastname');
			$member->rfid_code = Input::get('rfid_code');
			$member->dob = Tool::toMySqlDate(Input::get('dob'));
			$member->save();
				
			return Redirect::to ( 'member' )->with ( 'message', 'Member has been successfully saved.' );
		}

	}
	
	/*
	 * Get Data Json
	 * -------------
	 */
	public function getDataJson() {
		
		$data = Member::getData();
		
		return Response::json($data)->setCallback(Input::get('callback'));
	}

}
