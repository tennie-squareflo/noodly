					<!-- begin:: Content -->
          <div class="k-content	k-grid__item k-grid__item--fluid k-grid k-grid--hor">

<!-- begin:: Content Head -->
<div class="k-content__head	k-grid__item">
  <h3 class="k-content__head-title">Admins</h3>
</div>

<!-- end:: Content Head -->

<!-- begin:: Content Body -->
<div class="k-content__body	k-grid__item k-grid__item--fluid" id="k_content_body">
    
    <div class="k-portlet k-portlet--mobile">
      <div class="k-portlet__head">
        <div class="k-portlet__head-label">
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
        <div class="k-portlet__head-toolbar">
          <div class="k-portlet__head-toolbar-wrapper">
            <div class="dropdown dropdown-inline">
              <a class="btn btn-danger btn-delete-selected">
                <i class="la la-trash"></i> Block Selected
              </a>
            </div>
            <div class="dropdown dropdown-inline">
              <a class="btn btn-success" data-toggle="modal" data-target="#inviteModal">
                <i class="fa fa-paper-plane"></i> Invite An Admin
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="k-portlet__body">

          <!--begin::Portlet-->
      
            
              
                <table class="table table-head-noborder table-striped">
                  <thead>
                    <tr>
                      
                        <th>&nbsp</th>
                        <th>Name</th>
                        <th>Email Address</th>
                        <th>Status</th>
                        <th>&nbsp;</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      foreach ($admins as $key => $admin) {
                    ?>
                      <tr>
                        <td>
                          <div class="form-check">
                            <input class="form-check-input" id="defaultCheck_<?php echo $admin['uuid']; ?>" data-id="<?php echo $admin['uuid']; ?>" name="defaultCheck[]" type="checkbox" value="<?php echo $admin['uuid'];?>"> <label class="form-check-label" for="defaultCheck1"></label>
                            <label class="form-check-label" for="defaultCheck1"></label>
                          </div>
                        </td>
                        <td><h5><a href="#"><?php echo $admin['username'];?></a></h5></td>
                        <td><?php echo $admin['email'];?></td>
                        <td><?php 
                          echo intval($admin['status']) == 0 
                                ? '<span class="badge badge-warning">Suspended</span>' 
                                : (intval($admin['status']) == 1 
                                  ? '<span class="badge badge-success">Active</span>' 
                                  : (intval($admin['status']) >= time() 
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
                                <?php if (intval($admin['status']) > 1): ?>
                                  <a class="dropdown-item invite-btn" data-id="<?php echo $admin['uuid']; ?>" href="#"><i class="fa fa-paper-plane"></i>Send Invitation</a>
                                <?php endif; ?>
                                <!-- <a class="dropdown-item edit-btn" data-id="<?php echo $admin['uuid']; ?>" href=" href="<?php echo BASE_URL.'users/edit/'.$admin['uuid'] ?>><i class="fa fa-pencil-alt"></i> Edit</a> -->
                                <?php if (intval($admin['status']) == 1): ?>
                                  <a class="dropdown-item block-btn" data-id="<?php echo $admin['uuid']; ?>" href="#"><i class="fas fa-ban"></i>Block</a>
                                <?php endif; ?>
                                <?php if (intval($admin['status']) == 0): ?>
                                  <a class="dropdown-item activate-btn" data-id="<?php echo $admin['uuid']; ?>" href="#"><i class="fas fa-check-circle"></i>Activate</a>
                                <?php endif; ?>
                                  <a class="dropdown-item delete-btn" data-id="<?php echo $admin['uuid']; ?>" href="#"><i class="fa fa-trash"></i> Delete</a>
                                </div>
                            </div>
                        </td>
                        
                      </tr>
                    <?php
                      }
                    ?>

                  </tbody>
                </table>
          

            
          

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