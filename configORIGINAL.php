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
                                                                    
?>

