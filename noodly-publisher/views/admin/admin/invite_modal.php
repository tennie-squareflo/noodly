<div class="modal-dialog modal-dialog-centered" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title">Invite a Contributor</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <form class="k-form" id="invite-form"  method="post" enctype="multipart/form-data">
        <div class="row">
          <div class="col-xl-1"></div>
          <div class="col-xl-10">
            <div class="k-section k-section--first">
              <div class="k-section__body">
                <h3 class="k-section__title k-section__title-lg">&nbsp;</h3>

                <div class="form-group row">
                  <label class="col-3 col-form-label">Email</label>
                  <div class="col-9">
                    <input class="form-control" placeholder="Email Address" name="email" type="text">
                  </div>
                </div>
              
                <div class="form-group row">
                  <label class="col-3 col-form-label">First Name</label>
                  <div class="col-9">
                    <input class="form-control" placeholder="First Name" name="firstname" type="text" readonly>
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
      <button type="button" class="btn btn-primary" id="invite-btn">Invite</button>
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
  </div>
</div>