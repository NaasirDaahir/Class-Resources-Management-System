<?php
session_start();
$usertype = isset($_SESSION['type']) ? $_SESSION['type'] : 0;
if (isset($_SESSION['islogged'])) {
    if (!($usertype == 1)) {
        header("location:./login.php");
    }
} else {
    header("location:./login.php");
}
?>
<?php include "./includes/head.php";?>
<!-- [ Pre-loader ] End -->
<?php include "./includes/header.php";?>
<!-- [ navigation menu ] start -->
<?php include "./includes/sidebar.php";?>
<!-- [ navigation menu ] end -->

<!-- [ Header ] start -->

<!-- [ Header ] end -->

<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <div class="pcoded-content">
            <div class="pcoded-inner-content">
                <!-- [ breadcrumb ] start -->

                <!-- [ breadcrumb ] end -->
                <div class="main-body">
                    <div class="page-wrapper">

                        <!-- [ Main Content ] start -->
                        <div class="row">
                            <!--[ daily sales section ] start-->
                            <div class="col-md-6 col-xl-4">
                                <div class="card daily-sales rounded">
                                    <div class="card-block">
                                        <h6 class="mb-4">Classes</h6>
                                        <div class="row d-flex align-items-center">
                                            <div class="col-9">
                                                <h3 class="f-w-300 d-flex align-items-center m-b-0"><i
                                                        class="feather icon-home text-c-green f-30 m-r-10"></i><span
                                                        id="class-count" class="text-bold">0</span></h3>
                                            </div>

                                        </div>
                                        <div class="progress m-t-30" style="height: 7px;">
                                            <div class="progress-bar progress-c-theme" role="progressbar"
                                                style="width: 100%;" aria-valuenow="50" aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--[ daily sales section ] end-->
                            <!--[ Monthly  sales section ] starts-->
                            <div class="col-md-6 col-xl-4">
                                <div class="card Monthly-sales rounded">
                                    <div class="card-block">
                                        <h6 class="mb-4">Last Upload</h6>
                                        <div class="row d-flex align-items-center">
                                            <div class="col-9">
                                                <h3 class="f-w-300 d-flex align-items-center  m-b-0"><i
                                                        class="feather icon-calendar text-c-red f-30 m-r-10"></i>Today
                                                </h3>
                                            </div>

                                        </div>
                                        <div class="progress m-t-30" style="height: 7px;">
                                            <div class="progress-bar progress-c-theme2" role="progressbar"
                                                style="width: 100%;" aria-valuenow="35" aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--[ Monthly  sales section ] end-->
                            <!--[ year  sales section ] starts-->
                            <!-- <div class="col-md-12 col-xl-4">
                                <div class="card yearly-sales rounded">
                                    <div class="card-block">
                                        <h6 class="mb-4">Yearly Sales</h6>
                                        <div class="row d-flex align-items-center">
                                            <div class="col-9">
                                                <h3 class="f-w-300 d-flex align-items-center  m-b-0"><i
                                                        class="feather icon-arrow-up text-c-green f-30 m-r-10"></i>$
                                                    8.638.32</h3>
                                            </div>
                                            <div class="col-3 text-right">
                                                <p class="m-b-0">80%</p>
                                            </div>
                                        </div>
                                        <div class="progress m-t-30" style="height: 7px;">
                                            <div class="progress-bar progress-c-theme" role="progressbar"
                                                style="width: 100%;" aria-valuenow="70" aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <!--[ year  sales section ] end-->
                            <!--[ Recent Users ] start-->
                            <div class="col-xl-8 col-md-6">
                                <div class="card Recent-Users">
                                    <div class="card-header">
                                        <h5>Recent Users</h5>
                                    </div>
                                    <div class="card-block px-0 py-3">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <tbody>
                                                    <tr class="unread">
                                                        <td><img class="rounded-circle" style="width:40px;"
                                                                src="../assets/images/user/avatar-1.jpg"
                                                                alt="activity-user"></td>
                                                        <td>
                                                            <h6 class="mb-1">Isabella Christensen</h6>
                                                            <p class="m-0">Lorem Ipsum is simply…</p>
                                                        </td>
                                                        <td>
                                                            <h6 class="text-muted"><i
                                                                    class="fas fa-circle text-c-green f-10 m-r-15"></i>11
                                                                MAY 12:56</h6>
                                                        </td>
                                                        <td><a href="#!"
                                                                class="label theme-bg2 text-white f-12">Reject</a><a
                                                                href="#!"
                                                                class="label theme-bg text-white f-12">Approve</a></td>
                                                    </tr>
                                                    <tr class="unread">
                                                        <td><img class="rounded-circle" style="width:40px;"
                                                                src="../assets/images/user/avatar-2.jpg"
                                                                alt="activity-user"></td>
                                                        <td>
                                                            <h6 class="mb-1">Mathilde Andersen</h6>
                                                            <p class="m-0">Lorem Ipsum is simply text of…</p>
                                                        </td>
                                                        <td>
                                                            <h6 class="text-muted"><i
                                                                    class="fas fa-circle text-c-red f-10 m-r-15"></i>11
                                                                MAY 10:35</h6>
                                                        </td>
                                                        <td><a href="#!"
                                                                class="label theme-bg2 text-white f-12">Reject</a><a
                                                                href="#!"
                                                                class="label theme-bg text-white f-12">Approve</a></td>
                                                    </tr>
                                                    <tr class="unread">
                                                        <td><img class="rounded-circle" style="width:40px;"
                                                                src="../assets/images/user/avatar-3.jpg"
                                                                alt="activity-user"></td>
                                                        <td>
                                                            <h6 class="mb-1">Karla Sorensen</h6>
                                                            <p class="m-0">Lorem Ipsum is simply…</p>
                                                        </td>
                                                        <td>
                                                            <h6 class="text-muted"><i
                                                                    class="fas fa-circle text-c-green f-10 m-r-15"></i>9
                                                                MAY 17:38</h6>
                                                        </td>
                                                        <td><a href="#!"
                                                                class="label theme-bg2 text-white f-12">Reject</a><a
                                                                href="#!"
                                                                class="label theme-bg text-white f-12">Approve</a></td>
                                                    </tr>
                                                    <tr class="unread">
                                                        <td><img class="rounded-circle" style="width:40px;"
                                                                src="../assets/images/user/avatar-1.jpg"
                                                                alt="activity-user"></td>
                                                        <td>
                                                            <h6 class="mb-1">Ida Jorgensen</h6>
                                                            <p class="m-0">Lorem Ipsum is simply text of…</p>
                                                        </td>
                                                        <td>
                                                            <h6 class="text-muted f-w-300"><i
                                                                    class="fas fa-circle text-c-red f-10 m-r-15"></i>19
                                                                MAY 12:56</h6>
                                                        </td>
                                                        <td><a href="#!"
                                                                class="label theme-bg2 text-white f-12">Reject</a><a
                                                                href="#!"
                                                                class="label theme-bg text-white f-12">Approve</a></td>
                                                    </tr>
                                                    <tr class="unread">
                                                        <td><img class="rounded-circle" style="width:40px;"
                                                                src="../assets/images/user/avatar-2.jpg"
                                                                alt="activity-user"></td>
                                                        <td>
                                                            <h6 class="mb-1">Albert Andersen</h6>
                                                            <p class="m-0">Lorem Ipsum is simply dummy…</p>
                                                        </td>
                                                        <td>
                                                            <h6 class="text-muted"><i
                                                                    class="fas fa-circle text-c-green f-10 m-r-15"></i>21
                                                                July 12:56</h6>
                                                        </td>
                                                        <td><a href="#!"
                                                                class="label theme-bg2 text-white f-12">Reject</a><a
                                                                href="#!"
                                                                class="label theme-bg text-white f-12">Approve</a></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--[ Recent Users ] end-->

                            <!-- [ statistics year chart ] start -->
                            <div class="col-xl-4 col-md-6">
                                <div class="card card-event rounded">
                                    <div class="card-block">
                                        <div class="row align-items-center justify-content-center">
                                            <div class="col">
                                                <h5 class="m-0">Total Downloads</h5>
                                            </div>

                                        </div>
                                        <h2 class="mt-3 f-w-300">45<sub class="text-muted f-14">downloads</sub></h2>
                                        <h6 class="text-muted mt-4 mb-0">All Courses</h6>
                                        <i class="feather icon-download text-c-blue f-50"></i>
                                    </div>
                                </div>
                                
                            </div>
                            

                        </div>
                        <!-- [ Main Content ] end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- [ Main Content ] end -->

<div class="modal" id="RegisterclassModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title">Join Or Create Class</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="class-register">
                    <div class="input-group">
                        <select name="classname" id="classname" class="form-control"></select>
                        <div class="input-group-append">
                            <p class="input-group-text border-0 bg-white">Or</p>
                            <Button class="btn btn-primary btn-square" type="button" id="add-new">Add New</Button>
                        </div>
                    </div>
                    <div class="form-group my-2 d-none new-class">
                        <input type="text" name="classname1" placeholder="Class Name" class="form-control"
                            id="classname1">
                    </div>
                    <div class="form-group my-2">
                        <input type="text" name="coursename" placeholder="Course Name" class="form-control"
                            id="coursename">
                    </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success btn-square">Save</button>
                </form>
                <button type="button" class="btn btn-outline-dark btn-square" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Required Js -->
<?php include "./includes/footer.php";?>