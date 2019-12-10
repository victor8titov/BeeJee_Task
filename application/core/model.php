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
		return $this->read_file();
	}
	protected function write_file($data) {
		$file = $this->file;		
		// 
		$f = fopen($file, "a+t");

		flock($f, LOCK_EX); // ждем, пока мы не станем единственными
			// В этой точке мы можем быть уверены, что только эта
			// программа работает с файлом
		fwrite($f, $data);			
		fflush($f); // сбрасываем буферы на диск
		flock($f, LOCK_UN); // освобождаем файл
		fclose($f); 
	}
	protected function read_file() {
		$data = parse_ini_file($this->file,true);
		return $data;

		//$f = fopen($this->file, "a+t") or die("Не могу открыть файл!");
		//flock($f, LOCK_SH); // ждем, пока не завершится писатель
		// В этой точке мы можем быть уверены, что в файл
		// никто не пишет
		// Все сделано. Снимаем блокировку.
		//fclose($f);
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
}