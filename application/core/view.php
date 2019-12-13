<?php

class View
{
	/*
	$content_file - виды отображающие контент страниц;
	$template_file - общий для всех страниц шаблон;
	$data - массив, содержащий элементы контента страницы. 
	*/
	function generate($content_view, $template_view, $data = null)
	{
		$URI = Route::parsingURI();
		$namePage = $URI[1];
		
		/*
		динамически подключаем общий шаблон (вид),
		внутри которого будет встраиваться вид
		для отображения контента конкретной страницы.
		*/
		include 'application/views/'.$template_view;
	}
	function generate_part($content_view, $data=null) {
		include 'application/views/'.$content_view;
	}
}
