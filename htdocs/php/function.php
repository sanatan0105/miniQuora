<?php 
require_once('connect.php');
function test_input($data) {
    global $con;
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    mysqli_real_escape_string($con,$data);
    return $data;
  }


function get_name_from_id($id){
  global $con;
  $sql = mysqli_query($con,"SELECT `name` FROM `user` WHERE `id` = $id");
  $count = mysqli_num_rows($sql);
  if($count==0){
    return 0;
  }
  else{
    $row = mysqli_fetch_assoc($sql);
    return $name = $row['name'];
  }
}



?>