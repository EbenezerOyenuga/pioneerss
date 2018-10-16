<!doctype html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Citizenship Grading System</title>
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
                <div class="col-md-6 col-md-offset-3">
                    <h1 class="text-center text-bold text-light mt-4x">Sign in</h1>
                    <div class="well row pt-2x pb-3x bk-light">
                        <?php echo validation_errors('<p style="color: red" />'); ?>
                        <?php if (isset($_SESSION['message']))echo $_SESSION['message'];?>
                        <div class="col-md-8 col-md-offset-2">
                            <form action="<?php echo base_url(); ?>Login/sign_in" class="mt" method="post">

                                <label for="" class="text-uppercase text-sm">Your Username or Email</label>
                                <input type="text" placeholder="Username" class="form-control mb" name="username">

                                <label for="" class="text-uppercase text-sm">Password</label>
                                <input type="password" placeholder="Password" class="form-control mb" name="password">

                                <button class="btn btn-primary btn-block" type="submit">LOGIN</button>

                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

</body>

</html>
