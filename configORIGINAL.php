<?php
    $server = "http://yourserver.com/atomjump-loop-server/";        //Put URL to your AtomJump Loop Server install
    
    if($_SERVER['SERVER_NAME'] == '127.0.0.1') {
        $host = "http://127.0.0.1/";                                //Localhost option, for development
    } else {
        $host = "http://yoursite.com";                              //Live site, put your client website address in here
    }
 
    $unique_key = "yoursite_";                                      //This must be set to your site or business name,
                                                                    //and it should be globally unique to the $server
    
    $background_color = "#5ca7d2";                                  //Background colour
    $font_family = "Times, serif";
      
    $bootstrap_css_path = "https://atomjump.com/bower_components/bootstrap/dist/css/bootstrap.min.css";  	//Put relative/absolute URL to your bootstrap css file
    $atomjump_js_path = "https://atomjump.com/js/chat-0.9.2.js"; 					//Put relative/absolute URL to your AtomJump Loop Javascript chat.js file
    $atomjump_css_path = "https://atomjump.com/bower_components/atomjump/css/releases/comments-0.9.1.css?ver=1";              //Put relative/absolute URL to your AtomJump Loop Javascript comments.css file
    $my_machine_user = "1.1.1.1:2";                   								//Main owner of site. No longer so relevant.                                       
	$wordcloud_js_path = "node_modules/wordcloud/src/wordcloud2.js";			//Relative or absolute path to the wordcloud js file
	$jquer_js_path = "https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js";	//Relative or absolute path to the jquery js file. Ver 1.12.0 is know to be compatible.
?>

