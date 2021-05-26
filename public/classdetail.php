<?php

session_start();

$_SESSION['class']=$_GET['class_id'];

include "./includes/head.php";
include "./includes/sidebar.php";
include "./includes/header.php";
?>

<div class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <div class="pcoded-content">
            <div class="pcoded-inner-content">
                <!-- [ breadcrumb ] start -->

                <!-- [ breadcrumb ] end -->
                <div class="main-body">
                    <div class="page-wrapper">
                        <!-- <div class="d-flex w-50 m-auto align-items-center">
                            <h5 class="w-35">Select Course</h5>
                            <select class="form-control form-control-sm">
                                <option value="4"> Php and Mysql </option>
                                <option value="1"> Flutter </option>
                            </select>
                        </div> -->
                        <div class="my-2">
                            <form enctype="multipart/form-data" action="./upload.php" class="dropzone shadow bg-white"
                                id="my-awesome-dropzone">

                            </form>
                            <button class="btn btn-primary m-3 mx-auto d-block w-50 f-20" id="uploadbtn">
                                <i class="fa fa-upload"></i>
                                Upload Files</button>
                        </div>
                        <div class="row">
                            <div class="col-xl-12 col-md-12">
                                <div class="card Recent-Users">
                                    <div class="card-header">
                                        <h5>Recent Uploads</h5>
                                    </div>
                                    <div class="card-block px-0 py-3">
                                        <div class="table-responsive">
                                            <table class="table table-hover" id="classsIns">
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>






<?php
include "./includes/footer.php";
?>