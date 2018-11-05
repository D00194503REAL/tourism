

<!DOCTYPE html>


<!DOCTYPE html>
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
    <title>Add Members</title>
    <link rel="icon" href="logo.jpg">
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
                        <a href="index.php" id="divSiteTitle">Tourism In Ireland</a><br />
                        <a href="index.php" id="divTagLine">Marketing the island of Ireland overseas</a>
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
                                    <a href="index.php" class="dropdown-toggle">Home </a>
                                    
                                </li>								
								<li class="dropdown">
                                    <a href="map.php" class="dropdown-toggle">Map </a>
                                    
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
                <a href="index.php">Home</a> &nbsp;/&nbsp; <a href="admin.php">Admin Panel</a> &nbsp;/&nbsp; <a href="viewMembers.php">Members</a> &nbsp;/&nbsp; <a href="viewMembers.php">Update Member Form</a> &nbsp;/&nbsp; <span>Add Member</span>
            </div>
            
            
            
            
            
            
            
            
            
            
            
            <div class="main">
                <?php
// Create local variables to store the form (POST) variables

                include 'database.php';

                $first_name = $_POST["first_name"];
                $last_name = $_POST["last_name"];
                $email = $_POST["email"];
                $password = (password_hash($_POST['password'], PASSWORD_BCRYPT));
                $hash = ( md5( rand(0,1000) ) );
                $active = 1;
                $admin = 0;
                

                try {
                    $db = DB();

                    $query = $db->prepare("INSERT INTO users(first_name, last_name, email, password, hash, active, admin) values(:first_name, :last_name, :email, :password, :hash, :active, :admin)");

                    $query->bindParam(":first_name", $first_name, PDO::PARAM_STR);
                    $query->bindParam(":last_name", $last_name, PDO::PARAM_STR);
                    $query->bindParam(":email", $email, PDO::PARAM_STR);
                    $query->bindParam(":password", $password, PDO::PARAM_STR);
                    $query->bindParam(":hash", $hash, PDO::PARAM_STR);
                    $query->bindParam(":active", $active, PDO::PARAM_STR);
                    $query->bindParam(":admin", $admin, PDO::PARAM_STR);
                    
                    $query->execute();

                    echo '<h1>You have registered.</h1><a href="viewMembers.php">View Members</a>';
                } catch (PDOException $e) {
                    echo $e->getMessage();
                    exit($e->getMessage());
                }
                ?>
                <hr>
                <hr>
            </div>
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


