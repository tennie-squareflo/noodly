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
						<!-- <div class="col-12 col-md-6 col-xl-7">
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
					  </div> -->
					</div>
					<div class="products-bottom">
					  <div class="row">
            <?php
              foreach ($channels as $key => $channel) {
						?>
							<div class="col-6 col-md-4 col-lg-3 col-xl">
								<div class="card" style="width: 100%;">
									<div class="card-body">
										<h5 class="card-title"><?php echo $channel['name']; ?> </h5>
										<p class="card-text"><i><?php echo $channel['storiescount']; ?> Stories</i></p><br>
										<a class="btn btn- btn-sm" href="<?php echo BASE_URL.'channel/'.$channel['slug']; ?>">View</a> &nbsp; <a class="btn btn-light btn-sm" href="#"><i class="fas fa-rss"></i> Subscribe</a>
									</div>
								</div>
							</div>
						<?php 
							}
						?>
							</div>
			</div>
		  </section><!--End shop-->