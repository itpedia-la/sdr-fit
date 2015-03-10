<?php

/**
 * Package Controller
 * -------------------
 * @author Somwang
 *
 */
class PackageController extends BaseController {

	/*
	 * Index
	 * -----
	 */
	public function index() {
		
		return View::make('package/index');
	}
	
	/*
	 * Add
	 * ---
	 */
	public function add() {
		
		return View::make('package/form');
	}
	
	/*
	 * Edit
	 * ------
	 */
	public function edit() {
		
		$package = Package::find(Route::input('package_id'));
		
		return View::make('package/form')->with('package',$package);
	}
	
	/*
	 * Remove
	 * ------
	 */
	public function remove() {
		
		$package = Package::find(Route::input('package_id'));
		
		return View::make('package/remove')->with('package',$package);

	}
	
	/*
	 * Remove Submit
	 * -------------
	 */
	public function removeSubmit() {
		
		$package_id = Input::get('package_id');
		$package = Package::find($package_id);
		$package->delete();
		
		return Redirect::to ( 'package' )->with ( 'message', 'Data has been successfully removed.' );
	}
	
	/*
	 * Save
	 * ----
	 */
	public function save() {

		$package_id = Input::get('package_id');

		$rules = array (
			'name' => 'required',
			'days' => 'required',
			'price' => 'required'
		);
	
		$messages = array (
			'name.required' => 'Please enter Package name',
			'days.required' => 'Please enter Package days', 
			'price.required' => 'Please enter Package price'
		);
	
		$validator = Validator::make ( Input::all (), $rules, $messages );
	
		if ($validator->fails ()) {
			
			$messages = $validator->messages ();

			return Redirect::to ($package_id > 0 ? 'package/edit/'.$package_id : 'package/add')->withErrors($validator)->withInput();
			
		} else {

			$package = $package_id > 0 ? Package::find($package_id) : new Package();
			$package->name = Input::get('name');
			$package->days = Input::get('days');
			$package->price = Input::get('price');
			$package->save();
				
			return Redirect::to ( 'package' )->with ( 'message', 'Data has been successfully saved.' );
		}

	}
	
	/*
	 * Get Data Json
	 * -------------
	 */
	public function getDataJson() {
		
		$data = Package::getData();
		
		return Response::json($data)->setCallback(Input::get('callback'));
	}

}
