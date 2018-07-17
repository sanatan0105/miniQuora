<?php 
require('php/connect.php');
require('php/function.php');
$user_id = $_SESSION['user_id'];
$name = get_name_from_id($user_id);
?>

<?php 
require_once('php/connect.php');

if(isset($_SESSION['user_id'])==false){
    header('Location: logout.php');
}
?>

<!DOCTYPE html>
  <html>
    <?php 
    require('include/header.php');
    ?>
<div class="container-fluid" style=" background: linear-gradient(to right, #000428 , #004e92);">
       <div class="container white-text" >
           <br>
            <div class="row">
                <div class="col s2"></div>
                <div class="col s8">
                    <div class="row">
                        <div class="col s5">
                            <img src="img/hi.png" alt="" width="70" height="70" style="margin-left:50%; margin-top: 30px;"/>
                        </div>
                        <div class="col s7">
                            <h2><?php echo $name; ?></h2>
                        </div>
                    </div>
                    <center><h1 >Welcome!</h1></center>
                    <br/>
                    
                </div>
                <div class="col s2"></div>

            </div> 
            <center><p>You can ask any question! Just click the below button to start find the solution for your problem.</p>

                <a href="add.php" class="btn waves-effect waves-light indigo darken-4">Ask a question
                    <i class="material-icons right">send</i>
                </a>
            </center>
            <br/><br><br>
        </div>
</div>


<div style="margin-top: 50px;" class="container">

    <div class="row">
        <div class="col s12">
            <div class="card white">
                <div class="card-content">
                
                <?php 
                    $sql_get_questions = mysqli_query($con,"select question.id, question.uid, question.title, question.description, question.entry_time from question INNER JOIN q_tag on question.id = q_tag.qid WHERE q_tag.tagid IN (SELECT tagid from usertag where user_id = $user_id) AND question.uid != $user_id ");
                    $count = mysqli_num_rows($sql_get_questions);
                    if($count == 0){
                       echo  '<span class="card-title">We don\'t have any questions for you. Add some more tags in your profile to get questions.</span>';
                    }
                    else{
                        
                        echo '<span class="card-title">We have some questions for you.</span>';
                        echo '<ul class="collection">';
                        while($row = mysqli_fetch_assoc($sql_get_questions)){
                            $qid = $row['id'];
                        $uploader_id = $row['uid'];
                        $title = $row['title'];
                        $descr = $row['description'];
                        $qtime = $row['entry_time'];
                        $qtime = strtotime($qtime);
                        $qtime = date("Y/m/d H:i:s", $qtime);
                            ?>
                            
                                <li class="collection-item avatar">
                                    <i class="material-icons circle blue">face</i>
                                    <span class="title"><?php echo $title; ?></span>
                                    <p><?php echo $descr; ?> <br>
                                        Asked By :- <?php echo $name_uploader = get_name_from_id($uploader_id);?>                                    </p>
                                    <a href="answer.php?qid=<?php echo $qid;?> " class="secondary-content"><i class="material-icons">arrow_forward</i></a>
                                </li>

                            <?php
                            
                            
                        }
                        echo '</ul>';

                    }
                    
                ?>
                


               
                </div>
                
            </div>
        </div>
    </div>

</div>



<div style="margin-top: 50px;" class="container">

<div class="row">
    <div class="col s12">
        <div class="card white">
            <div class="card-content">
            
            <?php 
            $sql_get_questions_asked = mysqli_query($con,"SELECT id FROM question where uid = $user_id");
            $question_count = mysqli_num_rows($sql_get_questions_asked);
            if($question_count==0){
                echo  '<span class="card-title">You haven\'t added any question yet. </span>';
            }
            else{
                echo  '<span class="card-title">Answer to your questions.</span>';

                $sql_get_answer = mysqli_query($con,"SELECT * FROM `ans` WHERE `qid` IN (SELECT `id` FROM `question` WHERE `uid` = $user_id)");
                $count = mysqli_num_rows($sql_get_answer);
                if($count==0){
                    echo  '<span class="card-title">No one has answered to your question yet. </span>';
                }
                else{
                    echo '<span class="card-title">We have some answers for you.</span>';
                    while($row=mysqli_fetch_assoc($sql_get_answer)){
                        
                        echo '<ul class="collection">';
                        $aid = $row['id'];
                        $qid = $row['qid'];
                        $uid = $row['uid'];
                        $answer = $row['answer'];
                        $atime = $row['atime'];

                        $sql = mysqli_query($con,"SELECT * FROM `question` WHERE `id` = $qid");
                        $row = mysqli_fetch_assoc($sql);

                        $qid = $row['id'];
                        $uploader_id = $row['uid'];
                        $title = $row['title'];
                        $descr = $row['description'];
                        $qtime = $row['entry_time'];
                        $qtime = strtotime($qtime);
                        ?>
                            
                            <li class="collection-item avatar">
                                <i class="material-icons circle blue">face</i>
                                <span class="title"><?php echo $title; ?></span>
                                <p><?php echo $answer; ?> <br>
                                    Answered By :- <?php echo $name_uploader = get_name_from_id($uploader_id);?>.
                                </p>
                                <a href="answer.php?qid=<?php echo $qid;?> " class="secondary-content"><i class="material-icons">arrow_forward</i></a>
                            </li>

                        <?php


                    }
                }


            }
            ?>
            


           
            </div>
            
        </div>
    </div>
</div>

</div>



        
        <hr/>Answers to your questions
        <?php 
            
        ?>

      <script    type="text/javascript" src="js/materialize.min.js"></script>
    </body>
  </html>