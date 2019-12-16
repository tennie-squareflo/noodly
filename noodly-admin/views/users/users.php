					<!-- begin:: Content -->
          <div class="k-content	k-grid__item k-grid__item--fluid k-grid k-grid--hor">

<!-- begin:: Content Head -->
<div class="k-content__head	k-grid__item">
  <h3 class="k-content__head-title">Users</h3>
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
            
          <a class="btn btn-primary"  data-toggle="modal" data-target="#inviteModal">
              <i class="fa fa-paper-plane"></i> Invite A User
          </a>
          <a href="<?php echo BASE_URL;?>users/edit" class="btn btn-success">
              <i class="la la-pencil"></i> Add A User
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
                      <th>Name</th>
                      <th>Email</th>
                      <th>Role</th>
                      <th>Publishers</th>
                      <th>Status</th>
                      <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    foreach ($users as $user) {
                      # code...
                    ?>
                    <tr>
                      <td><h5><?php echo $user['name'];?></h5></td>
                      <td><?php echo $user['email'];?></td>
                      <td><?php echo $user['role'];?></td>
                      <td><?php
                        // Option 1: Display the first letter of the publisher.
                        // foreach ($user['publishers'] as $key => $publisher) {
                        //   echo "<div class='rounded-circle letter-image type-".(intval($publisher['pid'])%14 + 1)."' title='".$publishers[$publisher['pid']]['name']."'>".strtoupper($publishers[$publisher['pid']]['name'][0])."</div>";
                        // }
                        // if ($user['publishers_count'] > 5) {
                        //   echo " +".(intval($user['publishers_count']) - 5);
                        // }

                        // Option 2: Display the logo of each publisher.
                        foreach ($user['publishers'] as $key => $publisher) {
                          $style = intval($publisher['status']) == 0 
                                  ? 'no' 
                                  : (intval($publisher['status']) == 1 
                                    ? intval($publisher['pid'])%10 + 1 
                                    : (intval($publisher['status']) > time() 
                                      ? 'invited'
                                      : 'expired'));
                          $tooltip = intval($publisher['status']) == 0 
                                    ? 'No' 
                                    : (intval($publisher['status']) == 1 
                                      ? 'Active' 
                                      : (intval($publisher['status']) > time() 
                                        ? 'Invited'
                                        : 'Invite Expired'));
                          echo "<img class='logo-images type-$style'' src='".ASSETS_URL."media/logos/".$publishers[$publisher['pid']]['logo']."' title='".$publishers[$publisher['pid']]['name'].": $tooltip'/>";
                        }
                        if ($user['publishers_count'] > 5) {
                          echo " +".(intval($user['publishers_count']) - 5);
                        }
                      ?></td>
                      <td>
                      <?php 
                        echo intval($user['status']) == 0 
                              ? 'No' 
                              : (intval($user['status']) == 1 
                                ? 'Active' 
                                : (intval($user['status']) >= time() 
                                  ? 'Invite Sent' 
                                  : 'Invite Expired'));
                      ?>
                      </td>
                      <td>
                            <div class="btn-group" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-outline-secondary dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-bars"></i> Actions
                                </button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                  <a class="dropdown-item" href="<?php echo BASE_URL.'users/edit/'.$user['uuid'] ?>"><i class="fa fa-pencil-alt"></i>Edit</a>
                                  <a class="dropdown-item delete-btn" data-id="<?php echo $user['uuid'];?>"><i class="fa fa-trash"></i> Delete</a>
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
  </div>
</div>
</div>
</div>	<!-- end:: Content Body -->
</div> <!-- end:: Content -->

<div class="modal" tabindex="-1" role="dialog" id="inviteModal">
  <?php
    require('invite_modal.php');
  ?>
</div>