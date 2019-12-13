<?php

class Controller_Addform extends Controller
{
    function __construct() {
        $this->model = new Model_Addform();
        $this->view = new View();
    }
	function action_index()
	{
        
        $set_flag = $this->model->set_data();
        $this->view->generate(null, 'addform_view.php',$set_flag);
	}
}
