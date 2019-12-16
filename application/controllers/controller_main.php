<?php

class Controller_Main extends Controller
{
	function __construct() {
        $this->model = new Model_Main();
        $this->view = new View();
    }

	function action_index()
	{	
		$login = $this->model->login();
		$this->view->generate('main_view.php', 'template_view.php',['login'=>$login]);
	}
	function action_tasks() {
		
		$tasks=$this->model->get_data();
		$login = $this->model->login();
		$this->view->generate_part('tasks_view.php',['login'=>$login,'tasks'=>$tasks]);
	}
	function action_out() {
		$this->model->out();
		//перенаправление на главную страницу сайта 
		header('Location: http://'.$_SERVER['HTTP_HOST'].'/'); 
	}
	function action_savetoserver() {
		$login = $this->model->login();
		if ($login) {
			$this->model->saveTo();
			$tasks=$this->model->get_data();
			$this->view->generate_part('tasks_view.php',['tasks'=>$tasks]);
		}
		else {
			$this->view->generate_part('taskerror_view.php');
		}
		
	}
}