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
		//ms($this->model->login());
		//ms($_SESSION['id']);
		//ms($_COOKIE);
		$login = $this->model->login();
		$this->view->generate('main_view.php', 'template_view.php',['login'=>$login]);
	}
	function action_tasks() {
		
		$data=$this->model->get_data();
		$this->view->generate_part('tasks_view.php',$data);
	}
	function action_out() {
		$this->model->out();
		//перенаправление на главную страницу сайта 
		header('Location: http://'.$_SERVER['HTTP_HOST'].'/'); 
	}
}