<?php

class Controller_Addform extends Controller
{
    function __construct() {
        $this->model = new Model_Addform('data/data.ini');
        $this->view = new View();
    }
	function action_index()
	{
        
        $this->model->set_data();
        $this->view->generate(null, 'addform_view.php');
	}
}
