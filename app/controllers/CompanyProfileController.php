<?php

/**
 * Company Profile Controller
 * --------------------------
 * @author Somwang
 *
 */
class CompanyProfileController extends BaseController {

	
	/**
	 * Company Profile Index
	 * ---------------------
	 * @author Somwang
	 */
	public function profile()
	{
		$profile  = CompanyProfile::first();
		return View::make('company_profile.index')->with('profile',$profile);
	}
	
	/*
	 * Profile Update
	 * 
	 */
	public function update() {
		
		$profile = CompanyProfile::find(1);
		$profile->company_name = Input::get('company_name');
		$profile->logo = Input::get('logo');
		$profile->address = Input::get('address');
		$profile->fax = Input::get('fax');
		$profile->telephone = Input::get('telephone');
		$profile->mobile = Input::get('mobile');
		$profile->email = Input::get('email');
		$profile->website = Input::get('website');
		$profile->save();
		
		return Redirect::to('company/profile')->with('message','You Company Profile has been successfully updated.');
	}
	

}
