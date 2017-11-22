<?php
session_start();

//case user not login yet
if (!isset($_SESSION['current_login_status'])){
    header('Location: logout.php');
}
//case user type isn't Customer
if (isset($_SESSION['current_type'])){
    if ($_SESSION['current_type']!="Customer"){
        header('Location: logout.php');
    }
}else{
    header('Location: logout.php');
}

//Only Customer type can go through this zone

/*echo "<br>".$_SESSION['current_login_status'];
echo "<br>".$_SESSION['current_id'];
echo "<br>".$_SESSION['current_fname'];
echo "<br>".$_SESSION['current_lname'];
echo "<br>".$_SESSION['current_name'];
echo "<br>".$_SESSION['current_email'];
echo "<br>".$_SESSION['current_password'];
echo "<br>".$_SESSION['current_type'];

echo "<br><a href='logout.php'>Logout</a>";*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ninodezign.com, ninodezign@gmail.com">
    <meta name="copyright" content="ninodezign.com">
    <title>Eve | Event booking</title>
    <!-- favicon -->
    <link rel="shortcut icon" href="images/poster/v-icon.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
    <!-- css -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="css/materialdesignicons.min.css" />
    <link rel="stylesheet" type="text/css" href="css/jquery.mCustomScrollbar.min.css" />
    <link rel="stylesheet" type="text/css" href="css/prettyPhoto.css" />
    <link rel="stylesheet" type="text/css" href="css/unslider.css" />
    <link rel="stylesheet" type="text/css" href="css/template.css" />
</head>

<body data-target="#nino-navbar" data-spy="scroll">
<!--facebook embed section-->
<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v2.10";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
<!--end facebook embed section-->

<!-- Header
    ================================================== -->
<header id="nino-header2">
    <div id="nino-header2Inner">
        <nav id="nino-navbar" class="navbar navbar-default" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nino-navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="homepage.html">Eve</a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="nino-menuItem pull-right">
                    <div class="collapse navbar-collapse pull-left" id="nino-navbar-collapse">
                        <ul class="nav navbar-nav1">
                            <a href="index_login.html">Home </a>
                            <a href="login.php">Log Out</a>
                            <!-- <li><a href="#nino-services">Service</a></li>
                            <li><a href="#nino-ourTeam">Our Team</a></li>
                            <li><a href="#nino-portfolio">Work</a></li>
                            <li><a href="#nino-latestBlog">Blog</a></li> -->
                        </ul>
                    </div><!-- /.navbar-collapse -->
                    <ul class="nino-iconsGroup nav navbar-nav">
                        <!-- <li> --><a href="usermain.php?email=sirichai.khomleart%40gmail.com&password=dragon&signup_submit=LOG+IN"><i class="mdi mdi-cart-outline nino-icon"></i></a><!-- </li> -->
                        <!-- <a href="#" class="nino-search"><i class="mdi mdi-magnify nino-icon"></i></a> -->
                    </ul>
                </div>
            </div><!-- /.container-fluid -->
        </nav>
    </div>
</header><!--/#header-->



<!-- name
================================================== -->
<section id="nino-services">
    <div class="container">
        <h2 class="nino-sectionHeading">
            <span class="nino-subHeading">Welcome Back!</span>
            <?php echo $_SESSION['current_name'];?>

            <?php if($_SESSION['current_customer_status']==0){
                echo    "<br><br><br><br> <font color='#dc143c'> This account already deactivated.</font><br>";
                echo "<br><br>";
                echo "<button class=\"btn btn-success\" type=\"submit\" id='activate'>ACTIVATE AGAIN</button>";
            } ?>
        </h2>

    </div>
</section><!--/#nino-name-->

<?php if($_SESSION['current_customer_status']==1){ ?>
    <!-- Your ticket
    ================================================== -->
    <section id="nino-latestBlog">
        <div class="container">
            <h2 class="nino-sectionHeading">
                <span class="nino-subHeading">Ready to go?</span>
                Your Ticket is Here.
            </h2>
            <div class="sectionContent">
                <div class="row">

                    <!--loop check event from file-->
                    <?php
                    $efile = file_get_contents("userevent.txt"); // Returns a string
                    $eresult = explode("\r\n",$efile);
                    //                var_dump($eresult);
                    for($i=0; $i< count($eresult); $i++)
                    {
                        $edetail=$eresult[$i];
                        $edetailsplit = explode("&&&",$edetail);
//                    echo "<br><br>";
//                    var_dump($edetailsplit);
                        $eimgscr=$edetailsplit[0];
                        $edate=$edetailsplit[1];
                        $emonth=$edetailsplit[2];
                        $etitle=$edetailsplit[3];
                        $edesc=$edetailsplit[4];
                        ?>
                        <div class="col-md-4 col-sm-4">
                            <article>
                                <div class="articleThumb">
                                    <a href="detail_login.php"><img src=<?php echo $eimgscr; ?> alt=""></a>
                                    <div class="date">
                                        <span class="number"><?php echo $edate; ?></span>
                                        <span class="text"><?php echo $emonth; ?></span>
                                    </div>
                                </div>
                                <h3 class="articleTitle"><a href="detail_login.php"><?php echo $etitle; ?></a></h3>
                                <p class="articleDesc">
                                    <?php echo $edesc; ?>
                                </p>
                                <div class="articleMeta">
                                    <a href="detail_login.php"><i class="mdi mdi-eye nino-icon"></i> 1264</a>
                                    <a href="detail_login.php"><i class="mdi mdi-comment-multiple-outline nino-icon"></i> 69</a>
                                </div>
                            </article>
                        </div>

                        <?php

                    }
                    ?>


                </div>
            </div>
        </div>
    </section><!--/#nino-yourHistory-->




              <!-- Search for next event
              ================================================== -->
    <section id="nino-story">
        <div class="container">
            <h1 class="nino-sectionHeading">
                <span class="nino-subHeading">Finding your inspiration?</span>
                Search For Next Event
            </h1>
            <br>
            <form action="search_login.php">
                <div class="box2">
                    <div >
                        <input name="keyword" type="text" class="form-control"  placeholder="Name, Location, or somethings that you interest" required>
                        <br><br>
                        <span><button class="btn btn-success" type="submit">Search</button></span>
                    </div>

            </form>

            <br><br>
            <p class="nino-sectionDesc-custom">Not sure what to find? Don't worry! - Check out some "tag" that we only prepared for you here. </p>
        </div>
        <div class="sectionContent">
            <div class="row nino-hoverEffect">
                <div class="col-md-4 col-sm-4">
                    <div class="item">
                        <a class="overlay" href="search_login.php?keyword=yourself">
								<span class="content">
									<i class="mdi mdi-account-multiple nino-icon"></i>
									#FindingYourself
								</span>
                            <img src="images/user/1.jpg" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="item">
                        <a class="overlay" href="search_login.php?keyword=developer">
								<span class="content">
									<i class="mdi mdi-airplay nino-icon"></i>
									#Deverloper
								</span>
                            <img src="images/user/2.jpg" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="item">
                        <a class="overlay" href="search_login.php?keyword=photography">
								<span class="content">
									<i class="mdi mdi-image-filter-center-focus-weak nino-icon"></i>
									#Photography
								</span>
                            <img src="images/user/3.jpg" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section><!--/#nino-search-->

<?php } ?>



<!-- Footer
================================================== -->
<footer id="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="colInfo">
                    <div class="footerLogo">
                        <a href="#" >EVE</a>
                    </div>
                    <p>
                        We believed that everyone should has a chance to find their own inspiration. So, we create a single place that bring creators and people come together in the purpose of linking their creativity.
                        Our vision is to envision a world where all people – even in the most remote areas of the globe – hold the power to create opportunity for themselves and others.
                        <br><br>"All our dreams can come true if we have the courage to pursue them."
                        <br><br>     - From us, EVE.
                    </p>
                    <div class="nino-followUs">
                        <div class="totalFollow"><span>15k</span> followers</div>
                        <div class="socialNetwork">
                            <span class="text">Follow Us: </span>
                            <a href="" class="nino-icon"><i class="mdi mdi-facebook"></i></a>
                            <a href="" class="nino-icon"><i class="mdi mdi-twitter"></i></a>
                            <a href="" class="nino-icon"><i class="mdi mdi-instagram"></i></a>
                            <a href="" class="nino-icon"><i class="mdi mdi-pinterest"></i></a>
                            <a href="" class="nino-icon"><i class="mdi mdi-google-plus"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="colInfo">
                    <h3 class="nino-colHeading">Find us on Facebook</h3>
                    <!--facebook-->
                    <div class="fb-page" data-href="https://www.facebook.com/siittu/" data-tabs="timeline" data-height="400" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/siittu/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/siittu/">Sirindhorn International Institute of Technology (SIIT)</a></blockquote></div>


                </div>
            </div>

            <div class="col-md-4 col-sm-6">
                <div class="colInfo">
                    <h3 class="nino-colHeading">Follow our instagram</h3>
                    <div class="instagramImages clearfix">
                        <a href="#"><img src="images/instagram/img-1.jpg" alt=""></a>
                        <a href="#"><img src="images/instagram/img-2.jpg" alt=""></a>
                        <a href="#"><img src="images/instagram/img-3.jpg" alt=""></a>
                        <a href="#"><img src="images/instagram/img-4.jpg" alt=""></a>
                        <a href="#"><img src="images/instagram/img-5.jpg" alt=""></a>
                        <a href="#"><img src="images/instagram/img-6.jpg" alt=""></a>
                        <a href="#"><img src="images/instagram/img-7.jpg" alt=""></a>
                        <a href="#"><img src="images/instagram/img-8.jpg" alt=""></a>
                        <a href="#"><img src="images/instagram/img-9.jpg" alt=""></a>
                        <a href="#"><img src="images/instagram/img-3.jpg" alt=""></a>
                        <a href="#"><img src="images/instagram/img-4.jpg" alt=""></a>
                        <a href="#"><img src="images/instagram/img-5.jpg" alt=""></a>
                    </div>
                    <a href="#" class="morePhoto">View more photos</a>
                </div>
            </div>
        </div>

    </div>
</footer><!--/#footer-->

<!-- Search Form - Display when click magnify icon in menu
================================================== -->
<form action="" id="nino-searchForm">
    <input type="text" placeholder="Search..." class="form-control nino-searchInput">
    <i class="mdi mdi-close nino-close"></i>
</form><!--/#nino-searchForm-->

<!-- Scroll to top
================================================== -->
<a href="#" id="nino-scrollToTop">Go to Top</a>

<!-- javascript -->
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/isotope.pkgd.min.js"></script>
<script type="text/javascript" src="js/jquery.prettyPhoto.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.hoverdir.js"></script>
<script type="text/javascript" src="js/modernizr.custom.97074.js"></script>
<script type="text/javascript" src="js/jquery.mCustomScrollbar.concat.min.js"></script>
<script type="text/javascript" src="js/unslider-min.js"></script>
<script type="text/javascript" src="js/template.js"></script>


</body>
</html>
