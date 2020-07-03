<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="IDE, Web, Webdevelopement, UI, Software, Game, Application, Multiplateform, Design" name="keywords">
    <meta content="Create your own Web page, Software, Application and Game as fast as simple." name="description">

    <meta name="author" content="Artefact Company">

    <meta property="og:title" content="Artefact">
    <meta property="og:description" content="Create your own Web page, Software, Application and Game as fast as simple.">
    <meta property="og:image" content="https://artefact.yo.fr/education/img/core-img/logo.png">
    <meta property="og:url" content="https://artefact.yo.fr/">

    <meta name="twitter:title" content="Artefact">
    <meta name="twitter:description" content="Create your own Web page, Software, Application and Game as fast as simple.">
    <meta name="twitter:image" content="https://artefact.yo.fr/education/img/core-img/logo.png">
    <meta name="twitter:card" content="summary_large_image">

    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>
        <?php if (isset($title)) : ?>
            <?= $title; ?>
        <?php else : ?>
            Artefact - Education Course Template
        <?php endif ?>
    </title>

    <!-- Favicon -->
    <link rel="icon" href="img/core-img/logo.png">
    <link rel="apple-touch-icon" href="img/core-img/logo.png">

    <!-- Core Stylesheet -->
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <!-- ##### Preloader ##### -->
    <div id="preloader">
        <i class="circle-preloader"></i>
    </div>

    <!-- ##### Header Area Start ##### -->
    <header class="header-area">

        <!-- Top Header Area -->
        <div class="top-header">
            <div class="container h-100">
                <div class="row h-100">
                    <div class="col-12 h-100">
                        <div class="header-content h-100 d-flex align-items-center justify-content-between">
                            <div class="academy-logo">
                                <a href="index.php"><img src="img/core-img/logo.png" alt=""> Artafact</a>
                            </div>

                            <?php if ($connected) : ?>
                                <!-- Logged-->
                                <div class="login-state d-flex align-items-center">
                                    <div class="user-name mr-30">
                                        <div class="dropdown">
                                            <a class="dropdown-toggle" href="#" role="button" id="userName" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= $_SESSION['edu-artefact']['user']['name'] ?></a>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userName">
                                                <a class="dropdown-item" href="profile.php">Profile</a>
                                                <a class="dropdown-item" href="logout.php">Logout</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="userthumb">
                                        <img src="img/profile/<?= $_SESSION['edu-artefact']['user']['profileImage'] ?>" alt="">
                                    </div>
                                </div>
                            <?php else : ?>
                                <!-- Register / LogIn -->
                                <div class="login-content">
                                    <a href="register.php">Register</a> / <a href="login.php">Login</a>
                                </div>
                            <?php endif ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navbar Area -->
        <div class="academy-main-menu">
            <div class="classy-nav-container breakpoint-off">
                <div class="container">
                    <!-- Menu -->
                    <nav class="classy-navbar justify-content-between" id="academyNav">

                        <!-- Navbar Toggler -->
                        <div class="classy-navbar-toggler">
                            <span class="navbarToggler"><span></span><span></span><span></span></span>
                        </div>

                        <!-- Menu -->
                        <div class="classy-menu">

                            <!-- close btn -->
                            <div class="classycloseIcon">
                                <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                            </div>

                            <!-- Nav Start -->
                            <div class="classynav">
                                <ul>
                                    <li><a href="index.php">Home</a></li>
                                    <li><a href="course.php">COURSE</a></li>
                                    <li><a href="#">DOWNLOAD</a>
                                        <ul class="dropdown">
                                            <li><a href="https://artefact.yo.fr/" target="_blank">IDE</a></li>
                                            <li><a href="#" target="_blank">Asset/Templates</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="./documentation">DOCUMENTATION</a></li>
                                    <li><a href="#">PAGES</a>
                                        <div class="megamenu">
                                            <ul class="single-mega cn-col-4">
                                                <li><a href="">HOME</a></li>
                                                <li><a href="course.php">COURSE</a></li>
                                                <li><a href="blog.php">BLOG</a></li>
                                                <li><a href="about-us.php">ABOUT US</a></li>
                                                <li><a href="contact.php">CONTACT US</a></li>
                                            </ul>
                                            <ul class="single-mega cn-col-4">
                                                <li><a href="teacher.php">Teacher</a></li>
                                                <li><a href="testimonials.php">Testimonials</a></li>
                                                <li><a href="business.php">Business</a></li>
                                            </ul>
                                            <ul class="single-mega cn-col-4">
                                                <li><a href="documentation.php">DOCUMENTATION</a></li>
                                                <li><a href="https://artefact.yo.fr/" target="_blank">Download IDE</a></li>
                                                <li><a href="#" target="_blank">Assets &amp; Templates</a></li>
                                            </ul>
                                            <div class="single-mega cn-col-4">
                                                <img src="img/bg-img/bg-5.png" alt="">
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <!-- Nav End -->
                        </div>

                        <!-- Calling Info -->
                        <div class="calling-info">
                            <div class="call-center">
                                <a href="tel:+4917674355424"><i class="icon-telephone-2"></i> <span>(+49) 176 743 554 24</span></a>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ##### Header Area End ##### -->