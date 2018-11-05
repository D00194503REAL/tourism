<?php
/* Displays user information and some useful messages */
session_start();

// Check if user is logged in using the session variable
if ( $_SESSION['logged_in'] != 1 ) {
  $_SESSION['message'] = "You must log in before viewing your profile page!";
  header("location: error.php");    
}
else {
    // Makes it easier to read
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $email = $_SESSION['email'];
    $active = $_SESSION['active'];
    $admin = $_SESSION['admin'];
}
?>

<!DOCTYPE HTML>
<html>
    <style>
        .name_lastname
        {
            float: right;
            padding: 10px;
        }
        .button2
        {
            background-color: rgb(104, 152, 204);
        }
    </style>
<head>
    <meta charset="utf-8">
    <title>Contact Us</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Html5TemplatesDreamweaver.com">
    
    <link href="scripts/bootstrap/css/newcss.css" rel="stylesheet" type="text/css"/>
<!--    <link href="scripts/bootstrap/css/bootstrap.min.css" rel="stylesheet">-->
    <link href="scripts/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Icons -->
    <link href="scripts/icons/general/stylesheets/general_foundicons.css" media="screen" rel="stylesheet" type="text/css" />  
    <link href="scripts/icons/social/stylesheets/social_foundicons.css" media="screen" rel="stylesheet" type="text/css" />
    <!--[if lt IE 8]>
        <link href="scripts/icons/general/stylesheets/general_foundicons_ie7.css" media="screen" rel="stylesheet" type="text/css" />
        <link href="scripts/icons/social/stylesheets/social_foundicons_ie7.css" media="screen" rel="stylesheet" type="text/css" />
    <![endif]-->
    <link rel="stylesheet" href="scripts/fontawesome/css/font-awesome.min.css">
    <!--[if IE 7]>
        <link rel="stylesheet" href="scripts/fontawesome/css/font-awesome-ie7.min.css">
    <![endif]-->

    <link href="http://fonts.googleapis.com/css?family=Syncopate" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Abel" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Maven+Pro" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Oxygen" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">

    <link href="styles/custom.css" rel="stylesheet" type="text/css" />	
		
	<!-- Contact Form -->	
	<script src="email/validation.js" type="text/javascript"></script>
</head>
<body id="pageBody">
    
