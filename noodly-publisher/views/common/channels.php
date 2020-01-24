<style>
  #main {
    padding-top: 150px;
  }
</style>
<section class="shop">
			<div class="container">
			  <div class="shop-5col">
				<div class="row"></div>
				  <div class="col-12">
					<div class="products-top_bar">
					  <div class="row align-items-center no-gutters justify-content-between">
						<div class="col-12 col-md-5 col-xl-5">
						  <div class="product-show_block">
							<div class="product-found">
							  <h5><span><?php echo count($channels); ?></span>Channels</h5>
							</div>
						  </div>
						</div>
						<div class="col-12 col-md-6 col-xl-7">
						  <div class="product-detail_filter">
							&nbsp
							<div class="sort">
								<label for="sort">Sort by</label>
								<select id="sort" name="sort">
								  <option value="A-Z">A-Z</option>
								  <option value="Z-A">Z-A</option>
								  <option value="lowtohigh">Most Popular</option>
								  <option value="hightolow">Newest</option>
								</select>
							  </div>
						  </div>
						</div>
					  </div>
					</div>
					<div class="products-bottom">
					  <div class="row">
            <?php
                            
              foreach ($channels as $key => $channel) {
            ?>
						<div class="col-md-4 col-lg-3 col-xl">
						  <div class="product-block"><a class="product-img" href="<?php echo BASE_URL.'channel_view/'.$channel['cid']; ?>">
              <?php
                if (empty($channel['image'])
                  || !file_exists(ASSETS_URL.'media/sections/'.$channel['image'])) {
              ?>
                  <img src="https://afinda.vn/html/Pisen/assets/images/products/1.png"
                />
              <?php
                } else {
              ?>
                <img src="<?php echo ASSETS_URL;?>media/sections/<?php echo $channel['image'];?>"
                />
              <?php
                }
                ?>
              
              <div class="product-select">
								<button class="add-cart"><i class="icon_bag_alt"></i></button>
							  </div></a>
							<div class="product-detail">
							  <div class="product-name"><a href="#"><?php echo $channel['storiescount']; ?> Stories</a></div>
							</div>
						  </div>
            </div>
              <?php } ?>
						
				 
				</div>
			  </div>
			</div>
		  </section><!--End shop-->