<?php

/**
 * Expense Item Model
 * ---------------
 * @author Somwang
 */

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Package extends Eloquent {

	use SoftDeletingTrait;
	
	protected $table = 'package';
	
	
}
