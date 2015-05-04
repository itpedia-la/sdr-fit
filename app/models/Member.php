<?php

/**
 * Member Model
 * ---------------
 * @author Somwang
 */

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Member extends Eloquent {

	use SoftDeletingTrait;
	
	protected $table = 'member';

	/*
	 * Get Data
	 * --------
	 */
	public static function getData() {
		$data = Member::all()->toArray();
		foreach($data as $key =>$value) {
			$data[$key]['fullname'] = $value['fullname'];
			$data[$key]['vip'] = $value['vip'] == 1 ? 'Yes' : 'No';
			$data[$key]['dob'] = Tool::toDate($value['dob']);
			$data[$key]['updated_at'] = Tool::toDate($value['updated_at']);
		}
		return $data;
	} 
}
