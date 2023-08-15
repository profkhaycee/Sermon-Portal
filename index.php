<?php 
$page_title ='Messages';

include_once('header.php');

?>

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

	<!-- Banner Start -->

	<!-- <section class=" position-relatikkve"> -->

		<!-- <div class="parallax" style="background-image: url(assets/images/banner.webp);"></div> -->

			<!-- <div class="banner-data text-center">

				<h2 class="text-white font-bold">Messages</h2>

			


			</div>

	</section> -->

	
	<section class="subscribe mt-3">

		<div class="container">

			<div class="row align-items-center">

				<!-- <div class="col-lg-2 col-md-12 col-sm-12"> -->

					<!-- <h3 class="text-white">search</h3> -->

					<!-- <p class="text-white">Subscribe to keep up with fresh news and exciting updates.</p> -->

				<!-- </div> -->

				<div class="col-lg-12 col-md-12 col-sm-12">

					<form action="" method="GET">

						<input type="text" name="searchInput" placeholder="search by message Title">

						<button type="submit" name="searchBtn">Search</button>

					</form>

				</div>

			</div>

		</div>

	</section>


   
	<div>
		<h1 class="text-center bg-light mt-2 py-4">Audio Messages</h1>
	</div>
	<style>
		.page-link{
			color: #ffc266 !important;
			/* font-weight: 900 !important; */
			border: 1px solid #ffc266 !important;

		}
		.page-item{
			/* border: 1px solid #ffc266 !important; */
		}
		.page-item.active .page-link{
			background-color: #ffc266 !important;
			color: white !important;
			border: 1px solid #ffc266 !important;

		}
	</style>
	<section class="gappp sermons">

		<div class="container">

			<div class="row">
			<?php
			$page = isset($_REQUEST['page'])  ? $_REQUEST['page'] : 1;
				if(isset($_REQUEST['searchInput'], $_REQUEST['searchBtn'])){
					$searchInput = $action->validate($_REQUEST['searchInput']);
					echo $action->searchMessages($searchInput);

				}else{
					 echo $action->fetchAllMessages($page) ;

				}
			?>


			</div>

			<!-- <div class="d-flex justify-content-center loadmore"> -->
				<?php //echo $action->paginate(); ?>
				<!-- <a href="JavaScript:void(0)" class="theme-btn">Load More</a> -->

			<!-- </div> -->

		</div>

	</section>

	<!-- Contact Us End -->
<?php

	include 'footer.php';

?>
