

                <div class="row">
                    <div class="col-md-5">
                        <div class="panel panel-default">
                            <div class="panel-heading"><?php echo $button_title; ?></div>
                            <div class="panel-body">
                                <?php echo validation_errors('<p style="color: red" />'); ?>
                                <form method="POST" class="form-horizontal" action = "<?php echo base_url(); ?>ActionUnit/post_action_units/<?php echo $add_update; ?>" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Action Unit Name: </label>
                                        <div class="col-sm-10">
                                            <input type="hidden" name = "id" class="form-control" value="<?php echo $id?>">
                                            <input type="text" required placeholder="Action Unit Name" name = "action_unit" class="form-control" value="<?php echo $action_unit?>">
                                        </div>
                                    </div>
                                    <div class="hr-dashed"></div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Coordinators Name: </label>
                                        <div class="col-sm-10">
                                            <input type="text" required placeholder="Coordinators Name" name = "coordinator" class="form-control" value="<?php echo $coordinator?>">
                                        </div>
                                    </div>
                                    <div class="hr-dashed"></div>

                                    <input type="file" name="coordinator_pics">

                                    <div class="hr-dashed"></div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <button class="btn btn-primary" type="submit"><?php echo $button_title; ?></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="panel panel-default">
                            <div class="panel-heading">Action Units</div>
                            <div class="panel-body">
                                <?php if (isset($_SESSION['message'])) echo $_SESSION['message'];?>
                                <table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Action Unit</th>
                                        <th>Coordinator</th>
                                        <th>Coordinator Pic</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Action Unit</th>
                                        <th>Coordinator</th>
                                        <th>Coordinator Pic</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                            if ($action_units_table !== "" )
                                            {
                                                echo $action_units_table;
                                            }
                                            else{
                                                ?>
                                            <tr>
                                                <td colspan="6"><center>No users to display</center></td>
                                            </tr>
                                            <?php } ?>
                                    </tbody>
                                  </table>
                            </div>
                        </div>
                    </div>
                </div>


                                <div class="row" id="students">
                                  <?php if(isset($students)){ ?>
                                  <div class="col-md-12">
                                      <div class="panel panel-default">
                                          <div class="panel-heading">Users</div>
                                          <div class="panel-body">
                                              <?php if (isset($_SESSION['message'])) echo $_SESSION['message'];?>
                                              <table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                                                  <thead>
                                                  <tr>
                                                      <th>S/N</th>
                                                      <th>Matric. No.</th>
                                                      <th>Name</th>
                                                      <th>Email Address</th>
                                                      <th>Phone</th>
                                                      <th>Program</th>
                                                      <th>Residence</th>

                                                  </tr>
                                                  </thead>
                                                  <tfoot>
                                                  <tr>
                                                    <th>S/N</th>
                                                    <th>Matric. No.</th>
                                                    <th>Name</th>
                                                    <th>Email Address</th>
                                                    <th>Phone</th>
                                                    <th>Program</th>
                                                    <th>Residence</th>
                                                  </tr>

                                                  </tfoot>
                                                  <tbody>
                                                      <?php
                                                          if ($students != "" )
                                                          {
                                                              echo $students;
                                                          }
                                                          else{
                                                              ?>
                                                          <tr>
                                                              <td colspan="6"><center>No users to display</center></td>
                                                          </tr>
                                                          <?php } ?>
                                                  </tbody>
                                                </table>
                                          </div>
                                      </div>
                                  </div>
                                  <?php } ?>
                                </div>
