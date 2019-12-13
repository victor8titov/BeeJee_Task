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
		$m = $this->model->enter();
		
		/* //header('Location: http://'.$_SERVER['HTTP_HOST'].'/'); //перенаправление на главную страницу сайта
		
		$error = $this->model->enter();
         if (count($error) == 0) //если ошибки отсутствуют, авторизируем пользователя
        {
			
			//$this->view->generate(null, 'tasks_view.php',$data);
			 
        }  */
		
	}
	
}
