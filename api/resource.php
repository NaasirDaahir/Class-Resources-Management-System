<?php
include "../config/db.php";
header("Content-Type:Application/json");
function getAllResources($conn){
   extract($_POST);
   $query="CALL getResouce($class_id)";
   $res=$conn->query($query);
   $response=[];
   $data=[];
   if ($res) {
      $rows=$res->num_rows;
      if($rows>0){
       while ($row=$res->fetch_assoc()) {
          $data[]=$row;
       }
       $response=array("status"=>true,"Data"=>$data);
      }
      else{
         $response=array("status"=>false,"Message"=>"No Data");
      }
         
   } else {
      $response=array("status"=>false,"Error"=>$res->error);
   }
   echo json_encode($response);
}
function getSpecificResource($conn){
   extract($_POST);
   $query=" CALL get_resource_specific_course($course_id)";
   $res=$conn->query($query);
   $response=[];
   $data=[];
   if ($res) {
      $rows=isset($res->num_rows);
      if($rows>0){
       while ($row=$res->fetch_assoc()) {
          $data[]=$row;
       }
       $response=array("status"=>true,"Data"=>$data);
      }
      else{
         $response=array("status"=>false,"Message"=>"No Data");
      }
         
   } else {
      $response=array("status"=>false,"Error"=>$res->error);
   }
   echo json_encode($response);
}
function getCourses($conn){
   extract($_POST);
   $query=" CALL getCourses($class_id)";
   $res=$conn->query($query);
   $response=[];
   $data=[];
   if ($res) {
      $rows=isset($res->num_rows);
    
      if($rows>0){

       while ($row=$res->fetch_assoc()) {
          $data[]=$row;
       }
       $response=array("status"=>true,"Data"=>$data);
      }
      else{
         $response=array("status"=>false,"Message"=>"No Data");
      }
         
   } else {
      $response=array("status"=>false,"Error"=>$res->error);
   }
   echo json_encode($response);
}

if (isset($_POST['action'])) {
   $_POST['action']($conn);
}

