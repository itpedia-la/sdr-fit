<?php

class LoginController extends Controller {

	/**
	 * Login
	 * --------------
	 * @author Somwang Souksavatd
	 */
	public function login()
	{
		return View::make('user/login');
	}
	
	/**
	 * Login Submit
	 * ------------
	 * @author Somwang
	 */
	public function submit() {

		//exit(Hash::make('dungc18a'));
		
		$rules = array(
			'email'            => 'required',     // required and must be unique in the ducks table
			'password'         => 'required'
		);
		
		$messages = array(
			'email.required' => 'Please enter user ID',
			'password.required' => 'Please enter Password'
		);
	
		$validator = Validator::make(Input::all(), $rules, $messages);
	
		if ($validator->fails()) {
			 
			// get the error messages from the validator
			$messages = $validator->messages();
			 
			// redirect our user back to the form with the errors from the validator
			return Redirect::to('user/login')->withErrors($validator);
			 
		} else {
	
			$userdata = array(
					'login' => Input::get('email'),
					'password' => Input::get('password')
			);
	
			if (Auth::attempt($userdata)) {
	
				$user = User::find(Auth::id());
				Session::put('user', $user);
	
				return Redirect::to('/membership');
				 
			} else {
	
				return Redirect::to('user/login')->with('message', 'ລະຫັດຜູ້ໃຊ້ ແລະ ລະຫັດຜ່ານບໍ່ຖືກຕ້ອງ');
			}
			 
		}
	}
}
