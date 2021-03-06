<?php 
/* Main page with two forms: sign up and log in */
require 'db.php';
session_start();
?>

<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    if (isset($_POST['login'])) { //user logging in

        require 'login.php';
        
    }
    
    elseif (isset($_POST['register'])) { //user registering
        
        require 'register.php';
        
    }
}


// Check if user is logged in using the session variable
if ( $_SESSION['logged_in'] != 1 ) {
  $_SESSION['message'] = "You must log in before viewing your profile page!";
  header("location: index.html");    
}
else {
    // Makes it easier to read
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $email = $_SESSION['email'];
    $active = $_SESSION['active'];
    $admin = $_SESSION['admin'];
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
    <title>Tourist Information</title>
    <link rel="icon" href="logo.jpg">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Html5TemplatesDreamweaver.com">

    <link href="scripts/bootstrap/css/bootstrap.min.css" rel="stylesheet">
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

    <link href="scripts/carousel/style.css" rel="stylesheet" type="text/css" /><link href="scripts/camera/css/camera.css" rel="stylesheet" type="text/css" />
	<link href="scripts/wookmark/css/style.css" rel="stylesheet" type="text/css" />	<link href="scripts/yoxview/yoxview.css" rel="stylesheet" type="text/css" />

    <link href="http://fonts.googleapis.com/css?family=Syncopate" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Abel" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Maven+Pro" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Oxygen" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">

    <link href="styles/custom.css" rel="stylesheet" type="text/css" />	
	
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
                                <li class="dropdown active">
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
              <li class="dropdown-toggle"><a href="admin.php">Admin Panel</a></li>
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

                <div id="headerSeparator"></div>
                <!--Edit Camera Slider here-->
                <div class="camera_full_width">
                    <div id="camera_wrap" class="shadow">
                        <div data-src="slider-images/image2.jpg" >
						<div class="camera_caption fadeFromBottom cap1">Tourism in Ireland</div>
						</div>
						<div data-src="slider-images/image3.jpg" >						
						</div>
						<div data-src="slider-images/image4.jpg" >						
						</div>
                    </div>
                    <br style="clear:both"/><div style="margin-bottom:40px"></div>
                </div>
				<!--End Camera Slider here-->
<hr>
                <div id="divHeaderText" class="page-content">
                    <div id="divHeaderLine1">Popular Places</div>
					</br>
                    <div id="divHeaderLine2">Top Popular Places that our customers prefer.</div><br />                    
                </div>
				

                <div id="headerSeparator2"></div>						
				
            </div>
        </div>
    </div>

    <div class="contentArea">

        <div class="divPanel notop page-content"> 
         
            <div class="row-fluid">
                <div class="span12" id="divMain">
                <!--Edit Main Content here-->
                    <div class="row-fluid">

	</div>
	
	        <!--Edit Latest Content Area here-->			
            <div class="row-fluid">
                <div class="span12">	
			
              <div class="yoxview">
              <div class="row-fluid">
            
              <div class="span4 box">
                
                  <a href="images/CliffsofMoher.jpg"><img src="images/CliffsofMoher.jpg"  class="img-polaroid" alt="Thumbnail Placeholder" title="Thumbnail Placeholder" /></a>
                <h4 class="title">Cliffs of Moher</h4> 
				<p>
                                    Ireland’s mighty Cliffs of Moher reign strong as one of the country’s most visited natural attractions - towering 214 meters over the Atlantic Ocean in western Ireland. The iconic cliffs run from near the village of Doolin for around 8km to Hags Head in County Clare and host the country’s most spectacular coastal walk. Carved out by a gigantic river delta around 320 million years ago, the imposing cliffs also offer incredible views, stretching over Galway Bay, the distant Twelve Pins mountain range and the northern Maum Turk Mountains
                                </p>
                                </br>
                                </br>
                                <a href="#" class="btn btn-large btn-primary btn-right">MORE INFO</a>
              </div>
              
			  <div class="span4 box">
                              
                  <a href="images/Skelligs.jpg"><img src="images/Skelligs.jpg" class="img-polaroid" alt="Thumbnail Placeholder" title="Thumbnail Placeholder" /></a>
                <h4 class="title">Skellig Islands</h4> 
				<p>
                                    Ireland’s magnificent UNESCO World Heritage Skellig Islands make a worthy side trip from the popular Ring of Kerry tourist trail, a pair of small rocky mounds that rise up from the sea off the coast of Portmagee. Not only are the two islands - Skellig Michael and Little Skellig - home to a fascinating 6th-century monastic complex perched on the 230-meter high cliff top, but they also host an impressive array of birdlife. Look out for Gannets, Black Guillemots, Cormorants, Razorbills and Herring Gulls as you climb the hair-raisingly steep 600-step climb to view the monastic remains.
                                </p>
                                
                                <a href="#" class="btn btn-large btn-primary btn-right">MORE INFO</a>
              </div>
			  
			  <div class="span4 box">
                
                  <a href="images/GiantsCauseway.jpg"><img src="images/GiantsCauseway.jpg" class="img-polaroid" alt="Thumbnail Placeholder" title="Thumbnail Placeholder" /></a>
			<h4 class="title">The Giant’s Causeway</h4> 
				<p>
                                    Northern Ireland’s only UNESCO World Heritage-listed site, the Giant’s Causeway is proof that Mother Nature provides the most dramatic tourist attractions. The natural wonder is comprised of around 40,000 polygonal basalt rock columns, formed by the ancient volcanic landscape and stretching along the coastline like a series of gigantic stepping stones. A Giants Causeway Day Trip from Belfast is one of the country’s most popular excursions, with visitors taking the unique opportunity to walk one of nature’s most peculiar pathways.
                                </p>  
                                </br>
                                
                                <a href="#" class="btn btn-large btn-primary btn-right">MORE INFO</a>
              </div>		  
                          
          </div>          

                </div>
				</div>
                
            </div>			
            
			<!-- promo-box -->			
			<div class="row-fluid">
			    
                <div class="span12">			
                <div class="shout-box">
                    <div class="row-fluid">
            
                    <div class="span9">
                       
                    <h2>I love deadlines. I like the whooshing sound they make as they fly by.</h2>
					<p><em>If you’re a procrastinator like Douglas Adams, this quote probably made you laugh.</em></p>               
                    </div>
              
			        <div class="span3">
                    <a href="#" class="btn btn-large btn-primary btn-right">CONTACT US TODAY</a>                
                    </div>			  		  
                          
                    </div>          

                    </div>
				</div>                
            </div>						
					
					<hr>
					<p><img src="image4.jpg" class="img-polaroid pull-left" style="margin:5px 19px 10px 0px;" alt="" />Websites created by destination marketing organizations are some of the more underused resources in travel today.

Our recent analysis of the 50 most visited U.S. tourism websites found that no site had more than 570,000 visitors in October. And the most time spent on a site was five minutes, which was far longer than the average.

However, these sites are packed with logistical information like how to use public transit to get from an airport to city center, tourism resources like the opening hours to a city’s most famous museum, and beautiful imagery.</p>
					
					<p>Toffee cotton candy lollipop. Dessert marshmallow icing chocolate bar gummies croissant gummi bears tart. Candy tiramisu bonbon donut. Marzipan gummies dragée candy. Jelly-o toffee chocolate cake toffee pastry. Cupcake jelly croissant soufflé jelly-o. Chocolate bar sesame snaps fruitcake dessert topping cupcake. Topping danish applicake. Macaroon cake tiramisu. Tart pie jelly-o brownie chocolate fruitcake gummi bears. Sugar plum powder dragée oat cake. Applicake sweet cake.</p>
					
					<p>Powder danish sugar plum pie cake. Dragée cotton candy toffee danish topping chocolate bar topping. Lemon drops biscuit muffin topping applicake chocolate cake cake lollipop. Donut cupcake chocolate bar sesame snaps topping. Jelly-o dessert applicake applicake danish unerdwear.com. Pudding sugar plum cheesecake chupa chups. Pudding liquorice jelly-o. Icing ice cream chocolate liquorice marzipan. Sesame snaps icing ice cream cake cupcake jelly-o chocolate bar bonbon chocolate bar. Danish candy canes jelly caramels candy canes powder chocolate sugar plum. Carrot cake marshmallow powder powder lemon drops. Pastry dragée donut. Pudding fruitcake oat cake. Donut halvah chocolate bar.</p>
                
				</div>

            </div>
            <!--End Main Content Area here-->
			
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

<script src="scripts/carousel/jquery.carouFredSel-6.2.0-packed.js" type="text/javascript"></script><script type="text/javascript">$('#list_photos').carouFredSel({ responsive: true, width: '100%', scroll: 2, items: {width: 320,visible: {min: 2, max: 6}} });</script><script src="scripts/camera/scripts/camera.min.js" type="text/javascript"></script>
<script src="scripts/easing/jquery.easing.1.3.js" type="text/javascript"></script>
<script type="text/javascript">function startCamera() {$('#camera_wrap').camera({ fx: 'simpleFade, mosaicSpiralReverse', time: 2000, loader: 'none', playPause: false, navigation: true, height: '38%', pagination: true });}$(function(){startCamera()});</script>

<script src="scripts/wookmark/js/jquery.wookmark.js" type="text/javascript"></script>
<script type="text/javascript">$(window).load(function () {var options = {autoResize: true,container: $('#gridArea'),offset: 10};var handler = $('#tiles li');handler.wookmark(options);$('#tiles li').each(function () { var imgm = 0; if($(this).find('img').length>0)imgm=parseInt($(this).find('img').not('p img').css('margin-bottom')); var newHeight = $(this).find('img').height() + imgm + $(this).find('div').height() + $(this).find('h4').height() + $(this).find('p').not('blockquote p').height() + $(this).find('iframe').height() + $(this).find('blockquote').height() + 5;if($(this).find('iframe').height()) newHeight = newHeight+15;$(this).css('height', newHeight + 'px');});handler.wookmark(options);handler.wookmark(options);});</script>
<script src="scripts/yoxview/yox.js" type="text/javascript"></script>
<script src="scripts/yoxview/jquery.yoxview-2.21.js" type="text/javascript"></script>
<script type="text/javascript">$(document).ready(function () {$('.yoxview').yoxview({autoHideInfo:false,renderInfoPin:false,backgroundColor:'#ffffff',backgroundOpacity:0.8,infoBackColor:'#000000',infoBackOpacity:1});$('.yoxview a img').hover(function(){$(this).animate({opacity:0.7},300)},function(){$(this).animate({opacity:1},300)});});</script>

</body>
</html>
<?php
}
?>

