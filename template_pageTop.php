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
        <base href="http://localhost/mywatchlst/" />
        <!--[if IE]>
            <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
            <![endif]-->
        <title>myWATCHLST</title>
        <!--REQUIRED STYLE SHEETS-->
        <!-- BOOTSTRAP CORE STYLE CSS -->
        <link href="assets/css/bootstrap.css" rel="stylesheet" />
        <!-- FONTAWESOME STYLE CSS -->
        <link href="assets/css/font-awesome.min.css" rel="stylesheet" />
        <!--ANIMATED FONTAWESOME STYLE CSS -->
        <link href="assets/css/font-awesome-animation.css" rel="stylesheet" />
        <!--PRETTYPHOTO MAIN STYLE -->
        <link href="assets/css/prettyPhoto.css" rel="stylesheet" />
        <!-- CUSTOM STYLE CSS -->
        <link href="assets/css/style.css" rel="stylesheet" />
        <!-- GOOGLE FONT -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

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
                    <a class="navbar-brand" href="index.php">myWATCHLST</a>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <!--li><a href="index.php">HOME</a></li-->
                        <?php if ($user_ok === FALSE) { ?>
                            <li><a href="login.php">Login</a></li>
                            <li><a href="register.php">Create Account</a></li>
                        <?php } else { ?>    
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Menu<span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="settings.php">Settings</a></li>
                                    <li><a href="tasks.php">Tasks</a></li>
                                    <li class="divider"></li>
                                    <li><a href="php_includes/logout.php">Logout</a></li>
                                </ul>
                            </li>                      
                        <?php } ?>
                    </ul>
                    <form class="navbar-form navbar-left" role="search">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Find movies">
                        </div>
                        <button type="submit" class="btn btn-primary" id="btnsearch">Submit</button>
                    </form>
                </div>

            </div>
        </div>
        <!--END NAV SECTION -->

