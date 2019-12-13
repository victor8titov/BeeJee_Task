<?php

class Controller_Add extends Controller
{
	function __construct() {
		$this->model = new Model();
		$this->view = new View();
    }
	function action_index()
	{
		$login = $this->model->login();
		$this->view->generate('add_view.php', 'template_view.php',['login'=>$login]);
	}
}
