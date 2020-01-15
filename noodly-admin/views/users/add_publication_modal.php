<div class="modal-dialog modal-dialog-centered" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title">Add Publication</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <form class="k-form" id="add-publication-form"  method="post" enctype="multipart/form-data">
        <div class="row">
          <div class="col-xl-1"></div>
          <div class="col-xl-10">
            <div class="k-section k-section--first">
              <div class="k-section__body">
                <h3 class="k-section__title k-section__title-lg">&nbsp;</h3>

                <div class="form-group row">
                  <label class="col-3 col-form-label">Role</label>
                  <div class="col-9">
                    <select class="form-control" placeholder="Role" name="role">
                      <?php
                        $options = array(
                          '' => 'Select Role',
                          'admin' => 'Publisher Admin',
                          'contributor' => 'Contributor');
                        foreach ($options as $key => $option) {
                          echo "<option value='$key'>$option</option>";
                        }
                      ?>
                    </select>
                  </div>
                </div>
                
                <div class="form-group row" id="publisher-row">
                  <label class="col-3 col-form-label">Publisher</label>
                  <div class="col-9">
                    <select class="form-control" placeholder="Publisher" name="pid">
                      <?php
                        unset($publishers[0]);
                        $publishers = array('' => array('name' => 'Select Publisher')) + $publishers;
                        foreach ($publishers as $key => $publisher) {
                          echo "<option value='$key'>$publisher[name]</option>";
                        }
                      ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>  
            <div class="k-separator k-separator--border-dashed k-separator--space-lg"></div>
            
          </div>
          <div class="col-xl-1"></div>
        </div>
      </form>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-primary" id="add-btn">Add</button>
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
  </div>
</div>