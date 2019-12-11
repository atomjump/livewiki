<?php
	$server = "http://yourserver.com/atomjump-loop-server/";        //Put URL to your AtomJump Loop Server install

    $host = "http://" . $_SERVER['HTTP_HOST'] . "/livewiki/";       //LiveWiki site, put your client website address in here

	$unique_key = "yoursite_";                                      //This must be set to your site or business name,
																	//and it should be globally unique to the $server

	$background_color = "#5ca7d2";                                  //Background colour
	$font_family = "Times, serif";
  
	$bootstrap_css_path = "css/bootstrap.min.css";  	//Put relative/absolute URL to your bootstrap css file
	$atomjump_js_path = "js/chat-1.0.5.js"; 					//Put relative/absolute URL to your AtomJump Loop Javascript chat.js file
	$atomjump_css_path = "css/comments-1.0.0.css?ver=1";              //Put relative/absolute URL to your AtomJump Loop Javascript comments.css file
	$my_machine_user = "1.1.1.1:2";                   								//Main owner of site. No longer so relevant.                                       
	$wordcloud_js_path = "js/wordcloud2.js";			//Relative or absolute path to the wordcloud js file
	$jquery_js_path = "js/jquery.min.js";	//Relative or absolute path to the jquery js file. Ver 1.12.0 is know to be compatible.

	$html5shiv_path = "js/html5shiv.js";		//Relative or absolute path to IE handling HTML5
	$respond_path = "js/respond.min.js";		//Relative or absolute path to IE handling HTML5


?>

