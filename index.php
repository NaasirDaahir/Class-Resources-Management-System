<?php
session_start();
$usertype = isset($_SESSION['type']) ? $_SESSION['type'] : 0;
if (isset($_SESSION['islogged'])) {
    if ($usertype == 1) {
        header("location:./public/dashboard");
    }
} else {
    header("location:./public/login.php");
}

?>
<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Class Resource Sharer</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Easily Access your class courses resource with furher search or delay" />


    <!-- Favicon icon -->
    <link rel="icon" href="./assets/images/favicon.ico" type="image/x-icon">
    <!-- fontawesome icon -->
    <link rel="stylesheet" href="./assets/fonts/fontawesome/css/fontawesome-all.min.css">
    <!-- animation css -->
    <link rel="stylesheet" href="./assets/css/animate.min.css">
    <!-- vendor css -->
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.min.css" />

    <link rel="stylesheet" href="./assets/css/mystyle.css">
</head>

<body>
    
    <div class="container py-3">
<header class="navbar pcoded-header navbar-expand-lg navbar-light">
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <div class="main-search">
                        <div class="input-group">
                            <input type="text" id="m-search" class="form-control" placeholder="Search . . .">
                            <a href="javascript:" class="input-group-append search-close">
                                <i class="feather icon-x input-group-text"></i>
                            </a>
                            <span class="input-group-append search-btn btn btn-primary">
                                <i class="feather icon-search input-group-text"></i>
                            </span>
                        </div>
                    </div>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li>
                    <div class="dropdown">
                        <a class="dropdown-toggle" href="javascript:" data-toggle="dropdown"><i
                                class="icon feather icon-bell"></i></a>
                        
                    </div>
                </li>
                <li>
                    <div class="dropdown drp-user">
                        <a href="javascript:" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <i class="icon feather icon-settings"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-notification">
                            <div class="pro-head">
                                <img src="./assets/images/logo.png" class="img-radius" alt="User-Profile-Image">
                                <span><?php echo $_SESSION['username'] ?></span>
                                <a href="javascript:" class="dud-logout lgout" title="Logout">
                                    <i class="feather icon-log-out"></i>
                                </a>
                            </div>
                            <ul class="pro-body">
    
                                <li><a href="javascript:" class="dropdown-item"><i class="feather icon-user"></i>
                                        Profile</a></li>
                                <li><a href="javascript:" class="dropdown-item"><i class="feather icon-mail"></i>Feedback</a></li>
                                <li><a href="javascript:" class="dropdown-item lgout"><i class="feather icon-log-out"></i>
                                        Log Out</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </header>
        <div class="row align-items-center">
            <div class="col-md-6 col-xl-4">
                <div class="card daily-sales">
                    <div class="card-block">
                        <h5 class="mb-4 text-center f-w-400 f-28" id="class-name">Class: CA181
                        </h5>
                        <hr>
                        <div class="row d-flex align-items-center justify-content-center">
                            <div class="col-9">
                                <h3 class="f-w-300 d-flex align-items-center m-b-0"><i
                                        class="fa fa-book-open text-c-green f-30 m-r-10"></i><span
                                        id="course-count"></span></h3>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
            <!--[ daily sales section ] end-->
            <!--[ Monthly  sales section ] starts-->
            <div class="col-md-6 col-xl-4">
                <div class="card Monthly-sales">
                    <div class="card-block">
                        <h5 class="mb-4 text-center f-w-400 f-28">Last upload date</h5>
                        <hr>
                        <div class="row d-flex align-items-center justify-content-center">
                            <div class="col-9">
                                <h3 class="f-w-300 d-flex align-items-center  m-b-0"><i
                                        class="feather icon-calendar text-c-red f-30 m-r-10"></i> <span id="ld"></span>
                                </h3>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
            <!--[ Monthly  sales section ] end-->
            <!--[ year  sales section ] starts-->
            <div class="col-md-12 col-xl-4">
                <div class="card yearly-sales">
                    <div class="card-block">
                        <h5 class="mb-4 text-center f-w-400 f-28">Select Course</h5>
                        <hr>
                        <div class="row d-flex align-items-center">
                            <div class="col-12 d-flex align-items-center">
                                <i class="fa fa-book text-c-green f-30 m-r-10"></i>
                                <select name="course" id="courses" class="form-control w-100 bg-white">
                                </select>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="card Recent-Users">
            <div class="card-header">
                <h5 id="t-card-title">Recent Resources</h5>
            </div>
            <div class="card-block px-0 py-3">
                <div class="table-responsive">
                    <table class="table table-hover" id="res">
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>



    </div>
    <script src="./assets/js/vendor-all.min.js"></script>
	<script src="./assets/js/bootstrap.min.js"></script>
    <script src="./assets/js/pcoded.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>

    <script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>
    <script src="./index.js"></script>
</body>

</html>