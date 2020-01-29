<style>
  #main {
    padding-top: 150px;
  }
</style>
      <section class="contact">
        <div class="container">
            <div class="row">
              <!-- <div class="col-12">
                <div class="map-contact">
                  <! -- <iframe src="<?php echo $publisher['map'] ?>" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen=""></iframe> -- >
                  <div style="width: 100%"><iframe width="100%" height="450" src="https://maps.google.com/maps?width=100%&amp;height=450&amp;hl=en&amp;q=<?php echo $publisher['address1'].', '.$publisher['city'].', '.$publisher['state'].', '.$publisher['country'].' '.$publisher['zipcode']; ?>&amp;ie=UTF8&amp;t=&amp;z=22&amp;iwloc=B&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                </div>
              </div> -->
              
              <div class="col-12">
                <div class="leave-message text-center">
                  <h1>Contact Us</h1>
                  <p>Fill out the form below to get in touch with us</p>
                  <form>
                    <div class="form-row mb-2">
                      <div class="form-group col-md-6 text-left">
                        <label for="firstname">Fistname</label>
                        <input class="input-form" name="firstname" id="firstname" type="text" placeholder="Fistname" required>
                      </div>
                      <div class="form-group col-md-6 text-left">
                        <label for="lastname">Lastname</label>
                        <input class="input-form" name="lastname" id="lastname" type="text" placeholder="Lastname" required>
                      </div>
                      <div class="form-group col-md-12 text-left">
                        <label for="email">Email</label>
                        <input class="input-form" name="email" id="email" type="email" placeholder="Email" required>
                      </div>
                      <div class="form-group col-md-12 text-left">
                        <label for="phone">Phone #</label>
                        <input class="input-form" name="phone" id="phone" type="text" placeholder="Phone #" required>
                      </div>
                      <div class="form-group col-12 text-left">
                        <label for="phone">Message</label>
                        <textarea class="textarea-form" name="messages" id="messages" name="" cols="30" rows="6" placeholder="Message"></textarea>
                      </div>
                    </div>
                    <button class="normal-btn mb-5">Send message</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </section><!--End contact-->
 