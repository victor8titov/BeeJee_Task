<?php

class Model_Addform extends Model
{
	public function __construct($file) {
		parent::__construct($file);
	}
	public function set_data() {
		
		$data = json_decode($_POST['data'],true);
		$str = "[". $this->random() ."]\n" .
				"name=" . $data['name'] . "\n".
				"email=".$data['email']."\n".
				"task=".$data['task']."\n" .
				"status=".$data['status']."\n".
				"admin_create=".$data['admincreate']."\n \n";

        $this->write_file($str);
	}
	
	

}
