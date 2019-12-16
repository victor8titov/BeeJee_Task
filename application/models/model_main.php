<?php

class Model_Main extends Model
{
	
	public function get_data()
	{

        $tasks = $this->read(DATA);
        $tasks = $this->filtration_of_task($tasks, $filter_config);
        return $tasks;
    }
    public function saveTo() {
        $data = json_decode( $_POST['data']);
        foreach ( $data as $id=>&$task) {
            if ( array_key_exists('delete', $task) ) {
                $this->delete(DATA,'id',$id);
                continue;
            }
        } 
        $w = $this->write(DATA, (array)$task,'id',$id);
    }
    protected function filtration_of_task($tasks) {
        $config = [
            'type'=>        isset( $_POST['type'] ) ? $_POST['type'] : 'undefined',
            'direction'=>   isset( $_POST['direction'] ) ? $_POST['direction'] : 'on_increase',
            'status'=>      isset( $_POST['status'] ) ? $_POST['status'] : 'false',
            'admin_create'=>isset( $_POST['admin_create'] ) ? $_POST['admin_create'] : 'false'
        ];

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
        if ($config['status']==='true') 
            $tasks = array_filter($tasks, function($task) {
                return $task['status'] === 'true';
            });

        // галочка отредактированно администратором
        if ($config['admin_create']==='true') 
            $tasks = array_filter($tasks, function($task) {
                return  $task['admin_create'] === 'true';
            });

        return $tasks;    
    }
	
	

}
