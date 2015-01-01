<?php

class Photo extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'photos';

	//the variable that sets which columns can be edited
    protected $fillable = array('title','image');

    //The variable which enables or disables the Laravel's timestamps option
    public $timestamps = true;

    //rules of the image upload form
    public static $upload_rules = array(
    	'title'=> 'required|min:3',
		'image'=> 'required|image'
		);
}
