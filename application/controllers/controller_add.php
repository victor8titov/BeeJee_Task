<?php

class Controller_Add extends Controller
{
	function __construct() {
		$this->model = new Model_Add();
		$this->view = new View();
    }
	function action_index()
	{
		$login = $this->model->login();
		$this->view->generate('add_view.php', 'template_view.php',['login'=>$login]);
	}
	function action_addtask() {
		$flag = $this->model->set_data();
        $this->view->generate_part('add_view.php',['flag'=>$flag]);
	}
}
