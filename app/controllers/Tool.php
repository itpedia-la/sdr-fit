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

}
