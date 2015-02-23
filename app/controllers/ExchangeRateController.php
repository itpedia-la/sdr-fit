<?php

use Illuminate\Http\Response;
/**
 * Exchange Rate Controller
 * ------------------------
 * @author Somwang Souksavatd
 *
 */
class ExchangeRateController extends BaseController {

	
	/**
	 * Exchange Rate Index
	 * --------------
	 * @author Somwang
	 */
	public function index(){
		
		$exchange = ExchangeRate::orderby('created_at', 'desc')->first();

		return View::make('exchange.index')->with('exchange',$exchange);
	}
	
	/**
	 * Exchange Rate Save
	 * ------------------
	 * @author Somwang
	 */
	public function save(){
		
		$us = doubleval(Input::get('us'));
		$bath = doubleval(Input::get('bath'));
		
		$exchange = new ExchangeRate();
		$exchange->USD = $us;
		$exchange->THB = $bath;
		$exchange->save();
		
		return Redirect::to('exchange_rate')->with('message','Exchange rate has been successfully updated.');
	}	
	
	
	
}
