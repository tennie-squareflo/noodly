<?php 
  $this->load_model('category');
  $this->load_model('story');
  $this->load_model('publisher');
  $categories = $this->category_model->get_categories($publisher['pid'], 0);
  $stories = $this->view_data['stories'] = $this->story_model->get_recent_stories($publisher['pid'], 0);
?>
<section class="posts blog-masonry">
  <div class="container">
    <div class="blog-masonry_wrapper">
      <?php
        foreach ($stories as $key => $story) {
      ?>
        <div class="post-block post-classic">
          <div class="post-img"><img src="<?php echo ASSETS_URL;?>media/stories/<?php echo $story['thumb_image'];?>" alt="post image"></div>
          <div class="post-detail">
            <div class="post-credit">
              <h5 class="upload-day"><?php echo $story['created_at'] ?></h5>
              <div class="post-tag"><a href="index.html"><?php echo $categories[$story['cid']]['name']; ?></a></div>
            </div><a class="post-title regular" target="_blank" href="<?php echo BASE_URL.'story/preview/'.$story['url'];?>"><?php echo $story['title'];?></a>
          </div>
        </div>
      <? } ?>



      <div class="post-block post-classic">
        <div class="post-img"><img src="https://images.pexels.com/photos/1816593/pexels-photo-1816593.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500" alt="post image"></div>
        <div class="post-detail">
          <div class="post-credit">
            <h5 class="upload-day">February 27, 2019</h5>
            <div class="post-tag"><a href="index.html">section</a></div>
          </div><a class="post-title regular" href="story-detail.html">Story Title Goes Here</a>
        </div>
      </div>



      <div class="post-block post-classic">
        <div class="post-img"><img src="https://images.pexels.com/photos/1311590/pexels-photo-1311590.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500" alt="post image"></div>
        <div class="post-detail">
          <div class="post-credit">
            <h5 class="upload-day">February 27, 2019</h5>
            <div class="post-tag"><a href="index.html">section</a></div>
          </div><a class="post-title regular" href="story-detail.html">Story Title Goes Here</a>
        </div>
      </div>

      <div class="post-block post-classic">
        <div class="post-img"><img src="https://images.pexels.com/photos/3039185/pexels-photo-3039185.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500" alt="post image"></div>
        <div class="post-detail">
          <div class="post-credit">
            <h5 class="upload-day">February 27, 2019</h5>
            <div class="post-tag"><a href="index.html">section</a></div>
          </div><a class="post-title regular" href="story-detail.html">Story Title Goes Here</a>
        </div>
      </div>



      <div class="post-block post-classic">
        <div class="post-img"><img src="https://images.pexels.com/photos/2506923/pexels-photo-2506923.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500" alt="post image"></div>
        <div class="post-detail">
          <div class="post-credit">
            <h5 class="upload-day">February 27, 2019</h5>
            <div class="post-tag"><a href="index.html">section</a></div>
          </div><a class="post-title regular" href="story-detail.html">Story Title Goes Here</a>
        </div>
      </div>



      <div class="post-block post-classic">
        <div class="post-img"><img src="https://images.pexels.com/photos/2683138/pexels-photo-2683138.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500" alt="post image"></div>
        <div class="post-detail">
          <div class="post-credit">
            <h5 class="upload-day">February 27, 2019</h5>
            <div class="post-tag"><a href="index.html">section</a></div>
          </div><a class="post-title regular" href="story-detail.html">Story Title Goes Here</a>
        </div>
      </div>

      <div class="post-block post-classic">
        <div class="post-img"><img src="https://images.pexels.com/photos/2700533/pexels-photo-2700533.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500" alt="post image"></div>
        <div class="post-detail">
          <div class="post-credit">
            <h5 class="upload-day">February 27, 2019</h5>
            <div class="post-tag"><a href="index.html">section</a></div>
          </div><a class="post-title regular" href="story-detail.html">Story Title Goes Here</a>
        </div>
      </div>



      <div class="post-block post-classic">
        <div class="post-img"><img src="https://images.pexels.com/photos/2917442/pexels-photo-2917442.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500" alt="post image"></div>
        <div class="post-detail">
          <div class="post-credit">
            <h5 class="upload-day">February 27, 2019</h5>
            <div class="post-tag"><a href="index.html">section</a></div>
          </div><a class="post-title regular" href="story-detail.html">Story Title Goes Here</a>
        </div>
      </div>


      <div class="post-block post-classic">
        <div class="post-img"><img src="https://images.pexels.com/photos/2216727/pexels-photo-2216727.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500" alt="post image"></div>
        <div class="post-detail">
          <div class="post-credit">
            <h5 class="upload-day">February 27, 2019</h5>
            <div class="post-tag"><a href="index.html">section</a></div>
          </div><a class="post-title regular" href="story-detail.html">Story Title Goes Here</a>
        </div>
      </div>


      <div class="post-block post-classic">
        <div class="post-img"><img src="https://images.pexels.com/photos/2847037/pexels-photo-2847037.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500" alt="post image"></div>
        <div class="post-detail">
          <div class="post-credit">
            <h5 class="upload-day">February 27, 2019</h5>
            <div class="post-tag"><a href="index.html">section</a></div>
          </div><a class="post-title regular" href="story-detail.html">Story Title Goes Here</a>
        </div>
      </div>



      <div class="post-block post-classic">
          <div class="post-img"><img src="https://images.pexels.com/photos/1816593/pexels-photo-1816593.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500" alt="post image"></div>
          <div class="post-detail">
            <div class="post-credit">
              <h5 class="upload-day">February 27, 2019</h5>
              <div class="post-tag"><a href="index.html">section</a></div>
            </div><a class="post-title regular" href="story-detail.html">Story Title Goes Here</a>
          </div>
        </div>



        <div class="post-block post-classic">
          <div class="post-img"><img src="https://images.pexels.com/photos/1311590/pexels-photo-1311590.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500" alt="post image"></div>
          <div class="post-detail">
            <div class="post-credit">
              <h5 class="upload-day">February 27, 2019</h5>
              <div class="post-tag"><a href="index.html">section</a></div>
            </div><a class="post-title regular" href="story-detail.html">Story Title Goes Here</a>
          </div>
        </div>

        <div class="post-block post-classic">
          <div class="post-img"><img src="https://images.pexels.com/photos/3039185/pexels-photo-3039185.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500" alt="post image"></div>
          <div class="post-detail">
            <div class="post-credit">
              <h5 class="upload-day">February 27, 2019</h5>
              <div class="post-tag"><a href="index.html">section</a></div>
            </div><a class="post-title regular" href="story-detail.html">Story Title Goes Here</a>
          </div>
        </div>



        <div class="post-block post-classic">
          <div class="post-img"><img src="https://images.pexels.com/photos/2506923/pexels-photo-2506923.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500" alt="post image"></div>
          <div class="post-detail">
            <div class="post-credit">
              <h5 class="upload-day">February 27, 2019</h5>
              <div class="post-tag"><a href="index.html">section</a></div>
            </div><a class="post-title regular" href="story-detail.html">Story Title Goes Here</a>
          </div>
        </div>



        <div class="post-block post-classic">
          <div class="post-img"><img src="https://images.pexels.com/photos/2683138/pexels-photo-2683138.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500" alt="post image"></div>
          <div class="post-detail">
            <div class="post-credit">
              <h5 class="upload-day">February 27, 2019</h5>
              <div class="post-tag"><a href="index.html">section</a></div>
            </div><a class="post-title regular" href="story-detail.html">Story Title Goes Here</a>
          </div>
        </div>

        <div class="post-block post-classic">
          <div class="post-img"><img src="https://images.pexels.com/photos/2700533/pexels-photo-2700533.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500" alt="post image"></div>
          <div class="post-detail">
            <div class="post-credit">
              <h5 class="upload-day">February 27, 2019</h5>
              <div class="post-tag"><a href="index.html">section</a></div>
            </div><a class="post-title regular" href="story-detail.html">Story Title Goes Here</a>
          </div>
        </div>



        <div class="post-block post-classic">
          <div class="post-img"><img src="https://images.pexels.com/photos/2917442/pexels-photo-2917442.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500" alt="post image"></div>
          <div class="post-detail">
            <div class="post-credit">
              <h5 class="upload-day">February 27, 2019</h5>
              <div class="post-tag"><a href="index.html">section</a></div>
            </div><a class="post-title regular" href="story-detail.html">Story Title Goes Here</a>
          </div>
        </div>


        <div class="post-block post-classic">
          <div class="post-img"><img src="https://images.pexels.com/photos/2216727/pexels-photo-2216727.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500" alt="post image"></div>
          <div class="post-detail">
            <div class="post-credit">
              <h5 class="upload-day">February 27, 2019</h5>
              <div class="post-tag"><a href="index.html">section</a></div>
            </div><a class="post-title regular" href="story-detail.html">Story Title Goes Here</a>
          </div>
        </div>


        <div class="post-block post-classic">
          <div class="post-img"><img src="https://images.pexels.com/photos/2847037/pexels-photo-2847037.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500" alt="post image"></div>
          <div class="post-detail">
            <div class="post-credit">
              <h5 class="upload-day">February 27, 2019</h5>
              <div class="post-tag"><a href="index.html">section</a></div>
            </div><a class="post-title regular" href="story-detail.html">Story Title Goes Here</a>
          </div>
        </div>



        <div class="post-block post-classic">
            <div class="post-img"><img src="https://images.pexels.com/photos/1816593/pexels-photo-1816593.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500" alt="post image"></div>
            <div class="post-detail">
              <div class="post-credit">
                <h5 class="upload-day">February 27, 2019</h5>
                <div class="post-tag"><a href="index.html">section</a></div>
              </div><a class="post-title regular" href="story-detail.html">Story Title Goes Here</a>
            </div>
          </div>



          <div class="post-block post-classic">
            <div class="post-img"><img src="https://images.pexels.com/photos/1311590/pexels-photo-1311590.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500" alt="post image"></div>
            <div class="post-detail">
              <div class="post-credit">
                <h5 class="upload-day">February 27, 2019</h5>
                <div class="post-tag"><a href="index.html">section</a></div>
              </div><a class="post-title regular" href="story-detail.html">Story Title Goes Here</a>
            </div>
          </div>

          <div class="post-block post-classic">
            <div class="post-img"><img src="https://images.pexels.com/photos/3039185/pexels-photo-3039185.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500" alt="post image"></div>
            <div class="post-detail">
              <div class="post-credit">
                <h5 class="upload-day">February 27, 2019</h5>
                <div class="post-tag"><a href="index.html">section</a></div>
              </div><a class="post-title regular" href="story-detail.html">Story Title Goes Here</a>
            </div>
          </div>



          <div class="post-block post-classic">
            <div class="post-img"><img src="https://images.pexels.com/photos/2506923/pexels-photo-2506923.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500" alt="post image"></div>
            <div class="post-detail">
              <div class="post-credit">
                <h5 class="upload-day">February 27, 2019</h5>
                <div class="post-tag"><a href="index.html">section</a></div>
              </div><a class="post-title regular" href="story-detail.html">Story Title Goes Here</a>
            </div>
          </div>



          <div class="post-block post-classic">
            <div class="post-img"><img src="https://images.pexels.com/photos/2683138/pexels-photo-2683138.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500" alt="post image"></div>
            <div class="post-detail">
              <div class="post-credit">
                <h5 class="upload-day">February 27, 2019</h5>
                <div class="post-tag"><a href="index.html">section</a></div>
              </div><a class="post-title regular" href="story-detail.html">Story Title Goes Here</a>
            </div>
          </div>

          <div class="post-block post-classic">
            <div class="post-img"><img src="https://images.pexels.com/photos/2700533/pexels-photo-2700533.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500" alt="post image"></div>
            <div class="post-detail">
              <div class="post-credit">
                <h5 class="upload-day">February 27, 2019</h5>
                <div class="post-tag"><a href="index.html">section</a></div>
              </div><a class="post-title regular" href="story-detail.html">Story Title Goes Here</a>
            </div>
          </div>



          <div class="post-block post-classic">
            <div class="post-img"><img src="https://images.pexels.com/photos/2917442/pexels-photo-2917442.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500" alt="post image"></div>
            <div class="post-detail">
              <div class="post-credit">
                <h5 class="upload-day">February 27, 2019</h5>
                <div class="post-tag"><a href="index.html">section</a></div>
              </div><a class="post-title regular" href="story-detail.html">Story Title Goes Here</a>
            </div>
          </div>


          <div class="post-block post-classic">
            <div class="post-img"><img src="https://images.pexels.com/photos/2216727/pexels-photo-2216727.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500" alt="post image"></div>
            <div class="post-detail">
              <div class="post-credit">
                <h5 class="upload-day">February 27, 2019</h5>
                <div class="post-tag"><a href="index.html">section</a></div>
              </div><a class="post-title regular" href="story-detail.html">Story Title Goes Here</a>
            </div>
          </div>


          <div class="post-block post-classic">
            <div class="post-img"><img src="https://images.pexels.com/photos/2847037/pexels-photo-2847037.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500" alt="post image"></div>
            <div class="post-detail">
              <div class="post-credit">
                <h5 class="upload-day">February 27, 2019</h5>
                <div class="post-tag"><a href="index.html">section</a></div>
              </div><a class="post-title regular" href="story-detail.html">Story Title Goes Here</a>
            </div>
          </div>

    </div>
    <div class="row">
      <div class="col-12 text-center">
        <button class="normal-btn" id="load-more">Load more</button>
      </div>
    </div>
  </div>
</section><!--End posts-->