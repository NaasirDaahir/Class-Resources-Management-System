<?php
include "../config/db.php";
header("Content-Type:Application/json");
session_start();
function RegisterUser($conn){
    extract($_POST);
    $query = "";
    if ($type == 1) {
        $query = "CALL register_user($type,'$username','$password',null,null)";

    } else {
        $query = "CALL register_user($type,'$username','$password','$userid','$class')";

    }
    $res = $conn->query($query);

    $response = [];
    if ($res) {
        $rows = isset($res->num_rows);
        if ($rows > 0) {
            $row = $res->fetch_assoc();
            if ($row['Message'] == "lecturer") {
                $response = array("status" => true, "Message" => "Lecturer Account Saved Successfully");
            } elseif ($row['Message'] == "student") {
                $response = array("status" => true, "Message" => "Student Account Saved Successfully");
            } 
             elseif ($row['Message'] == "username or ID taken") {
                $response = array("status" => true, "Message" => "Username or Your ID  Already Taken");
            } 
            elseif ($row['Message'] == "not found") {
                $response = array("status" => false, "Message" => "Class Not Found");
            }

        } else {
            $response = array("status" => false, "Message" => "Errrror");
        }

    } else {
        $response = array("status" => false, "Message" => $res);
    }
    echo json_encode($response);
}

function fillClasses($conn){

    $query = "SELECT `id`, `Name`,instructor FROM `classes`";

    $res = $conn->query($query);
    $data = [];
    $response = [];
    if ($res) {
        if (($res->num_rows) > 0) {

            while ($row = $res->fetch_assoc()) {
                $ins = explode(",", $row["instructor"]);
                $t_id=$_SESSION['id'];
                if (!in_array($t_id, $ins)) {
                    $data[] = $row;
                }

            }
            $response = array("status" => true, "data" => $data);
        } else {
            $response = array("status" => false, "Message" => "not found");
        }

    } else {
        $response = array("status" => false, "Message" => $res);
    }
    echo json_encode($response);
}
function LoadClasses($conn){

    $query = "SELECT `id`, `Name`,instructor FROM `classes`";

    $res = $conn->query($query);
    $data = [];
    $response = [];
    if ($res) {
        if (($res->num_rows) > 0) {

            while ($row = $res->fetch_assoc()) {
                $t_id=$_SESSION['id'];
                $ins = explode(",", $row["instructor"]);
                if (in_array($t_id, $ins)) {
                    $data[] = $row;
                }

            }

            $response = array("status" => true, "data" => $data);
        } else {
            $response = array("status" => false, "Message" => "not found");
        }

    } else {
        $response = array("status" => false, "Message" => $res);
    }
    echo json_encode($response);
}
function createJoinClass($conn){
    extract($_POST);
    $tid = $_SESSION['id'];
    $query = "CALL registerClass('$name','$tid','$coursename','$type')";
    $res = $conn->query($query);
    $response = [];
    if ($res) {
        if (($res->num_rows) > 0) {
            $row = $res->fetch_assoc();
            $data = "";
            if ($row['Message'] == "joined") {
                if(!is_dir("../Resources/$classname")){
                    mkdir("../Resources/$classname");
                }
                if (!is_dir("../Resources/$classname/$coursename")) {
                    if(mkdir("../Resources/$classname/$coursename")){
 $response = array("status" => true, "Message" => "You Succesfuly Joined");
                    }
                   
                }
                else{
                    $response = array("status" => false, "Message" => "This Course already assigned for this class");
                }
               
            } elseif ($row['Message'] == "Class Exist") {
                $response = array("status" => false, "Message" => "You cannot Create This Class Becouse Already Exist");
            } elseif ($row['Message'] == "registered&joined") {
                mkdir("../Resources/$name");
                if (mkdir("../Resources/$name/$coursename")) {
                    $response = array("status" => true, "Message" => "You Succesfully created and joined");
                }
            }

        } else {
            $response = array("status" => false, "Message" => "not found");
        }

    } else {
        $response = array("status" => false, "Message" => $res);
    }
    echo json_encode($response);
}
function getcourses($conn){
    $class_id=$_SESSION['Class'];
    $query = "SELECT courses.id,courses.Name,classes.Name 'class' FROM courses INNER JOIN classes on courses.class=classes.Id WHERE classes.id=$class_id";

    $res = $conn->query($query);
    $data = [];
    $response = [];
    if ($res) {
        if (($res->num_rows) > 0) {

            while ($row = $res->fetch_assoc()) {   
                    $data[] = $row;
            }
            $response = array("status" => true, "data" => $data);
        } else {
            $response = array("status" => false, "Message" => "not found");
        }

    } else {
        $response = array("status" => false, "Message" => $res);
    }
    echo json_encode($response);
}
function getResource($conn){
  
    $class_id=$_SESSION['Class'];
    extract($_POST);
    $query = "CALL getCResouce($class_id,$course)";

    $res = $conn->query($query);
    $data = [];
    $response = [];
    if ($res) {
        if (($res->num_rows) > 0) {

            while ($row = $res->fetch_assoc()) {   
                    $data[] = $row;
            }
            $response = array("status" => true, "data" => $data);
        } else {
            $response = array("status" => false, "Message" => "not found");
        }

    } else {
        $response = array("status" => false, "Message" => $res);
    }
    echo json_encode($response);
}
function getSiCResource($conn){
  
    
    $class_id=$_SESSION['class'];
    $tid=$_SESSION['id'];
    $query = "SELECT resource.Name,resource.Date from resource
    INNER JOIN courses
    on courses.id=resource.courseid
    WHERE courses.instructor = $tid and courses.class=$class_id";

    $res = $conn->query($query);
    $data = [];
    $response = [];
    if ($res) {
        if (($res->num_rows) > 0) {

            while ($row = $res->fetch_assoc()) {   
                    $data[] = $row;
            }
            $response = array("status" => true, "data" => $data);
        } else {
            $response = array("status" => false, "Message" => "not found");
        }

    } else {
        $response = array("status" => false, "Message" => $res);
    }
    echo json_encode($response);
}
function getInstructorCourses($conn){
    $tid=$_SESSION['id'];
    $query = "SELECT courses.Name,classes.Name'class'  FROM courses
    INNER JOIN classes 
    on courses.class=classes.Id
    WHERE courses.instructor=$tid";

    $res = $conn->query($query);
    $data = [];
    $response = [];
    if ($res) {
        if (($res->num_rows) > 0) {

            while ($row = $res->fetch_assoc()) {
                
                    $data[] = $row;
                

            }

            $response = array("status" => true, "data" => $data);
        } else {
            $response = array("status" => false, "Message" => "not found");
        }

    } else {
        $response = array("status" => false, "Message" => $res);
    }
    echo json_encode($response); 
}
if (isset($_POST['action'])) {
    $_POST['action']($conn);
    //fillClasses($conn)
}
