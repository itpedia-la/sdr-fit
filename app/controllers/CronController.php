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
	
	/*
	 * Membership Freeze Cron
	 * ----------------------
	 */
	public function membership_freeze() {
		
		//$memberships = Membership::where('status',3)->get()->toArray();
		$memberships = DB::table('membership')
						->where('status',3)
						->where('expired_freeze_updated_at',NULL)
						->orWhere('expired_freeze_updated_at','!=',date('Y-m-d'))
						->get();

		
		if( count($memberships) > 0) {
			
			foreach( $memberships as $membership ) {

				$startDate = $membership->freezed_at;
				$endDate = date('Y-m-d');
				$expired_at = $membership->expired_at;
				
				# Get freezing interval
				$dateInterval = Tool::dateInterval($startDate, $endDate);
				
				# Get new actual expired date
				$actual_expired_at = Tool::getNextDate($expired_at, $dateInterval);

				echo "Membership ID: ".$membership->id.'<br/>';
				echo "Current date: ".date('Y-m-d').'<br/>';
				echo "Start at: ".$membership->start_at.'<br/>';
				echo "Expired at: ".$expired_at.'<br/>';
				echo "Freezed at: ".$startDate.'<br/>';
				
				echo "Actual Expired at: ".$actual_expired_at.' (+'.$dateInterval.' days)<br/>';
				echo "------------------------------------------------------<br/>";
				
				# Update expired_at 
				$updateMembership = Membership::find($membership->id);
				$updateMembership->expired_at = $actual_expired_at;
				$updateMembership->expired_freeze_updated_at = date('Y-m-d');
				$updateMembership->save();
				
			}
			echo 'Freezed memberships expired date updated...('.count($memberships).')';
		} else {
			echo 'No freeze membership...';
		}
			
		
	}

}
