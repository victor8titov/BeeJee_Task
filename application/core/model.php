<?php

class Model
{
	
	/* public methods */
	public function set_data() {

	}

	public function get_data() 	{
		return $this->read();
	}

	public function login() {
		ini_set ("session.use_trans_sid", true);    
		session_start();
		
		//если сесcия есть   
		if (isset($_SESSION['id'])) {   
			//если cookie есть, обновляется время их жизни и возвращается true              
			if(isset($_COOKIE['login']) && isset($_COOKIE['password'])) {           
				SetCookie("login", "", time() - 1, '/');            
				SetCookie("password","", time() - 1, '/');          

				setcookie ("login", $_COOKIE['login'], time() + 50000, '/');            

				setcookie ("password", $_COOKIE['password'], time() + 50000, '/');          

				$id = $_SESSION['id'];          
				$this->lastAct($id);           
				return true;        

			}    
			
			//иначе добавляются cookie с логином и паролем, чтобы после перезапуска браузера сессия не слетала         
			else {           
				//$rez = mysql_query("SELECT * FROM users WHERE id='{$_SESSION['id']}'"); 
				//запрашивается строка с искомым id             
				$rez = $this->read(USERS,'id',$_SESSION['id']);

				//если получена одна строка          
				if (count($rez) == 1) {       
					$user = array_shift($rez); //она записывается в ассоциативный массив               

					setcookie ("login", $user['login'], time()+50000, '/');              

					setcookie ("password", md5($user['login'].$user['password']), time() + 50000, '/'); 

					$id = $_SESSION['id'];
					$this->lastAct($id); 
					return true;            

				} 
				else return false;      
			}   
			
		}   

		//если сессии нет, проверяется существование cookie. Если они существуют, проверяется их валидность по базе данных     
		else {       
			//если куки существуют      
			if(isset($_COOKIE['login']) && isset($_COOKIE['password'])) {           
				//$rez = mysql_query("SELECT * FROM users WHERE login='{$_COOKIE['login']}'"); 

				//запрашивается строка с искомым логином и паролем             
				$rez = $this->read(USERS,'login',$_COOKIE['login']);
				$user = array_shift($rez);            

				//если логин и пароль нашлись в базе данных
				if(count($rez) == 1 && md5($user['login'].$user['password']) == $_COOKIE['password']) {               
					$_SESSION['id'] = $user['id']; //записываем в сесиию id              
					$id = $_SESSION['id'];              

					$this->lastAct($id);               
					return true;            
				}           
				else //если данные из cookie не подошли, эти куки удаляются             
				{               
					SetCookie("login", "", time() - 360000, '/');               

					SetCookie("password", "", time() - 360000, '/');                    
					return false;           

				}       
			}       
			else //если куки не существуют      
			{           
			return false;       
			}   
		} 
	}

	public function enter() {
		//массив для ошибок  
		$error = array();  
		//если поля заполнены   
		if ($_POST['login'] != "" && $_POST['password'] != "")  {       
			$login = $_POST['login']; 
			$password = $_POST['password'];

			$rez = $this->read(USERS,'login',$login);
			//$rez = mysql_query("SELECT * FROM users WHERE login=$login"); //запрашивается строка из базы данных с логином, введённым пользователем      

			//если нашлась одна строка, значит такой юзер существует в базе данных       
			if (count($rez) == 1) {           
				$user = array_shift($rez);             

				//сравнивается хэшированный пароль из базы данных с хэшированными паролем, введённым пользователем         
				               
				if (md5(md5($password).$user['salt']) == $user['password']) { 
					//пишутся логин и хэшированный пароль в cookie, также создаётся переменная сессии
					setcookie ("login", $user['login'], time() + 50000);                         
					setcookie ("password", md5($user['login'].$user['password']), time() + 50000);            
					
					session_start();
					$_SESSION['id'] = $user['id'];   //записываем в сессию id пользователя               

					$id = $_SESSION['id'];              
					$this->lastAct($id); 
					return $error;          
				}   

				//если пароли не совпали           
				else {               
					$error[] = "Неверный пароль";                                       
					return $error;          
				}       
			}

			//если такого пользователя не найдено в базе данных       
			else  {           
				$error[] = "Неверный логин и пароль";           
				return $error;      
			}   
		}   

		else   {       
			$error[] = "Поля не должны быть пустыми!";              
			return $error;  
		} 
	}

	public function createUser($login,$password) {
		$salt = $this->random();
		$user = [
			'login'		=>$login,
			'salt'		=>$salt,
			'password'	=>md5(md5($password).$salt),
			'id'		=>$this->random(),
			'online'	=>'',
			'last_act'  =>'',
		];
		return $this->write(USERS,$user);
	}

	public function out() {
		session_start();    
		$id = $_SESSION['id'];              
		
		if ( isset($id) ) {
			//обнуляется поле online, говорящее, что пользователь вышел с сайта (пригодится в будущем)     
			$this->write(USERS,['online',0],'id',$id); 
			//mysql_query("UPDATE users SET online=0 WHERE id='$id'"); 
		
			unset($_SESSION['id']); //удалятся переменная сессии    
		
			SetCookie("login", ""); //удаляются cookie с логином    
		
			SetCookie("password", ""); //удаляются cookie с паролем     
			ms('logout');
			//header('Location: http://'.$_SERVER['HTTP_HOST'].'/'); //перенаправление на главную страницу сайта 
		}
	}

	/* protected methods */
	protected function lastAct($id) {
		$tm = time();   $this->write(USERS,['online'=>$tm, 'last_act'=>$tm],'id',$id); 
	}
	protected function write($file,$write_data,$key=null,$value=null) {
		if ( isset( $key ) && isset( $value ) && is_array( $write_data ) ) {
			// ищу в файле секции с парой $key=$value
			$data = parse_ini_file($file,true,INI_SCANNER_RAW);
			
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
				$str .= "\n";

				// записываем в файл строку
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
	
	protected function read($file,$key=null,$value=null) {
		$data = parse_ini_file($file,true,INI_SCANNER_RAW);

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

			//$f = fopen($file, "a+t") or die("Не могу открыть файл!");
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