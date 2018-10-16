
<div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">Update System Requirements</div>
                            <div class="panel-body">
                                <?php echo validation_errors('<p style="color: red" />'); ?>
                                <?php if (isset($_SESSION['success'])) {?>
                                    <div class="alert alert-success">
                                        <?php  echo $_SESSION['success'];?>
                                    </div>
                                <?php } ?>
                                <form method="POST" class="form-horizontal" action = "<?php echo base_url(); ?>Requirements/update_requirements" enctype="multipart/form-data">

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Maximum Number of Students Required: </label>
                                        <div class="col-sm-10">
                                            <input type="number" placeholder="Maximum Number of Students Required per Unit" name = "max_number" class="form-control" value="<?php echo $max_number ?>">
                                        </div>
                                    </div>
                                    <div class="hr-dashed"></div>

                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <button class="btn btn-primary" type="submit">Update Requirements</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

</div>
