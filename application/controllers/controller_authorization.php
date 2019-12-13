<?php

class Controller_Authorization extends Controller
{
	function __construct() {
        $this->model = new Model();
        $this->view = new View();
    }

	function action_index()
	{
		$this->view->generate('authorization_view.php', 'template_view.php');
	}
	function action_enter() {
		$error = $this->model->enter();

		//если ошибки есть отдать их пользователю
		if (count($error) !== 0) {
			$this->view->generate_part('authorization_view.php',['error'=>$error]);
		}
	}
}
