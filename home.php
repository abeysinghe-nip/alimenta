<link rel="stylesheet" href="assets/css/home_about.css">
<style>
.section-title{
	font-size: 4rem;
	font-weight: 500;
  color: #9be8d3;
	margin-bottom: 10px;
	text-transform: uppercase;
	letter-spacing: 0.2rem;
	text-align: center;
}
.section-title span{
	color: black;
}
</style>
<div class="col-lg-12">
    <div class="contain-fluid">
        <!-- Service Section -->
  <section id="services" style="margin-top:100px;" >
    <div class="services container"> <!-- using another class with container class is if we need to overwrite the container class we can overwrite it using the other class-->

      <div class="service-top">
          <br><br>
        <h1 class="section-title"><span>s</span>e<span>r</span>v<span>i</span>c<span>e</span>s</h1>
        <p> Alimenta stands for Enhance your online food ordering experience! Elevate your dining options effortlessly</p>
      </div>

      <div class="service-bottom">

        <div class="service-item">
          <h2 style="color:#9be8d3;">Delivery</h2>
          <p>Fast and Responsible delivery</p>
        </div>

        <div class="service-item">
          <h2 style="color:#9be8d3;">100% Value</h2>
          <p>We can make your dream come true</p>
        </div>

        <div class="service-item">
          <h2 style="color:#9be8d3;">Standards</h2>
          <p>Our products are higher standard in quality</p>
        </div>

        <div class="service-item">
          <h2 style="color:#9be8d3;">24/7 Support</h2>
          <p>Our staff will provide 24/7 online support</p>
        </div>
      </div>
    </div>
  </section>
  <!-- End Service Section -->
        <div class="clear-fix mb-3"></div>
        <h3 class="text-center section-title"><span>Featured</span> Products</b></h3><br><br>
        <div class="row" id="product_list">
            <?php 
            $products = $conn->query("SELECT p.*, c.name as `category` FROM `product_list` p inner join category_list c on p.category_id = c.id where p.delete_flag = 0 and p.`status` =1 order by RAND() limit 8");
            while($row = $products->fetch_assoc()):
            ?>
            <div class="col-lg-3 col-md-6 col-sm-12 product-item">
                <a href="./?page=products/view_product&id=<?= $row['id'] ?>" class="card shadow rounded-0 text-reset text-decoration-none">
                <div class="product-img-holder position-relative">
                    <img src="<?= $row['image_path'] ?>" alt="Product-image" class="img-top product-img bg-white">
                </div>
                    <div class="card-body border-top border-gray">
                        <h5 class="card-title text-truncate w-100" style="color: #2e466f; font-weight:bold; text-transform:uppercase;"><?= $row['name'] ?></h5>
                        <div class="d-flex w-100">
                        </div>
                        <div class="d-flex">
                            <div class="col-auto px-0"><small class="text-muted">Category : </small></div>
                            <div class="col-auto px-0 flex-shrink-1 flex-grow-1"><p class="text-truncate m-0"><small class="text-muted"><?= $row['category'] ?></small></p></div>
                        </div>
                        <div class="d-flex">
                            <div class="col-auto px-0"><small class="text-muted">LKR </small></div>
                            <div class="col-auto px-0 flex-shrink-1 flex-grow-1" ><p class="m-0 pl-3" style="color: #9be8d3; font-weight:bold; font-size:15px;"><?= format_num($row['price']) ?></p></div>
                        </div>
                        <p class="card-text truncate-3 w-100" style="color: #9be8d3; font-weight:bold;">VIEW PRODUCT DETAILS</p>
                    </div>
                </a>
            </div>
            <?php endwhile; ?>
        </div>
        <div class="clear-fix mb-2"></div>
       <!-- <div class="text-center">
            <a href="./?page=products" class="btn btn-large btn-primary rounded-pill col-lg-3 col-md-5 col-sm-12">Explore More Products</a>
        </div>-->
        
    </div>
</div>