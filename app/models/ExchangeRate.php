<?php

/**
 * Exchange Rate Model
 * -------------------
 * @author Somwang 
 *
 */
class ExchangeRate extends Eloquent {

	protected $table = 'exchange_rate';
	

	/*
	 * Get Latest Exchange Rate
	 * 
	 */
	public static function getData($id=0) {
		
		
		$data = $id > 0 ? ExchangeRate::where('id','=',$id)->get()->toArray() : ExchangeRate::orderBy('id','desc')->skip(0)->take(1)->get()->toArray();

		$data['id'] = $data[0]['id'];
		$data['USD'] = $data[0]['USD'];
		$data['THB'] = $data[0]['THB'];
		$data['created_at'] = Tool::toDateTime($data[0]['created_at']);

		return $data; 
	}
}
