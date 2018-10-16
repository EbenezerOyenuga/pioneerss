<!doctype html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Pioneer Action Unit Registeration</title>
    <!-- Sandstone Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
    <!-- Admin Stye -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<div class="login-page bk-img" style="background-image: url(images/pioneer.JPG);">
    <div class="form-content">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <h1 class="text-center text-bold text-light mt-4x">Pioneer Action Unit Registration</h1>
                    <div class="well row pt-2x pb-3x bk-light">
                        <?php echo validation_errors('<p style="color: red" />'); ?>
                        <?php if (isset($_SESSION['message']))echo $_SESSION['message'];?>
                        <?php if (isset($_SESSION['success'])) {?>
                            <div class="alert alert-success">
                                <?php  echo $_SESSION['success'];?>
                            </div>
                        <?php } ?>

                            <form action="<?php echo base_url(); ?>Register/store" class="mt" method="post">
                              <div class="row">
                              <div class="col-md-4 col-md-offset-1">

                                <label for="" class="text-uppercase text-sm">Matric. No.</label>
                                <input type="text" placeholder="Matriculation Number" class="form-control mb" name="matricno">
                              </div>
                              </div>
                              <div class="row">
                              <div class="col-md-4 col-md-offset-1">
                                <label for="" class="text-uppercase text-sm">Surname</label>
                                <input type="text" placeholder="Surname" class="form-control mb" name="surname">
                              </div>
                              <div class="col-md-4 col-md-offset-1">
                                <label for="" class="text-uppercase text-sm">Other Names</label>
                                <input type="text" placeholder="Other Names" class="form-control mb" name="other_names">
                              </div>
                              <div class="col-md-4 col-md-offset-1">
                                <label for="" class="text-uppercase text-sm">Email Address</label>
                                <input type="email" placeholder="Email Address" class="form-control mb" name="email">
                              </div>
                              <div class="col-md-4 col-md-offset-1">
                                <label for="" class="text-uppercase text-sm">Phone Number</label>
                                <input type="tel" placeholder="Phone Number" class="form-control mb" name="phone">
                              </div>
                              <div class="col-md-4 col-md-offset-1">
                                <label for="" class="text-uppercase text-sm">Program:</label>
                                        <select class="form-control mb" name = "program">
                                            <option>Select Program:</option>
                                            <?php echo $program; ?>

                                        </select>
                                </div>
                                <div class="col-md-4 col-md-offset-1">
                                <label for="" class="text-uppercase text-sm">Residence:</label>
                                        <select class="form-control mb" name = "residence">
                                            <option>Select Residence:</option>
                                            <?php echo $residence; ?>

                                        </select>
                                </div>
                                <div class="col-md-4 col-md-offset-1">
                                  <label for="" class="text-uppercase text-sm">Birth Month:</label>
                                          <select class="form-control mb" name = "birthmonth">
                                              <option>Select Month:</option>
                                              <?php echo $months ; ?>

                                          </select>
                                  </div>
                                  <div class="col-md-4 col-md-offset-1">
                                    <label for="" class="text-uppercase text-sm">Birth Day:</label>
                                    <input type="number" placeholder="Your day of birth" class="form-control mb" name="birthday" min="1" max="31">
                                  </div>
                              </div>
                                <?php echo $action_units; ?>
                                <button class="btn btn-primary btn-block" type="submit">SIGN UP</button>

                            </form>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

</body>

</html>
