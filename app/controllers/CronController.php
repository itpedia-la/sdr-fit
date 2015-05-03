<?php

class CronController extends Controller {

	/*
	 * Membership expired cron check
	 * ------------------------------
	 */
	public function membership_expired()
	{
		$membership = Membership::where('status',1)->where('expired_at',date('Y-m-d'))->update(array('status'=>4));
		
		echo 'Membership expired cron...('.count($membership).')';
	}

}
