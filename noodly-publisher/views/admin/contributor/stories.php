					<!-- begin:: Content -->
          <div class="k-content	k-grid__item k-grid__item--fluid k-grid k-grid--hor">

<!-- begin:: Content Head -->
<div class="k-content__head	k-grid__item">
  <h3 class="k-content__head-title">My Stories</h3>
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
              
              
              

              <a href="CONTRIBUTOR-add-story.html" class="btn btn-success">
                <i class="la la-pencil"></i> Add A Story
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
                        <th>Title</th>
                        <th>Posted</th>
                        <th>Views</th>
                        <th>Status</th>
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
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                <label class="form-check-label" for="defaultCheck1"></label>
                                </div>
                        </td>
                        <td><h5><a href="#"><?php echo $story['title'];?></a></h5></td>

                        <td><?php echo time_diff_format($story['created_at']); ?></td>
                        <td><?php echo number_k($story['visits']); ?></td>
                        <td>
                        <?php
                          switch ($story['status']) {
                            case 'DRAFT':
                              echo '<span class="badge badge-warning">DRAFT</span>';
                            break;
                            case 'PUBLISHED':
                              echo '<span class="badge badge-dark">PUBLISHED</span>';
                            break;
                          }
                        ?>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-outline-secondary dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-bars"></i> Actions
                                </button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                  <a class="dropdown-item" href="#"><i class="fa fa-pencil-alt"></i>Edit</a>
                                  <a class="dropdown-item" href="#"><i class="fa fa-trash"></i> Delete</a>
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