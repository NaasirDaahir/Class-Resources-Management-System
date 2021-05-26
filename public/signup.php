<!DOCTYPE html>
<html lang="en">

<head>
    <title>Datta Able Free Bootstrap 4 Admin Template</title>
    <!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 10]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />


    <!-- Favicon icon -->
    <link rel="icon" href="../assets/images/favicon.ico" type="image/x-icon">

    <!-- vendor css -->
    <link rel="stylesheet" href="../assets/css/style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css">

</head>

<body>
    <div class="auth-wrapper">
        <div class="auth-content">
            <div class="auth-bg">
                <span class="r"></span>
                <span class="r s"></span>
                <span class="r s"></span>
                <span class="r"></span>
            </div>
            <div class="card">
                <div class="card-body text-center">
                    <div class="mb-4">
                        <i class="feather icon-user-plus auth-icon"></i>
                    </div>
                    <h3 class="mb-4">Sign up</h3>
                    <hr>
                    <div class="form-group text-left">
                        <h5 class="d-inline">I am :</h5>
                        <div class="float-right">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="user-student" name="usertype" class="custom-control-input"
                                    value="Student" checked="true">
                                <label class="custom-control-label" for="user-student">Student</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="user-lacturer" name="usertype" class="custom-control-input"
                                    value="Lecturer">
                                <label class="custom-control-label" for="user-lacturer">Lecturer</label>
                            </div>
                        </div>

                    </div>
                    <form method="POST" id="RegisterUser" encytype="multipart/form-data">
                        <div class="input-group my-3">
                            <input type="text" class="form-control" placeholder="ID" id="userid" name="userid">
                        </div>
                        <div class="input-group my-3">
                            <input type="text" class="form-control" placeholder="User Name" id="username"
                                name="username">
                        </div>
                        <div class="input-group my-3">
                            <input type="text" class="form-control" placeholder="Class" id="class" name="class">
                        </div>
                        <div class="input-group my-3">
                            <input type="password" class="form-control" placeholder="password" id="password"
                                name="password">
                        </div>
                        <div class="input-group my-3">
                            <input type="password" class="form-control" placeholder="confirm password" id="confpassword"
                                name="confpassword">
                        </div>




                        <!-- <div class="form-group text-left">
                        <div class="checkbox checkbox-fill d-inline">
                            <input type="checkbox" name="checkbox-fill-1" id="checkbox-fill-1" checked="">
                            <label for="checkbox-fill-1" class="cr">Show Password?</label>
                        </div>
                    </div> -->

                        <button class="btn btn-primary shadow-2 mb-4 w-50" type="submit">Sign up</button>
                    </form>
                    <p class="mb-0 text-muted">Allready have an account? <a href="./login"> Log in</a></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Required Js -->
    <script src="../assets/js/vendor-all.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../app.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>
</body>

</html>