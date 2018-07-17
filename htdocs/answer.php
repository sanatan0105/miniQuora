<?php 
require_once('php/connect.php');
require_once('php/function.php');

if(isset($_SESSION['user_id'])==false){
    header('Location: logout.php');
}

$user_id = $_SESSION['user_id'];


$question_id = test_input($_GET['qid']);

if($_POST){

if($_POST['comment_submit']){
    $time =time();
    $comment = test_input($_POST['comment']);
    if(empty($comment)){
        echo 'Comment field can not be empty';
    }
    else{
        $sql_insert_comment = mysqli_query($con,"INSERT INTO `ans` 
        (`id`,`qid`,`uid`,`answer`,`atime`) 
        VALUES 
        (NULL, $question_id, $user_id, '$comment', '$time')
        ");
        if($sql_insert_comment){
            echo 'Comment added';
        }
        else{
            echo mysqli_error($con);
        }
    }
    
}

}



?>

<html>
<?php 
require_once('include/header.php');
?>



<div style="margin-top: 50px;" class="container">

<div class="row">
    <div class="col s12">
        <div class="card white">
            <div class="card-content">
            
            <?php


            $sql_get_question_details = mysqli_query($con,"SELECT id, uid, title, description, entry_time from question where id = $question_id");
            $count_question = mysqli_num_rows($sql_get_question_details);
            if($count_question == 0){
                echo 'Question not found';
            }
            else{

                $row_get_question = mysqli_fetch_assoc($sql_get_question_details);
                 $question_id = $row_get_question['id'];
                 $title = $row_get_question['title'];
                 $description = $row_get_question['description'];
                 $entry_time = $row_get_question['entry_time'];
                
                 echo '<h3>'.$title.'</h3>';
                 echo '<h5>'.$description.'</h5>';
            }
            ?>
            <hr/>

            <ul class="collection">

              <?php 
                $sql_get_answer = mysqli_query($con,"SELECT * FROM `ans` WHERE `qid` = $question_id");
                $count_answer = mysqli_num_rows($sql_get_answer);
                if($count_answer == 0){
                    echo 'No answer found';
                }
                else{
                    while($row_get_ans = mysqli_fetch_assoc($sql_get_answer)){
                    $ans_id = $row_get_ans['id'];
                   $user_id_who_gave_answer = $row_get_ans['uid'];
                    $answer = $row_get_ans['answer'];
                    $atime = $row_get_ans['atime'];
                    ?>
                            
                    <li class="collection-item avatar">
                        <i class="material-icons circle blue">face</i>
                        <span class="title"><?php echo $answer; ?></span>
                        <p><?php echo $answer; ?> <br>
                            Answered By :- <?php echo $name_uploader = get_name_from_id($user_id_who_gave_answer);?>.
                        </p>
                    </li>

                <?php


                    }
                }
                
    ?>



            </ul>







                

           
            </div>
            
        </div>
    </div>
</div>

</div>


<div class="container">
<div class="input-field col s12">
<form action="" method="post">
<textarea id="textarea1" class="materialize-textarea" name="comment"></textarea>
<label for="textarea1">Enter your answer</label><br/><br><br>
<input class="btn waves-effect waves-light indigo darken-4" type="submit" name="comment_submit">
</form>
<br/><br><br>
</div>



</body>
</html>