


                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading"><?php echo $button_title; ?></div>
                            <div class="panel-body">
                                <?php if (isset($_SESSION['message'])) echo $_SESSION['message'];?>
                                <?php echo validation_errors('<p style="color: red" />'); ?>
                                <form method="POST" class="form-horizontal" action = "<?php echo base_url(); ?>Users/change_password" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Old Password: </label>
                                        <div class="col-sm-10">
                                            <input type="hidden" name = "id" class="form-control">
                                            <input type="password" required placeholder="Old Password" name = "old_pass" class="form-control">
                                        </div>
                                    </div>
                                    <div class="hr-dashed"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">New Password: </label>
                                        <div class="col-sm-10">
                                            <input type="password" required placeholder="New Password" name = "new_pass" class="form-control">
                                        </div>
                                    </div>
                                    <div class="hr-dashed"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Confirm Password: </label>
                                        <div class="col-sm-10">
                                            <input type="password" required placeholder="Confirm Password" name = "con_pass" class="form-control">
                                        </div>
                                    </div>
                                    <div class="hr-dashed"></div>

                                    <div class="hr-dashed"></div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-8">
                                            <button class="btn btn-primary" type="submit"><?php echo $button_title; ?></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>