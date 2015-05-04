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
	public static function getData($vip) {
		
		$data = $vip == 0 ? Package::where('vip',0)->get()->toArray() : Package::where('vip',1)->get()->toArray();
		
		foreach($data as $key =>$value) {
			$data[$key]['name'] = $value['name'].' ('.number_format($value['price']).')';
			$data[$key]['updated_at'] = Tool::toDate($value['updated_at']);
			$data[$key]['price'] = number_format($value['price']);
		}
		return $data;
	} 
}
