<?php

// подключаем файлы ядра
require_once 'core/model.php';
require_once 'core/view.php';
require_once 'core/controller.php';

// пути для файлов
define('DATA','data/data.ini');
define('USERS','data/users.ini');

require_once 'core/route.php';
Route::start(); // запускаем маршрутизатор
