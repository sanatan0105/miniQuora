<?php 
require('php/connect.php');
require_once('php/function.php');
//get the user id
// validate it
// and store in session

if($_GET){
    $user_id = $_GET['id'];
    //$user_id = test_input($user_id);

    $sql_check = mysqli_query($con,"SELECT `id` FROM `user` WHERE `id` = '$user_id'");
    $row = mysqli_fetch_assoc($sql_check);

    $count = mysqli_num_rows($sql_check);

    if($count == 1){
        $_SESSION['user_id'] = $user_id;
        header('Location: home.php');
    }
    else{
        echo 'Invalid User';
    }

}
else{
    echo 'Unauthorized access!';
}


?>