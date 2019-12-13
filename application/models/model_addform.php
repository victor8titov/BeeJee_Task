<?php

class Model_Addform extends Model
{
	public function set_data() {
		if ( 	isset( $_POST['name'] ) && 
				isset( $_POST['email'] ) && 
				isset( $_POST['task'] ) && 
				isset( $_POST['status'] ) &&
				isset( $_POST['admincreate'] ) ) {

			$section = [
				"name" 			=>$_POST['name'],
				"email"			=>$_POST['email'],
				"task"			=>$_POST['task'],
				"status"		=>$_POST['status'],
				"admin_create"	=>$_POST['admincreate'],
				"id"			=>$this->random()
			];
			$w = $this->write(DATA,$section);
			if ($w) return true;
		}
		return false;
	}
}
