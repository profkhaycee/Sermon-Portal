<?php
include 'actions.php';
$action = new Action();


?>

<!DOCTYPE html>

<head>
 
	<!-- Meta Options -->

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<!-- Title -->

	<title>KDC E-Library - <?php if(isset($page_title)){ echo $page_title ;} ?></title>

	<!-- Bootstrap -->

	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

	<!-- Favicon -->

	<link rel="icon" type="image/x-icon" href="icon-2.png">

	<!-- Slick Slider -->

	<link rel="stylesheet" type="text/css" href="assets/css/slick.css">
	<!-- <script src="assets/js/fontawesome.js"></script> -->


	<!-- Animate -->

	<link rel="stylesheet" type="text/css" href="assets/css/animate.min.css">


	<!-- Animate on scroll -->

	<link rel="stylesheet" type="text/css" href="assets/css/aos.css">


	<!-- Fancy Box -->

	<link rel="stylesheet" href="assets/css/jquery.fancybox.min.css">


	<!-- Stylesheet -->

	<link rel="stylesheet" type="text/css" href="assets/css/style.css">



	<!-- Colors -->

	<link rel="stylesheet" type="text/css" href="assets/css/color.css">



	<!-- Responsive -->

	<link rel="stylesheet" type="text/css" href="assets/css/responsive.css">

    <!-- Data Tables -->
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

    <!--<link rel="stylesheet" href="visual-percent-preloader/percent-preloader.css" />-->


</head>

<body>

	<!-- Loader Start -->
	<!-- <div class="preloader" id="preloader"> -->
	  <!-- <svg viewBox="0 0 1920 1080" preserveAspectRatio="none" version="1.1">
	    <path d="M0,0 C305.333333,0 625.333333,0 960,0 C1294.66667,0 1614.66667,0 1920,0 L1920,1080 C1614.66667,1080 1294.66667,1080 960,1080 C625.333333,1080 305.333333,1080 0,1080 L0,0 Z"></path>
	  </svg> -->
	  <!-- <div class="inner">
	    <canvas class="progress-bar" id="progress-bar" width="200" height="200"></canvas>
	    <figure><img src="assets/images/icon-white.png" alt="Image"></figure>
	    <small>Loading</small> 
	  </div> -->
	  <!-- end inner --> 
	<!-- </div> -->

	<!-- Loader End -->
	<!-- Header One Start -->

	<!-- <header class="header-one">

		

		<div class="desktop-nav"  id="stickyHeader">

			<div class="container">

				<div class="row">

					<div class="col-lg-12">

						<nav>

							<div class="logo">

								<a href="http://kdcloveembassy.com/">

									<img src="logo.png" alt="Logo">

								</a>

							</div>

							<div class="nav-bar">

								<ul>

									<li class=""><a href="http://kdcloveembassy.com/">Home</a></li>

									<li class=""><a href="messages.php">Messages</a></li>

									<li class=""><a href="series.php">Series</a></li>

								</ul>

							</div>

							

							<div id="nav-icon4">

							  <span></span>

							  <span></span>

							  <span></span>

							</div>

						</nav>

					</div>

				</div>

			</div>

		</div>

		<div class="mobile-nav" id="mobile-nav">

			<div class="res-log">

				<a href="http://kdcloveembassy.com/">

					<img src="logo.png" alt="Responsive Logo">

				</a>

			</div>

			<ul>

				<li class=""><a href="http://kdcloveembassy.com/">Home</a></li>

				<li class=""><a href="index.php">Messages</a></li>

				<li class=""><a href="series.php">Series</a></li>

				
			</ul>


			<a href="JavaScript:void(0)" id="res-cross"></a>

		</div>

	</header> -->
	
<!--	<div class="preloader">-->
<!--  <div class="inner">-->
<!--    <span class="percentage"><span id="percentage">1</span>%</span>-->
<!--  </div>-->
<!--  <div class="loader-progress" id="loader-progress"> </div>-->
<!--</div>-->

	
	<header class="header-one">

		

		<div class="desktop-nav"  id="stickyHeader">


				<div class="row">

					<div class="col-lg-12">

						<nav>

							<div class="logo">

								<a href="https://kdcloveembassy.com/">

									<img src="logo.png" alt="Logo">

								</a>

							</div>

							<div class="nav-bar">

								<ul>

									<li class=""><a href="index.php">Home</a></li>

									<li class=""><a href="series.php">series</a></li>

								</ul>

							</div>


							<div id="nav-icon4">

							  <span></span>

							  <span></span>

							  <span></span>

							</div>

						</nav>

					</div>

				</div>


		</div>

		<div class="mobile-nav" id="mobile-nav">

			<div class="res-log">

				<a href="index.php">

					<img src="logo.png" alt="Responsive Logo">

				</a>

			</div>

			<ul>
				<li class="menu-item-has-children"> <a href="index.php">Home</a> </li>
				<li class="menu-item-has-children"><a href="series.php">Series</a>	</li>
			</ul>

			<a href="JavaScript:void(0)" id="res-cross"></a>

		</div>

	</header>

	<!-- Header One End -->
