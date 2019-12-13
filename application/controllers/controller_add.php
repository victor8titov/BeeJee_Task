<?php

class Controller_Add extends Controller
{
	function __construct() {
		$this->model = new Model();
		$this->view = new View();
    }
	function action_index()
	{
		$this->model->out();
		$this->view->generate('add_view.php', 'template_view.php');
	}
}
