<?php

class Model_Main extends Model
{
	public function __construct($file) {
		parent::__construct($file);
	}
	public function get_data()
	{
        $filter_config = $this->get_POST_data();
        $tasks = $this->read_file();
        $tasks = $this->filtration_of_task($tasks, $filter_config);
        return $tasks;
    }
    protected function filtration_of_task($tasks, $config) {
        
        // сортировка по имени
        if ($config['type'] === 'name') {
            uasort($tasks, function($a,$b){
                return strcmp($a['name'], $b['name']);
            });
        }

        // сортировка по почте
        if ($config['type'] === 'email') {
            uasort($tasks, function($a,$b){
                return strcmp($a['email'], $b['email']);
            });
        }

        // сортировка по убыванию
        if ($config['direction'] === 'on_decrease' && $config['type'] !== 'undefined') {
            $tasks = array_reverse($tasks);
        }

        // галочка выполнено
        if ($config['status']) 
            $tasks = array_filter($tasks, function($task) {
                return $task['status'] || $task['status'] === 'true';
            });

        // галочка отредактированно администратором
        if ($config['admin_create']) 
            $tasks = array_filter($tasks, function($task) {
                return $task['admin_create'] || $task['admin_create'] === 'true';
            });

        return $tasks;    
    }
	
	

}
