
      <section class="contact">
          <div class="container">
            <div class="row">
              <div class="col-12">
                <div class="map-contact">
                  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d29794.31661118451!2d105.82941046411365!3d21.02109628378552!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab9926e7bd67%3A0x580e078874d5df1e!2zVsSDbiBNaeG6v3UtIFF14buRYyBU4butIEdpw6Ft!5e0!3m2!1svi!2s!4v1556253249354!5m2!1svi!2s" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen=""></iframe>
                </div>
              </div>
              <div class="col-sm-6 col-md-3">
                <div class="contact-method">
                  <div class="icon-contact"><i class="ti-location-pin"></i></div>
                  <div class="contact-detail">
                    <h2>Address</h2>
                    <p>
                      <?php echo $publisher['address1'].'<br/>'.$publisher['city'].', '.$publisher['zipcode']; ?></p>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-md-3">
                <div class="contact-method">
                  <div class="icon-contact"><i class="ti-email"></i></div>
                  <div class="contact-detail">
                    <h2>Email</h2>
                    <p>
                      <?php echo $publisher['email'] ?></p>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-md-3">
                <div class="contact-method">
                  <div class="icon-contact"><i class="ti-time"></i></div>
                  <div class="contact-detail">
                    <h2>Office Hours</h2>
                    <p>Week Days: 10:00 – 22:00</p>
                    <p>Sunday: Close</p>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-md-3">
                <div class="contact-method">
                  <div class="icon-contact"><i class="ti-headphone"></i></div>
                  <div class="contact-detail">
                    <h2>Phone</h2>
                    <p><?php echo $publisher['phonenumber'] ?></p>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="leave-message text-center">
                  <h1>Leave Message</h1>
                  <p>Our staff will call back later and answer your questions</p>
                  <form>
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <input class="input-form trans-bg" id="name" type="text" placeholder="Name" required>
                      </div>
                      <div class="form-group col-md-6">
                        <input class="input-form trans-bg" id="email" type="email" placeholder="Email" required>
                      </div>
                      <div class="form-group col-12">
                        <textarea class="textarea-form trans-bg" id="messages" name="" cols="30" rows="6" placeholder="Message"></textarea>
                      </div>
                    </div>
                    <button class="normal-btn">Send message</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </section><!--End contact-->
 