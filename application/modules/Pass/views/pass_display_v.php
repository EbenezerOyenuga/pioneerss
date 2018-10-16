

                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading"><?php echo $passmark_title; ?></div>
                            <div class="panel-body">

                                <form method="POST" class="form-horizontal" action = "<?php echo base_url(); ?>Pass/update_passmarks" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <?php echo form_error('passmark_chapel'); ?>
                                        <label class="col-sm-2 control-label">Chapel Seminar: </label>
                                        <div class="col-sm-10">
                                            <input type="text" name = "passmark_chapel" class="form-control" value="<?php echo $passmark_chapel ?>">
                                        </div>
                                    </div>
                                    <div class="hr-dashed"></div>
                                    <div class="form-group">
                                        <?php echo form_error('passmark_residence'); ?>
                                        <label class="col-sm-2 control-label">Residence: </label>
                                        <div class="col-sm-10">
                                            <input type="number" placeholder="Residence" name = "passmark_residence" class="form-control" value="<?php echo $passmark_residence ?>">
                                        </div>
                                    </div>
                                    <div class="hr-dashed"></div>
                                    <div class="form-group">
                                        <?php echo form_error('passmark_worship'); ?>
                                        <label class="col-sm-2 control-label">Worship</label>
                                        <div class="col-sm-10">
                                            <input type="number" placeholder="Worship" name = "passmark_worship" class="form-control" value="<?php echo $passmark_worship ?>">
                                        </div>
                                    </div>
                                    <div class="hr-dashed"></div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <button class="btn btn-primary" type="submit"><?php echo $passmark_title; ?></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
