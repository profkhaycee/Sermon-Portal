<?php 
$page_title =' Series';

include 'header.php';
?>

<style>
    .product:hover{
        transform: scale(0.9,0.8);
    }
</style>

	
<section class="subscribe">

<div class="container">

    <div class="row align-items-center">

        <!-- <div class="col-lg-2 col-md-12 col-sm-12"> -->

            <!-- <h3 class="text-white">search</h3> -->

            <!-- <p class="text-white">Subscribe to keep up with fresh news and exciting updates.</p> -->

        <!-- </div> -->

        <div class="col-lg-12 col-md-12 col-sm-12">

            <form action="" method="GET">

                <input type="text" name="searchInput" placeholder="search by Series name">

                <button type="submit" name="searchBtn">Search</button>

            </form>

        </div>

    </div>

</div>

</section>


		
<section class="gappp church-products">
    <div class="heading my-5">
        <!-- <img src="assets/images/heading-img.webp" alt="Heading Image"> -->
        <h3>All Series</h3>
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
    <div class="container-fluid">
        <div class="row mx-2 mt-3">
        

        <?php
                $page = isset($_REQUEST['page'])  ? $_REQUEST['page'] : 1;
				if(isset($_REQUEST['searchInput'])){
					$searchInput = $action->validate($_REQUEST['searchInput']);
                    echo $action->searchSeries($searchInput);

				}else{
					 echo $action->fetchAllSeries($page) ;

				}
		?>
   
            <!-- <div class="d-flex justify-content-center loadmore">

                <a href="JavaScript:void(0)" class="theme-btn">Load More</a>

            </div> -->
        </div>
    </div>
</section>


<?php
include 'footer.php';