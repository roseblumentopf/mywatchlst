<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en">
    <!--<![endif]-->
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <!--[if IE]>
            <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
            <![endif]-->
        <title>Multipager Template- Travelic </title>
        <!--REQUIRED STYLE SHEETS-->
        <!-- BOOTSTRAP CORE STYLE CSS -->
        <link href="style/bootstrap.css" rel="stylesheet" />
        <!-- FONTAWESOME STYLE CSS -->
        <link href="style/font-awesome.min.css" rel="stylesheet" />
        <!--ANIMATED FONTAWESOME STYLE CSS -->
        <link href="style/font-awesome-animation.css" rel="stylesheet" />
        <!--PRETTYPHOTO MAIN STYLE -->
        <link href="style/prettyPhoto.css" rel="stylesheet" />
        <!-- CUSTOM STYLE CSS -->
        <link href="style/style_new.css" rel="stylesheet" />
        <!-- GOOGLE FONT -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <style type="text/css">
            #home-sec {
                background: url(images/5.jpg) no-repeat 50% 50%;
                background-attachment: fixed;
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
                width: 100%;
                display: block;
                height: auto;
                padding-top:190px;
                min-height:650px;
                color:#fff;
            }
        </style>

        <link href="style/style.css" type="text/css" rel="stylesheet"> 
        <script src="script/main.js" type="text/javascript"></script>
        <script src="script/typeahead.min.js" type="text/javascript"></script>

    </head>
    <body>
        <?php include_once("php_includes/check_login_status.php"); ?>
        <!-- NAV SECTION -->
        <div class="navbar navbar-inverse navbar-fixed-top">

            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">RemindME</a>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <?php if ($user_ok === false) { ?>
                            <li><a href="#" data-toggle="modal" data-target="#register">Create Account</a></li>
                            <li><a href="#" data-toggle="modal" data-target="#login">Login</a></li>
                        <?php } else { ?>    
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Menu<span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="settings.php">Settings</a></li>
                                    <li><a href="tasks.php">Tasks</a></li>
                                    <li class="divider"></li>
                                    <li><a href="logout.php">Logout</a></li>
                                </ul>
                            </li>                      
                        <?php } ?>
                    </ul>
                </div>
                <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabelLogin" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabelLogin">Login</h4>
                            </div>
                            <div class="modal-body">
                                <form id="loginform" onsubmit="return false;">
                                    <div>Email:</div>
                                    <input type="text" id="email1" onfocus="emptyElement('status')" maxlength="88">
                                    <div>Password:</div>
                                    <input type="password" id="password" onfocus="emptyElement('status')" maxlength="100">
                                    <br /><br />                                   
                                    <p id="status1"></p>
                                    <a href="pass.php">Forgot Your Password?</a>
                                    <!--a href="loginTwitter.php">
                                    <img src="images/sign-in-with-twitter-link.png" alt="logo" title="Sign in with Twitter">
                                    </a-->
                                </form>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="btnlogin" onclick="login()">Send</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--END NAV SECTION -->

        <!--HOME SECTION-->
        <div id="home-sec">


            <!--div class="container"  >
                <div class="row text-center">
                    <div  class="col-md-12" >
                        <span class="head-main" >Travel Template</span>
                        <h3 class="head-last col-md-4 col-md-offset-4  col-sm-6 col-sm-offset-3">Lorem ipsum dolor sit ametLorem</h3>


                    </div>
                </div>
            </div-->
        </div>


        <section  id="services-sec">
            <div class="container">
                <div class="row ">
                    <div class="text-center g-pad-bottom">
                        <div class="col-md-4 col-sm-4 alert-info">
                            <h4>Free To Use </h4>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Curabitur nec nisl odio. Mauris vehicula at nunc id posuere.
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            </p>

                        </div>
                        <div class="col-md-4 col-sm-4 alert-success">
                            <h4>100%  Responsive </h4>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Curabitur nec nisl odio. Mauris vehicula at nunc id posuere.
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            </p>

                        </div>

                        <div class="col-md-4 col-sm-4 alert-danger">
                            <h4> Customizable </h4>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Curabitur nec nisl odio. Mauris vehicula at nunc id posuere.
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            </p>

                        </div>
                    </div>
                </div>
                <div class="row go-marg">

                    <div class="col-md-4 col-sm-4">
                        <div class="panel panel-default">

                            <div class="panel-body">
                                <h4 class="adjst">Tour Package One #1 </h4>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                    Curabitur nec nisl odio. Mauris vehicula at nunc id posuere.
                                </p>


                            </div>
                        </div> 

                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="panel panel-default">

                            <div class="panel-body">
                                <h4 class="adjst">Tour Package Two #2 </h4>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                    Curabitur nec nisl odio. Mauris vehicula at nunc id posuere.
                                </p>


                            </div>
                        </div> 

                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="panel panel-default">

                            <div class="panel-body">
                                <h4 class="adjst">Tour Package Three #3 </h4>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                    Curabitur nec nisl odio. Mauris vehicula at nunc id posuere.
                                </p>


                            </div>
                        </div> 

                    </div>
                </div>

            </div>
        </section>
        <!--END HOME SECTION-->





        <!--FOOTER SECTION -->
        <div id="footer">
            2014 www.yourdomain.com | All Right Reserved  

        </div>
        <!-- END FOOTER SECTION -->

        <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
        <!-- CORE JQUERY  -->
        <script src="plugins/jquery-1.10.2.js"></script>
        <!-- BOOTSTRAP CORE SCRIPT   -->
        <script src="plugins/bootstrap.min.js"></script>  
        <!-- ISOTOPE SCRIPT   -->
        <!--script src="plugins/jquery.isotope.min.js"></script-->
        <!-- PRETTY PHOTO SCRIPT   -->
        <script src="plugins/jquery.prettyPhoto.js"></script>    
        <!-- CUSTOM SCRIPTS -->
        <script src="script/custom.js"></script>

    </body>
</html>


