<?php

class Upload extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'url' => 'required',
		'title' => 'required',
		'order_id' => 'required',
		'user_id' => 'required',
		'downloads' => 'required',
		'category' => 'required'
	);
}
