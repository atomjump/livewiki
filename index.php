<?php

    /*
        Installation notes:
        
        npm install wordcloud
        bower install atomjump
        
        Put this script and it's fellow files on your client website. Then configure the following
    */

    //Configurable Params
    require_once("./config.php");
                                                                    

	//Ensure no caching
	header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	header("Pragma: no-cache"); // HTTP/1.0
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <script src="node_modules/wordcloud/src/wordcloud2.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
   
	<!-- Must be before the other css files for global reach -->
    <style>
    
        html, body {
            height:100%;
            margin:0;
            padding:0;
            
        }
        
        body {
        	background-image: url("images/backdrop1280.jpg");
        	background-size: cover;
        	
        }
 
        .container-fluid {
          height:100%;
          display:table;
          width: 100%;
          padding: 0;
        }
         
        .row-fluid {
            height: 100%;
            display:table-cell;
            vertical-align: middle;
        }

        .centering {
          float:none;
          margin:0 auto;
        }
        

        
 
   
    </style>


    <!-- AtomJump Feedback Starts -->
   <!-- Bootstrap core CSS. Ver 3.3.1 sits in css/bootstrap.min.css -->
	  <link rel="StyleSheet" href="<?php echo $bootstrap_css_path ?>/bootstrap.min.css" rel="stylesheet">
	
	<!-- AtomJump Feedback CSS -->
	<link rel="StyleSheet" href="<?php echo $atomjump_path ?>/css/comments.css">




	
	<!-- Bootstrap HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
	
	
	<!-- Must be after the others to stress the importance -->
	<style>

   	   /* a {
			font-family: <?php echo $font_family ?> !important;
		}*/

		a.list:hover, a.list:visited, a.list:link, a.list:active
		{
			font-family: <?php echo $font_family ?> !important;
			text-decoration: none;
		}
		
		.input-group-addon {
 		    width:30%;
    		text-align:left;
		}
		
		
	 </style>


	
	<script>
		//Add your configuration here for AtomJump Feedback
		var ajFeedback = {
			"uniqueFeedbackId" : "<?php echo $unique_key ?>home",		//This can be anything globally unique to your company/page	
			"myMachineUser" : "1.1.1.1:3",			/* Obtain this value from 1. Settings
																			2. Entering an email/Password
																			3. Click save
																			4. Settings
																			5. Clicking: 'Your password', then 'Developer Tools'
																			6. Copy the myMachineUser into here.
					
													*/
			"server":  "<?php echo $server ?>"
		}
	</script>
	<script type="text/javascript" src="<?php echo $atomjump_path ?>/js/chat.js"></script>
	<!-- AtomJump Feedback Ends -->
   
