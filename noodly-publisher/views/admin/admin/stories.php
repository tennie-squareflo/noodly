					<!-- begin:: Content -->
          <div class="k-content	k-grid__item k-grid__item--fluid k-grid k-grid--hor">

<!-- begin:: Content Head -->
<div class="k-content__head	k-grid__item">
  <h3 class="k-content__head-title">Stories</h3>
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
            
            <a class="btn btn-warning btn-delete-selected">
              <i class="la la-trash"></i> Delete Selected
            </a>
          </div>
            <div class="dropdown dropdown-inline">
            
              <a href="<?php echo BASE_URL;?>story/edit" class="btn btn-success" id="contributor-button-invite">
                <i class="la la-pencil"></i> <span class="hide-mobile">Add A Story</span> <span class="show-mobile">Add</span>
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
                        <th>Title</th>
                        <th class="hide-mobile">Contributor</th>
                        <th class="hide-mobile">Posted</th>
                        <th class="hide-mobile">Views</th>
                        <th class="hide-mobile">Status</th>
                        <th>&nbsp</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($stories as $key => $story) {
                    ?>
                      <tr>
                        
                        <td>
                              <div class="form-check">
                              <input class="form-check-input" id="defaultCheck_<?php echo $story['sid']; ?>" data-id="<?php echo $story['sid']; ?>" name="defaultCheck[]" type="checkbox" value="<?php echo $story['sid'];?>"> <label class="form-check-label" for="defaultCheck1"></label>
                                <label class="form-check-label" for="defaultCheck1"></label>
                                </div>
                        </td>
                        <td><h5><a href="<?php echo BASE_URL.'story/preview/'.$story['url'];?>" target="_blank"><?php echo $story['title'];?></a></h5></td>

                        <td class="hide-mobile">
                          <strong><a href="#"><?php echo $story['username']; ?></a></strong>
                        </td>

                        <td class="hide-mobile"><?php echo time_diff_format($story['created_at']); ?></td>
                        <td class="hide-mobile"><?php echo number_k($story['visits']); ?></td>
                        <td class="hide-mobile">
                        <?php
                          switch ($story['status']) {
                            case 'DRAFT':
                              echo '<span class="badge badge-warning">DRAFT</span>';
                            break;
                            case 'SUBMITTED':
                              echo '<span class="badge badge-info">SUBMITTED</span>';
                            break;
                            case 'CLIENT-DRAFT':
                              echo '<span class="badge badge-info">CLIENT-DRAFT</span>';
                            break;
                            case 'REJECTED':
                              echo '<span class="badge badge-danger">REJECTED</span>';
                            break;
                            case 'BLOCKED':
                              echo '<span class="badge badge-danger">BLOCKED</span>';
                            break;
                            case 'PUBLISHED':
                              echo '<span class="badge badge-success">PUBLISHED</span>';
                            break;
                          }
                        ?>
                        </td>
                        <td class="text-right" width="15%">
                            <div class="btn-group" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-outline-secondary dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-bars"></i> Actions
                                </button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                  <a class="dropdown-item" href="<?php echo BASE_URL.'story/edit/'.$story['sid'] ?>"><i class="fa fa-pencil-alt"></i>Edit</a>
                                  <?php if($story['status'] === 'BLOCKED') : ?>
                                    <a class="dropdown-item activate-btn" data-id="<?php echo $story['sid']; ?>"><i class="fa fa-check"></i>Activate</a>
                                  <?php endif; ?>
                                  <?php if($story['status'] === 'PUBLISHED') : ?>
                                    <a class="dropdown-item block-btn" data-id="<?php echo $story['sid']; ?>"><i class="fa fa-ban"></i>Block</a>
                                  <?php endif; ?>
                                  
                                  
                                  <a class="dropdown-item delete-btn" data-id="<?php echo $story['sid']; ?>"><i class="fa fa-trash"></i> Delete</a>
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