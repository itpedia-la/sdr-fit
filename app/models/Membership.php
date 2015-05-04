<?php

/**
 * Membership Model
 * ---------------
 * @author Somwang
 */

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Membership extends Eloquent {

	use SoftDeletingTrait;
	
	protected $table = 'membership';

	/*
	 * Get Data
	 * --------
	 */
	public static function getData($year=null) {
		
		if( $year > 0) {

			$data = Membership::where('id','>',0)->where('created_at','>=',$year.'-01-01')->where('created_at','<=',$year.'-12-31')->orderBy('id','desc')->get()->toArray();
			
		} else {
			
			$data = Membership::where('id','>',0)->orderBy('id','desc')->get()->toArray();
		}
		
		
		foreach($data as $key =>$value) {
			
			# Find Member
			$member = Member::find($value['member_id']);
			
			# Find Package
			$package = Package::find($value['package_id']);
			
			$data[$key]['fullname'] = $member->title.'. '.$member->firstname.' '.$member->lastname;
			$data[$key]['vip'] = $member->vip == 1 ? 'Yes' : 'No';
			$data[$key]['dob'] = Tool::toDate($member->dob);
			$data[$key]['package'] = $package->name;
			$data[$key]['rfid_code'] = $member->rfid_code;
			$data[$key]['phone'] = $member->phone;
			$data[$key]['freezed_at'] = Tool::toDate($value['freezed_at']);
			$data[$key]['unfreezed_at'] = Tool::toDate($value['unfreezed_at']);
			$data[$key]['start_at'] = Tool::toDate($value['start_at']);
			$data[$key]['expired_at'] = Tool::toDate($value['expired_at']);
			$data[$key]['statusHtml'] = Membership::getStatus($value['status']);
			$data[$key]['status'] = $value['status'];
			
		}
		return $data;
	} 
	
	/*
	 * Status
	 * ------
	 */
	public static function getStatus($status) {
	
		switch( $status ) {
				
			// Active
			case 1:
				$data = '<span class="tag green">Active</span>';
				break;
	
			// Expiring
			case 2:
				$data = '<span class="tag orange">Expiring</span>';
				break;
			
			// Freezing
			case 3:
				$data = '<span class="tag blue">Freezing</span>';
				break;
			
			// Expired
			case 4: 
				$data = '<span class="tag red">Expired</span>';
				break;
				
			// Renewed
				case 5:
				$data = '<span class="tag light-gray-bordered">Renewed</span>';
				break;
				
			// Pending
			default:
				$data = '<span class="tag orange">Payment Waiting</span>';
				break;
		}
		
		return $data;
	}
}
