

                <div class="row">
                    <div class="col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-heading"><?php echo $button_title; ?></div>
                            <div class="panel-body">
                                <?php echo validation_errors('<p style="color: red" />'); ?>
                                <form method="POST" class="form-horizontal" action = "<?php echo base_url(); ?>Users/post_user/<?php echo $add_update; ?>" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Email: </label>
                                        <div class="col-sm-10">
                                            <input type="hidden" name = "id" class="form-control" value="<?php echo $id?>">
                                            <input type="email" required placeholder="Email Address" name = "email" class="form-control" value="<?php echo $email?>">
                                        </div>
                                    </div>
                                    <div class="hr-dashed"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Title</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" required name = "title">
                                                <option>Select Title:</option>
                                                <?php echo $title; ?>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="hr-dashed"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">First Name: </label>
                                        <div class="col-sm-10">
                                            <input type="text" required placeholder="First Name" name = "firstname" class="form-control" value="<?php echo $firstname?>">
                                        </div>
                                    </div>
                                    <div class="hr-dashed"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Surname</label>
                                        <div class="col-sm-10">
                                            <input type="text" required placeholder="Last Name" name = "surname" class="form-control" value="<?php echo $surname?>">
                                        </div>
                                    </div>
                                    <div class="hr-dashed"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Role:</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" required name = "role" id="roledd" onchange="change_role()">
                                                <option>Select Role:</option>
                                                <?php echo $role; ?>

                                            </select>

                                        </div>
                                    </div>
                                    <div class="hr-dashed"></div>

                                    <div class="form-group">
                                        <div id="residence">
                                        </div>
                                    </div>
                                    <div class="hr-dashed"></div>
                                    <div class="form-group">
                                        <div id="gender">
                                        </div>
                                    </div>
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
                    <div class="col-md-8">
                        <div class="panel panel-default">
                            <div class="panel-heading">Users</div>
                            <div class="panel-body">
                                <?php if (isset($_SESSION['message'])) echo $_SESSION['message'];?>
                                <table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                            if ($users_table !== "" )
                                            {
                                                echo $users_table;
                                            }
                                            else{
                                                ?>
                                            <tr>
                                                <td colspan="6"><center>No users to display</center></td>
                                            </tr>
                                            <?php } ?>
                                    </tbody>
                            </div>
                        </div>
                    </div>
                </div>



                <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>

                <script type="text/javascript">
                    function change_role() {
                        if (document.getElementById("roledd").value == 2){
                            var xmlhttp = new XMLHttpRequest();
                            xmlhttp.open("GET", "<?php echo base_url(); ?>Residence/create_user_select_residence?role="+document.getElementById("roledd").value, false);
                            xmlhttp.send(null);
                            document.getElementById("residence").innerHTML=xmlhttp.responseText;
                            document.getElementById("gender").innerHTML="";
                        }
                        else if (document.getElementById("roledd").value == 5){
                            var xmlhttp = new XMLHttpRequest();
                            xmlhttp.open("GET", "<?php echo base_url(); ?>Gender/create_user_select_gender?role="+document.getElementById("roledd").value, false);
                            xmlhttp.send(null);
                            document.getElementById("residence").innerHTML="";
                            document.getElementById("gender").innerHTML=xmlhttp.responseText;

                        }
                        else{
                            document.getElementById("residence").innerHTML="";
                            document.getElementById("gender").innerHTML="";
                        }
                    }

                    function change_subrole() {
                        if (document.getElementById("residencedd").value == 'OC'){
                            var xmlhttp = new XMLHttpRequest();
                            xmlhttp.open("GET", "<?php echo base_url(); ?>Gender/create_user_select_gender?role="+document.getElementById("residence").value, false);
                            xmlhttp.send(null);
                            document.getElementById("gender").innerHTML=xmlhttp.responseText;
                        }
                        else
                            document.getElementById("gender").innerHTML="";
                    }

                </script>
