<?php

class Controller_Authorization extends Controller
{
	
	function action_index()
	{
		$this->view->generate('authorization_view.php', 'template_view.php');
	}
}
