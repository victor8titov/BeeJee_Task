<?php

class Controller_Main extends Controller
{
	function __construct() {
        $this->model = new Model_Main();
        $this->view = new View();
    }

	function action_index()
	{	
		//$this->model->createUser('admin','123');
		ms($this->model->login());
		ms($_SESSION['id']);
		ms($_COOKIE);
		$this->view->generate('main_view.php', 'template_view.php');
	}
	function action_tasks() {
		
		$data=$this->model->get_data();
		$this->view->generate(null, 'tasks_view.php',$data);
	}
}