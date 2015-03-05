<?php

/**
 * User Controller
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

}
