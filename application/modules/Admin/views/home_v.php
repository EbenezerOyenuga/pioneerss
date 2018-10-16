

<div class="row">
<div class="col-md-12">
<div class="row">
  <div class="col-md-3">
    <div class="panel panel-default">
      <div class="panel-body bk-primary text-light">
        <div class="stat-panel text-center">
          <div class="stat-panel-number h1 "><?php echo $count_action_units; ?></div>
          <div class="stat-panel-title text-uppercase">Action Units</div>
        </div>
      </div>
      <a href="<?php echo base_url(); ?>ActionUnit/download" class="block-anchor panel-footer">Download Report <i class="fa fa-arrow-right"></i></a>
    </div>
  </div>
  <div class="col-md-3">
    <div class="panel panel-default">
      <div class="panel-body bk-success text-light">
        <div class="stat-panel text-center">
          <div class="stat-panel-number h1 "><?php echo $count_students; ?></div>
          <div class="stat-panel-title text-uppercase">Students</div>
        </div>
      </div>
      <a href="<?php echo base_url(); ?>Students/download" class="block-anchor panel-footer text-center">Download Report<i class="fa fa-arrow-right"></i></a>
    </div>
  </div>

</div>
</div>
</div>
