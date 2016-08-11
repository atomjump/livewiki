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
   
    <style>
    
        html, body {
            height:100%;
            margin:0;
            padding:0
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
        
        a {
        	font-family: '<?php echo $font_family ?>';
        	text-decoration: none;
        }
  
        
    
    </style>
    <!-- AtomJump Feedback Starts -->
   <!-- Bootstrap core CSS. Ver 3.3.1 sits in css/bootstrap.min.css -->
	  <link rel="StyleSheet" href="<?php echo $bootstrap_css_path ?>/bootstrap.min.css" rel="stylesheet">
	
	<!-- AtomJump Feedback CSS -->
	<link rel="StyleSheet" href="<?php echo $atomjump_path ?>/css/comments-0.1.css?ver=1">
	
	<!-- Bootstrap HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
	
	
	<script>
		//Add your configuration here for AtomJump Feedback
		var ajFeedback = {
			"uniqueFeedbackId" : "<?php echo $unique_key ?>home",		//This can be anything globally unique to your company/page	
			"myMachineUser" : "1.1.1.1:2",			/* Obtain this value from 1. Settings
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
        <div class="row" style="padding-top: 10px;">
            
            <div class="col-md-12">
                <div class="centering text-center">
             
                   
                   
                   
                   <span id="my-comments" class="comment-open" style="display: none;" href="javascript:">Click me for comments</span>
		            <!-- Any link on the page can have the 'comment-open' class added and a blank 'href="javascript:"' -->
		
		            
                   
					<div style="position: relative; width:100%; height: 768px; margin-left: auto; margin-right:auto">
						<div id="my_canvas" style="width:100%; height: 768px; "></div>
					</div>
                   
                    
                    
                   
                    
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
                    <div class="input-group">
                        
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
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>  <!-- end of form group -->

                  
                </form>
             </div>
          
           </div> <!-- end of col -->
           <div class="col-md-2"></div>
          
            
          
        </div> <!-- end of row -->
        
        <div class="row" style="padding-top: 10px;">
            
            <div class="col-md-12">
                <div class="centering text-center">
                    <div id="mobile-display" style="background-color: <?php echo $background_color ?>"></div>
                 </div>
            </div>
            
        </div> <!-- end of row -->
        
        
    </div>

    
    
 
   
     <script>
       
        var treeData;
        var words = {};

        var oReq = new XMLHttpRequest();
        oReq.onload = reqListener;
        oReq.open("get", "<?php echo $host ?>/data/words.json?cs=" + Math.random(), true);
        oReq.setRequestHeader("Cache-Control", "no-cache");
        oReq.send();

		function getColor(word, weight) {
			var col;
					if (weight === 10) {
						col = '#007dc5';
					} else {
						var char = Math.abs(parseInt((word.charCodeAt(0) - 97)/5)); // = 0-25 /5 = 0-5
					
						var colours = [ '#AAA', '#BBB', '#CCC', '#DDD', '#FFF' ];
						if(colours[char]) {
							col = colours[char];
						} else {
							col = '#FFF';
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
		    	var col = getColor(word, weight);
		    	
		    	var fontSize = Math.pow(weight, 2.4) * $('#mobile-display').width() / 1024;
		    	all = all + "<a href='javascript:' onclick='return clickEntry(words.list[" + cnt + "], null);' style='color: " + col + "; font-size:" + fontSize + "px'; text-decoration: none;>" + word + "</a></br>";
		    	
		    }   
		    alert(all);
		    
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
