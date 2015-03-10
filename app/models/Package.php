<?php

/**
 * Package Model
 * ---------------
 * @author Somwang
 */

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Package extends Eloquent {

	use SoftDeletingTrait;
	
	protected $table = 'package';

	/*
	 * Get Data
	 * --------
	 */
	public static function getData() {
		$data = Package::all()->toArray();
		foreach($data as $key =>$value) {
			$data[$key]['updated_at'] = Tool::toDate($value['updated_at']);
			$data[$key]['price'] = number_format($value['price']);
		}
		return $data;
	} 
}
