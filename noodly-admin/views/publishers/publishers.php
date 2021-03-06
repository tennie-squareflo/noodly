					<!-- begin:: Content -->
          <div class="k-content	k-grid__item k-grid__item--fluid k-grid k-grid--hor">

<!-- begin:: Content Head -->
<div class="k-content__head	k-grid__item">
  <h3 class="k-content__head-title">Publishers</h3>
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
            <a href="<?php echo BASE_URL;?>publishers/edit" class="btn btn-success">
              <i class="la la-pencil"></i> Add A Publisher
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
            <th>Contributors</th>
            <th>Stories</th>
            <th>Visits</th>
            <th>Subscribers</th>
            <th width=15%></th>
          </tr>
        </thead>
        <tbody>
          <?php
            foreach ($publishers as $publisher) {
              # code...
            ?>
            <tr>
              <td><h5><a href="http://<?php echo $publisher['domain'];?>.noodly.io/" target="_blank"><?php echo $publisher['name'];?></a></h5></td>
              <td><?php echo $publisher['contributors'];?></td>
              <td><?php echo $publisher['stories'];?></td>
              <td><?php echo $publisher['visits'];?></td>
              <td><span class="badge badge-warning"><?php echo $publisher['subscribers'];?></span></td>
              <td class="text-right" width="15%">
                <div class="btn-group" role="group">
                  <button id="btnGroupDrop1" type="button" class="btn btn-outline-secondary dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-bars"></i> Actions
                  </button>
                  <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                    <a class="dropdown-item" href="<?php echo BASE_URL.'publishers/edit/'.$publisher['pid'] ?>"><i class="fa fa-pencil-alt"></i>Edit</a>
                    <a class="dropdown-item delete-btn" href="#" data-id="<?php echo $publisher['pid'];?>"><i class="fa fa-trash"></i> Delete</a>
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