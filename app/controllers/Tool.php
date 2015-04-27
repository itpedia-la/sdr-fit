<?php

/**
 * Tool Controller
 * ---------------
 * @author Somwang
 *
 */
class Tool {

	/**
	 * Convert Mysql Date/Time to Formal standard format
	 * -------------------------------------------------
	 * @param unknown $mysqldatetime
	 */
	public static function toDate($mysqldatetime)
	{
		return $mysqldatetime != "" ? date('d-M-Y',strtotime($mysqldatetime)) : null;
	}
	
	/**
	 * Convert Mysql Date/Time to Formal standard format
	 * -------------------------------------------------
	 * @param unknown $mysqldatetime
	 */
	public static function toDateTime($mysqldatetime)
	{
		return $mysqldatetime ? date('d-M-Y H:i',strtotime($mysqldatetime)) : null;
	}
	
	/**
	 * Convert Date to mysql Datetime
	 * -------------------------------
	 */
	public static function toMySqlDate($date) {
		
		return $date ? date('Y-m-d',strtotime($date)) : NULL;
		
	}
	
	/**
	 * Convert input date Mysql Date/Time
	 * ----------------------------------
	 * @param unknown $mysqldatetime
	 */
	public static function toMySqlDateTime($date)
	{
		return date('Y-m-d H:i:00',strtotime($date));
	}
	
	
	/**
	 * Get Next Date
	 * -------------
	 * @param $date Date
	 * @param $number_of_date Number of Days
	 */
	public static function getNextDate($date, $number_of_date) {
	
		$next_date = strtotime("+".$number_of_date." days", strtotime($date));
		$next_date = date("Y-m-d",$next_date);
	
		return $next_date;
	}

}