<div id="divBoxed" class="container">
    
    
    
    
    
    
    
   <?php if ( $active ){?>
              
    <div class="name_lastname">
        <?php echo $first_name." ". $last_name." || ". $email." || "; ?>
        <a href="logout.php"><button class="button2" name="logout"/>Log Out</button></a>
        
    </div>
    
         <?php }
          ?>
    
    
    

    <div class="transparent-bg" style="position: absolute;top: 0;left: 0;width: 100%;height: 100%;z-index: -1;zoom: 1;"></div>

    <div class="divPanel notop nobottom">
            <div class="row-fluid">
                <div class="span12">					

                    <!--Edit Site Name and Slogan here-->
					<div id="divLogo">
                        <a href="index.html" id="divSiteTitle">Your Name</a><br />
                        <a href="index.html" id="divTagLine">Your Tag Line Here</a>
                    </div>

	            </div>
            </div>   
            <div class="row-fluid">
                <div class="span12">				
                    <div class="centered_menu">                      
                    <!--Edit Navigation Menu here-->
					<div class="navbar">
                        <button type="button" class="btn btn-navbar-highlight btn-large btn-primary" data-toggle="collapse" data-target=".nav-collapse">
                            NAVIGATION <span class="icon-chevron-down icon-white"></span>
                        </button>
                        <div class="nav-collapse collapse">
                            <ul class="nav nav-pills ddmenu">
                                <li class="dropdown">
                                    <a href="index.html" class="dropdown-toggle">Home <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li class="dropdown">
                                            <a href="index-alt.html" class="dropdown-toggle">Home 2</a>                                            
                                        </li>                                        
                                    </ul>
                                </li>								
								<li class="dropdown">
                                    <a href="about.html" class="dropdown-toggle">About <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li class="dropdown">
                                            <a href="about-alt.html" class="dropdown-toggle">About 2</a>                                            
                                        </li>                                        
                                    </ul>
                                </li>
								<li><a href="services.html">Services</a></li>
                                <li class="dropdown">
                                    <a href="page.html" class="dropdown-toggle">Pages <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle">Dropdown Item &nbsp;&raquo;</a>
                                            <ul class="dropdown-menu sub-menu">
                                                <li><a href="#">Dropdown Item</a></li>
                                                <li><a href="#">Dropdown Item</a></li>
                                                <li><a href="#">Dropdown Item</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="wide.html">Full Page</a></li>
                                        <li><a href="2-column.html">2 Column</a></li>
                                        <li><a href="3-column.html">3 Column</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="gallery.html" class="dropdown-toggle">Gallery <b class="caret"></b></a>
                                    <ul class="dropdown-menu">                                        
                                        <li><a href="3-portfolio.html">3 Portfolio</a></li>
                                        <li><a href="portfolio-item.html">Portfolio Item</a></li>
                                        <li><a href="video-page.html">Video Page</a></li>
                                    </ul>
                                </li>
                                <?php
          
          // Keep reminding the user this account is not active, until they activate
          if ( !$active ){?>
              <li class="dropdown-toggle"><a href="contact.php">Profile</a></li>
         <?php }
          else
          {?>
              <li class="dropdown-toggle"><a href="profile.php">Profile</a></li>
         <?php }
          ?>
            <?php  if ( $admin ){?>
              <li class="active"><a href="admin.php">Admin Panel</a></li>
         <?php }
          ?>
                                
                            </ul>
                        </div>
                    </div>                     
                    </div>
	            </div>
            </div>

            <div class="row-fluid">
                <div class="span12">
                    <div id="contentInnerSeparator"></div>
                </div>
            </div>
    </div>

    <div class="contentArea">

        <div class="divPanel notop page-content">

            <div class="breadcrumbs">
                <a href="index.html">Home</a> &nbsp;/&nbsp; <span>Admin Panel</span>
            </div>
            
            
            
            
            
            
            
            
            
            
            
            
            


            
            
            
            
            
            










  <!--Edit Footer here-->
			<div id="footerInnerSeparator"></div>
        </div>
    </div>

    <div id="footerOuterSeparator"></div>

    <div id="divFooter" class="footerArea shadow">

        <div class="divPanel">

            <div class="row-fluid">
                <div class="span3" id="footerArea1">
                
                    <h3>About Company</h3>

                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s.</p>
                    
                    <p> 
                        <a href="#" title="Terms of Use">Terms of Use</a><br />
                        <a href="#" title="Privacy Policy">Privacy Policy</a><br />
                        <a href="#" title="FAQ">FAQ</a><br />
                        <a href="#" title="Sitemap">Sitemap</a>
                    </p>

                </div>
                <div class="span3" id="footerArea2">

                    <h3>Recent Blog Posts</h3> 
                    <p>
                        <a href="#" title="">Lorem Ipsum is simply dummy text</a><br />
                        <span style="text-transform:none;">2 hours ago</span>
                    </p>
                    <p>
                        <a href="#" title="">Duis mollis, est non commodo luctus</a><br />
                        <span style="text-transform:none;">5 hours ago</span>
                    </p>
                    <p>
                        <a href="#" title="">Maecenas sed diam eget risus varius</a><br />
                        <span style="text-transform:none;">19 hours ago</span>
                    </p>
                    <p>
                        <a href="#" title="">VIEW ALL POSTS</a>
                    </p>

                </div>
                <div class="span3" id="footerArea3">

                    <h3>Sample Content</h3> 
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s. 
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s.
                    </p>

                </div>
                <div class="span3" id="footerArea4">

                    <h3>Get in Touch</h3>  
                                                               
                    <ul id="contact-info">
                    <li>                                    
                        <i class="general foundicon-phone icon"></i>
                        <span class="field">Phone:</span>
                        <br />
                        (123) 456 7890 / 456 7891                                                                      
                    </li>
                    <li>
                        <i class="general foundicon-mail icon"></i>
                        <span class="field">Email:</span>
                        <br />
                        <a href="mailto:info@yourdomain.com" title="Email">info@yourdomain.com</a>
                    </li>
                    <li>
                        <i class="general foundicon-home icon" style="margin-bottom:50px"></i>
                        <span class="field">Address:</span>
                        <br />
                        123 Street<br />
                        12345 City, State<br />
                        Country
                    </li>
                    </ul>

                </div>
            </div>

            <br /><br />
             <div class="row-fluid">
            <div class="span12">
            <p class="copyright"> 
            Copyright © 2014 Your Company. All Rights Reserved.
            </p>

            <div class="social_bookmarks">                    
                <a href="#"><div class="icon_twitter"></div></a>
                <a href="#"><div class="icon_facebook"></div></a>
                <a href="#"><div class="icon_google"></div></a>
                <a href="#"><div class="icon_pinterest"></div></a>                   
            </div>
            </div>
            </div>

        </div>
    </div>
</div>
<br /><br /><br />

<script src="scripts/jquery.min.js" type="text/javascript"></script> 
<script src="scripts/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="scripts/default.js" type="text/javascript"></script>

</body>
</html>
