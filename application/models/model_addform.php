<?php

class Model_Addform extends Model
{
	public function __construct($file) {
		parent::__construct($file);
	}
	public function set_data() {
		$data = $this->get_POST_data();
		$section = [
			"name" 			=>$data['name'],
			"email"			=>$data['email'],
			"task"			=>$data['task'],
			"status"		=>$data['status'],
			"admin_create"	=>$data['admincreate'],
		];
        $this->write($section);
	}
	
	

}
