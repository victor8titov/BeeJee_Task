<?php

class Model_Main extends Model
{
	public function __construct($file) {
		parent::__construct($file);
	}
	public function get_data()
	{
		return $this->read_file();
	}
	
	

}
