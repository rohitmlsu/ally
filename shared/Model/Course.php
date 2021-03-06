<?php

class Model_Course extends Model_MyTable {

	public $table = "course";

	function init(){
		parent::init();

		$this->addField('name');

		$this->hasMany('PersonCourse');
		$this->hasMany('EventCourse');

		$this->is([
				'name|to_trim|required'
			]);

		$this->add('dynamic_model/Controller_AutoCreator');
	}
}