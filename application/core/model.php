<?php

class Model
{
	public function __construct($file_path) {
		$this->file = $file_path;
	}
	
	/*
		Модель обычно включает методы выборки данных, это могут быть:
			> методы нативных библиотек pgsql или mysql;
			> методы библиотек, реализующих абстракицю данных. Например, методы библиотеки PEAR MDB2;
			> методы ORM;
			> методы для работы с NoSQL;
			> и др.
	*/
	public function set_data() {

	}
	// метод выборки данных
	public function get_data()
	{
		return $this->read();
	}
	protected function write($write_data,$key=null,$value=null) {
		if ( isset( $key ) && isset( $value ) && is_array( $write_data ) ) {
			// ищу в файле секции с парой $key=$value
			$data = parse_ini_file($this->file,true,INI_SCANNER_RAW);
			
			foreach($data as &$section) {
				foreach ($section as $sub_key=>&$sub_value) {
					if ( $key === $sub_key ) {
						if ( $sub_value === (string)$value) {
							foreach ($write_data as $w_key=>$w_value) {
								$section[$w_key] = $w_value;
							}
						}
						break;
					}
				}
			}
			// конвертируем в строку
			$str = $this->arrToini($data);

			// записываем в файл
			if ($str) {
				// перезаписываем файл
				$file = $this->file;		
				$f = fopen($file, "wt");
				flock($f, LOCK_EX); // ждем, пока мы не станем единственными
					// В этой точке мы можем быть уверены, что только эта
					// программа работает с файлом
					fwrite($f, $str);			
				fflush($f); // сбрасываем буферы на диск
				flock($f, LOCK_UN); // освобождаем файл
				fclose($f);
			} else return false;

			return true;
		} 
		
		// запись целой секцией в конец файла
		else {
			if ( is_array($write_data) ) {
				// формируем строку для записи
				$str = "[". date("d.m.y-G.i.s"). "_". $this->random()."]\n";
				foreach($write_data as $k=>$v) $str .= $k."=".$v."\n";
				$str .= "id=".$this->random()."\n";
				$str .= "\n";

				// записываем в файл строку
				$file = $this->file;		
				$f = fopen($file, "a+t");
				flock($f, LOCK_EX); // ждем, пока мы не станем единственными
					// В этой точке мы можем быть уверены, что только эта
					// программа работает с файлом
					fwrite($f, $str);			
				fflush($f); // сбрасываем буферы на диск
				flock($f, LOCK_UN); // освобождаем файл
				fclose($f); 

				return true;
			} 
			
			else {
				return false;
			}
		} 
	}
	
	protected function read($key=null,$value=null) {
		$data = parse_ini_file($this->file,true,INI_SCANNER_RAW);

		// чтение ключ=значени
		if ( isset( $key ) && isset( $value ) ) {
			$stack = [];
			foreach($data as $section) {
				foreach ($section as $sub_key=>$sub_value) {
					if ( $key === $sub_key ) {
						if ( $sub_value === $value) {
							$stack[] = $section;
						}
						break;
					}
				}
			}
			return $stack;
		} 

		// все данные
		else {
			return $data;

			//$f = fopen($this->file, "a+t") or die("Не могу открыть файл!");
			//flock($f, LOCK_SH); // ждем, пока не завершится писатель
			// В этой точке мы можем быть уверены, что в файл
			// никто не пишет
			// Все сделано. Снимаем блокировку.
			//fclose($f);
		}
			
	}
	protected function random() {
		$length = 5;
		static $randStr = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
		$rand = '';
		for($i=0; $i<$length; $i++) {
			$key = rand(0, strlen($randStr)-1);
			$rand .= $randStr[$key];
		}
		return $rand;
	}
	protected function get_POST_data() {
		return json_decode($_POST['data'],true);
	}
	protected function arrToini($arr) {
		$str = "";
		if (is_array( $arr ) ) {
			foreach($arr as $section=>$values) {
				$str.="[$section]\n";
				foreach($values as $key=>$value) {
					$str.="$key=".(string)$value."\n";
				}
				$str.="\n";
			}
			return $str;
		}
		return false;
	}
}