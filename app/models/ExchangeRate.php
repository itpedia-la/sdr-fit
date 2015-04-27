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
		
		
		$data = $id > 0 ? ExchangeRate::where('id','=',$id)->get()->toArray() : ExchangeRate::where('id','>',0)->orderBy('id','desc')->get()->first();

		if( $data->exists == 1 ) {
			$data = $data->toArray();
			$data['created_at'] = Tool::toDate($data['created_at']);
		}

		return $data; 
	}

}
