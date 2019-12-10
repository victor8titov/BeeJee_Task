<?php

class Controller_Addform extends Controller
{
    function __construct() {
        $this->model = new Model_Addform();
        $this->view = new View();
    }
	function action_index()
	{
        $this->model->set_data();
		//$this->view->generate('main_view.php', 'template_view.php');
	}
}
