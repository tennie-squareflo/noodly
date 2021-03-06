					<!-- begin:: Content -->
          <div class="k-content	k-grid__item k-grid__item--fluid k-grid k-grid--hor">

<!-- begin:: Content Head -->
<div class="k-content__head	k-grid__item">
  <h3 class="k-content__head-title">Contributors</h3>
</div>

<!-- end:: Content Head -->

<!-- begin:: Content Body -->
<div class="k-content__body	k-grid__item k-grid__item--fluid" id="k_content_body">
    
    <div class="k-portlet k-portlet--mobile">
      <div class="k-portlet__head">
        <div class="k-portlet__head-label" id="contributor-action-search">
          <h3 class="k-portlet__head-title">
              <br /><div class="form-group ">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <div class="input-group-append">
                      <button class="btn btn-secondary" type="button">Go!</button>
                    </div>
                  </div>
              </div>
          </h3>
        </div>
        <div class="k-portlet__head-toolbar" id="contributor-action-invite">
          <div class="k-portlet__head-toolbar-wrapper">
            <div class="dropdown dropdown-inline">
              <a class="btn btn-danger btn-delete-selected">
                <i class="la la-trash"></i> Block Selected
              </a>
            </div>
            <div class="dropdown dropdown-inline">
              <a class="btn btn-success" data-toggle="modal" data-target="#inviteModal" id="contributor-button-invite">
                <i class="fa fa-paper-plane"></i> Invite A Contributor
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="k-portlet__body">

          <!--begin::Portlet-->
      
            
              
                <div class="table-responsive">
                  <table class="table table-head-noborder table-striped">
                  <thead>
                    <tr>
                      
                        <th>&nbsp</th>
                        <th>Name</th>
                        <th class="hide-mobile">Email Address</th>
                        <th class="hide-mobile">Stories</th>
                        <th class="hide-mobile">Subscribers</th>
                        <th class="hide-mobile">Status</th>
                        <th>&nbsp;</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      foreach ($contributors as $key => $contributor) {
                    ?>
                      <tr>
                        <td>
                          <div class="form-check">
                            <input class="form-check-input" id="defaultCheck_<?php echo $contributor['uuid']; ?>" data-id="<?php echo $contributor['uuid']; ?>" name="defaultCheck[]" type="checkbox" value="<?php echo $contributor['uuid'];?>"> <label class="form-check-label" for="defaultCheck1"></label>
                            <label class="form-check-label" for="defaultCheck1"></label>
                          </div>
                        </td>
                        <td><h5><a href="#"><?php echo $contributor['username'];?></a></h5></td>
                        <td class="hide-mobile"><?php echo $contributor['email'];?></td>
                        <td class="hide-mobile"><?php echo number_k($contributor['stories']); ?></td>
                        <td class="hide-mobile"><span class="badge badge-warning"><?php echo number_k($contributor['subscribers']); ?></span></td>
                        <td class="hide-mobile"><?php 
                          echo intval($contributor['status']) == 0 
                                ? '<span class="badge badge-warning">Suspended</span>' 
                                : (intval($contributor['status']) == 1 
                                  ? '<span class="badge badge-success">Active</span>' 
                                  : (intval($contributor['status']) >= time() 
                                    ? '<span class="badge badge-info">Invite Sent</span>' 
                                    : '<span class="badge badge-danger">Invite Expired</span>'));
                        ?>
                        </td>
                        <td class="text-right" width="15%">
                            <div class="btn-group" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-outline-secondary dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-bars"></i> Actions
                                </button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                <?php if (intval($contributor['status']) > 1): ?>
                                  <a class="dropdown-item invite-btn" data-id="<?php echo $contributor['uuid']; ?>" href="#"><i class="fa fa-paper-plane"></i>Send Invitation</a>
                                <?php endif; ?>
                                <a class="dropdown-item admin-btn" data-id="<?php echo $contributor['uuid']; ?>" href="#"><i class="fa fa-user-astronaut"></i>Make Admin</a>                              
                                <a class="dropdown-item edit-btn" data-id="<?php echo $contributor['uuid']; ?>" href=<?php echo BASE_URL.'contributor/edit/'.$contributor['uuid'] ?>><i class="fa fa-pencil-alt"></i> Edit</a>
                                <?php if (intval($contributor['status']) == 1): ?>
                                  <a class="dropdown-item block-btn" data-id="<?php echo $contributor['uuid']; ?>" href="#"><i class="fas fa-ban"></i>Block</a>
                                <?php endif; ?>
                                <?php if (intval($contributor['status']) == 0): ?>
                                  <a class="dropdown-item activate-btn" data-id="<?php echo $contributor['uuid']; ?>" href="#"><i class="fas fa-check-circle"></i>Activate</a>
                                <?php endif; ?>
                                  <a class="dropdown-item delete-btn" data-id="<?php echo $contributor['uuid']; ?>" href="#"><i class="fa fa-trash"></i> Delete</a>
                                </div>
                            </div>
                        </td>
                        
                      </tr>
                    <?php
                      }
                    ?>

                  </tbody>
                </table>
                </div>
          

            
          

          <!--end::Form-->
        </div>

        <!--end::Portlet-->
            

            

        <!--end: Datatable -->
      </div>
    </div>
  </div>

  <!-- end:: Content Body -->
</div>

<!-- end:: Content -->


<div class="modal" tabindex="-1" role="dialog" id="inviteModal">
  <?php
    require('invite_modal.php');
  ?>
</div>