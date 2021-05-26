<?php
session_start();
header("Content-Type:Application/Json");
include "../config/db.php";
extract($_POST);
$data = [];
$query = "CALL login_sp('$username','$password')";
$res = $conn->query($query);
if ($res) {
    $row = $res->fetch_assoc();
    if (isset($row['Message'])) {
        $data = array("status" => false, "message" => $row['Message']);
    } else {
        if($res->num_rows>0){
            $data = array("status" => true, "data" => $row);
        $_SESSION['islogged']=true;
        foreach ($row as $key => $value) {
            $_SESSION[$key] = $value;
        } 
        }
       
    }
} else {
    echo 'error';
}
echo json_encode($data)

?>
