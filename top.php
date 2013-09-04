<?php require("config.php");?>

<html>
  <head>
      <title>Lets Blog</title>
      <link href="css/tl.css" rel="stylesheet" type="text/css" title="main" />
  		
      <!--[if lt IE 7]>
  			<link href="ie6fix.css" rel="stylesheet" type="text/css" title="ie6"/>
  		<![endif]-->
  		<!--[if gt IE 6]>
  			<link href="ie7fix.css" rel="stylesheet" type="text/css" title="ie7"/>
  		<![endif]-->
      
      <script type="text/javascript" src="functions.js"></script>
      
  </head>
 
  <body>
  		<div id="header_top_bg"></div>
      <div id="container">
      		
          <div id="header">
              <div class="left">
                  <span class="lets_blog"><a href= "/">Lets Blog</a></span>                  
              </div>
              <div class="header_right right">
              	<?php if (isset($_SESSION["user_id"])){?> 
              	<h3>Welcome <?php echo $_SESSION["first_name"]?>!</h3>  
              	<?php }?>
              </div>             
          </div>
          <div id="topNav">    
          <?php if (isset($_SESSION["user_id"])){?>          
         	  <ul class="leftmenu">
                 <!-- <li><a href="index.php">Home</a></li>
                  <li><a href="product.php">Product</a></li>                  
                  <li><a href="customer_service.php">Customer Service</a></li>
                  <li><a href="customer_registration.php">Customer Registration</a></li>
                  <li><a href="about_us.php">About Travel Lane</a></li>
                  <li><a href="contact_us.php">Contact Us</a></li>
                  -->
              </ul>
              
              <ul class="right">
                  <li class="login"><a href="logout.php">Logout</a></li>
              </ul>
         <?php } ?>	
          </div>
          <div id="topNav_bottom"></div>
          
          <div id="centre">
              