</head>
<body>
    <div id="comment-holder"></div><!-- holds the popup comments. Can be anywhere between the <body> tags -->
    <div class="container-fluid" >
        <div id="show-word-cloud" class="row" style="padding-top: 10px;">
            
            <div class="col-md-12">
                <div class="centering text-center">
                 
                   <span id="my-comments" class="comment-open" style="display: none;" href="javascript:">Click me for comments</span>
		            <!-- Any link on the page can have the 'comment-open' class added and a blank 'href="javascript:"' -->
	            
 					<div style="position: relative; width:100%; height: 768px; margin-left: auto; margin-right:auto; background: url('images/000000-0.8.png');;">
						<div id="my_canvas" style="width:100%; height: 768px; position: relative;"></div>	
					</div>
 										
                  
                    
                    
                   
                    
                 </div>
            </div>
            
        </div> <!-- end of row -->
 
 
        <div id="show-mobile-display" class="row" style="padding-top: 10px;">
            
            <div class="col-md-12">
                <div class="centering text-center">
                	<div id="mobile-display-back" style="position: relative; top: 0px; height: 1000px; background-color:#FFF; padding: 10px; opacity: 0.8;"></div>
                    <div id="mobile-display" style="position: absolute; top: 10px;"></div>
                 </div>
            </div>
            
        </div> <!-- end of row -->
        
 
        
        <div class="row" style="padding-top: 10px;">
          <div class="col-md-2"></div>
          <div class="col-md-8">
            <div class="centering text-center">
                <form action="add-forum.php" class="form-inline" style="vertical-align: middle" >
                  <div class="form-group" >
                    <label class="sr-only" for="forum">Add</label>
                    <div class="input-group" style="margin: 4px;">
                        
                        <input name="new-forum" type="text" class="form-control" id="forum" placeholder="New Forum">
                        <div class="input-group-addon">
                            <select name="temperature" class="form-control" style="height:20px; padding:0px;">
                              <option value="0">Remove me</option>
                              <option value="3">Cold as ice</option>
                              <option value="4">Luke Warm</option>
                              <option value="5" selected="selected">Mild</option>
                              <option value="6">Hot stuff</option>
                              <option value="8">Surface of the sun</option>
                            </select>
                        </div>
                    </div> <!-- end of input group -->
                    <button id="submit-button" type="submit" class="btn btn-primary">Submit</button>
                  </div>  <!-- end of form group -->

                  
                </form>
             </div>
          
           </div> <!-- end of col -->
           <div class="col-md-2"></div>            
          
        </div> <!-- end of row -->
        
 
        
    </div>

    
    
 
   
     <script>
       
        var treeData;
        var words = {};
			
		//Courtesy detectmobilebrowsers.com
        window.mobilecheck = function() {
		  var check = false;
		  (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4)))check = true})(navigator.userAgent||navigator.vendor||window.opera);
		  return check;
		}
			
		if(window.mobilecheck() == true) {
			//Mobile version
			$('#show-word-cloud').hide();
			$('#forum').css('width', '300px;');
			
		} else {
			$('#show-mobile-display').hide();
			
		}


        var oReq = new XMLHttpRequest();
        oReq.onload = reqListener;
        oReq.open("get", "<?php echo $host ?>/data/words.json?cs=" + Math.random(), true);
        oReq.setRequestHeader("Cache-Control", "no-cache");
        oReq.send();

		function getColor(word, weight, cnt) {
			var col;
					if ((cnt === 0)||(word == words.list[0][0])) {		//very first central entry
						col = '#2E605C';
					} else {
						var char = Math.abs(parseInt((word.charCodeAt(0) - 97)/5)); // = 0-25 /5 = 0-5
					
						var colours = [ '#333', '#444', '#555', '#666', '#777' ];
						if(colours[char]) {
							col = colours[char];
						} else {
							col = '#333';
						}
					}
					return col;
		}
		
		function clickEntry(index, size) {
		  	//Modify the local clickable feedback link, then click it
	        $('#my-comments').data('uniquefeedbackid', "<?php echo $unique_key ?>" + index[0]);
	        $('#my-comments').trigger("click");
	        return false;
		
		}
		

        function reqListener(e) {
            
           
            words = JSON.parse(this.responseText);
            
            //A mobile version is built for the mobile screens - a list of the text down the screen, only.
            var all= "";
            var list = words.list;
            
		    for(var cnt=0; cnt<list.length; cnt++) {
		    	var word = list[cnt][0];
		    	var weight = list[cnt][1];
		    	var col = getColor(word, weight, cnt);
		    	
		    	var fontSize = weight * 10;
		    	all = all + "<a href='javascript:' onclick='return clickEntry(words.list[" + cnt + "], null);' class='list' style='color: " + col + "; font-size:" + fontSize + "px';>" + word + "</a></br>";
		    	
		    }   
		    
		    $('#mobile-display').html(all);         
            	
            
            //Desktop version included on the same screen
	            var cloudOpts = { 
	              list: words.list,
	              gridSize: Math.round(16 * $('#my_canvas').width() / 1024),
	              weightFactor: function (size) {
	                return Math.pow(size, 2.3) * $('#my_canvas').width() / 1024;
	              },
	              fontFamily: '<?php echo $font_family ?>',
	              color: getColor,
	              rotateRatio: 0,
	              backgroundColor: '<?php echo $background_color ?>',
	              classes: 'comment-open',
	              click: clickEntry,
	              hover: function(word) {
	              },
	              shuffle: false
	              
	            }
	                                
	            WordCloud(document.getElementById('my_canvas'), cloudOpts);
           
        }
       

       
        
    </script>
    
  
</body>

</html>
