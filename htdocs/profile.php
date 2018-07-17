<?php 
require_once('php/connect.php');
require_once('php/function.php');

if(isset($_SESSION['user_id'])==false){
    header('Location: logout.php');
}

$user_id = $_SESSION['user_id'];


if($_POST){
    $tag = test_input($_POST['tag']);

    $time =time();


    if(empty($tag)){
        echo 'All fields are required';
    }
    else{
        
        $sql_insert_tag =mysqli_query($con,"INSERT INTO `usertag` VALUES (NULL, $tag, $user_id)");
        if($sql_insert_tag){
            echo 'Question added successfully.';
        }
        else{
            echo 'Something went wrong! Please try after sometime.';
        }
    }
    
}
?>

<html>
<?php 

?>
Add a tag in your profile
<form action="" method="post">
Tag: <select name="tag">
        <?php 
        $sql = mysqli_query($con,"SELECT * FROM `tags` WHERE 1");
        while($row = mysqli_fetch_assoc($sql)){
            $tag_id = $row['id'];
            $tag = $row['tag'];
            ?>
            <option value="<?php echo $tag_id?>"><?php echo $tag; ?></option>
            <?php 
        }
        ?>
        
    </select>
<input type="submit">
</form>

</body>
</html>