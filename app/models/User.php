<?php

class User extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'fname' => 'required',
		'lname' => 'required',
		'uname' => 'required',
		'email' => 'required',
		'password' => 'required',
		'role' => 'required',
		'country' => 'required',
		'phone_1' => 'required',
		'phone_2' => 'required'
	);
}
