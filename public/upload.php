<?php

include "../config/db.php";
session_start();

$cid = $_SESSION['class'];
    $lid = $_SESSION['id'];

    $query = "call courseinfo($cid,$lid)";

    $res = $conn->query($query);
    if ($res) {
        $classinfo = $res->fetch_assoc();
    }

include "../config/db.php";

$classname = $classinfo['name'];
$coursename = $classinfo['course name'];
$file = $_FILES['file'];

$dir = "../Resources/$classname/$coursename/" . $file['name'];

if (move_uploaded_file($file['tmp_name'], $dir)) {

    $filename = $file['name'];
    $courseid =$classinfo['course id'];
    $dir = "./Resources/$classname/$coursename/" . $file['name'];
    $sql = "call registerResource('$filename','$dir',$courseid)";

    echo $sql;
    $res = $conn->query($sql);
    if ($res) {
        $info = $res->fetch_assoc();
        print_r($info);
    } else {
        print_r($res);
        echo "error";
    }

}
