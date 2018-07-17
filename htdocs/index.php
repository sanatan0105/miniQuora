<?php 
require('php/connect.php');

if(isset($_SESSION['user_id'])){
    header('Location: home.php');
}
?>

<!DOCTYPE html>
  <html>
    <head>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>

    <body style=' background-image: url("img/login-background.jpg");     /* Full height */
    height: 100%; 

    /* Center and scale the image nicely */
    background-position: center;
    background-repeat: no-repeat;' >

        <div class="container" style="margin-top: 5%;">
            <div class="row">
                <div class="col s12">
                    <div class="card blue-grey darken-1">
                    <div class="card-content white-text">
                        <center><span class="card-title">Welcome to Miniquora</span>
                        <p>Select a user to proceed</p></center></center>
                        <div id="userList">
                            <ul class="collection black-text">
                                <?php 
                                $sql_get_users = mysqli_query($con,"SELECT * FROM `user` WHERE 1");
                                $count = mysqli_num_rows($sql_get_users);
                                if($count==0){
                                    echo 'No user found';
                                }
                                else{
                                    while($row_get_users = mysqli_fetch_assoc($sql_get_users)){
                                        $id = $row_get_users['id'];
                                        $name = $row_get_users['name'];
                                    
                                        ?>
                                            <li class="collection-item avatar">
                                                <i class="material-icons circle blue">face</i>
                                                <span class="title"><?php echo $name; ?></span>
                                                <?php 
                                                    $sql_get_tag = mysqli_query($con,"SELECT tag from tags where id in (select tag_id from usertag where user_id = $id)");
                                                    $tag_count = mysqli_num_rows($sql_get_tag);
                                                    if($tag_count==0){
                                                        echo '<p>No tag has been added for this user</p>';
                                                    }
                                                    else{
                                                        echo '<p>';
                                                        while($row_get_tags = mysqli_fetch_assoc($sql_get_tag)){
                                                            echo $row_get_tags['tag'];
                                                            echo '<br>';
                                                        }
                                                        echo '</p>';
                                                    }

                                                ?>
                                                <!--Need to encrypt the id-->
                                               
                                                <a href="login.php?id=<?php echo $id;?> " class="secondary-content"><i class="material-icons">arrow_forward</i></a>
                                            </li>
                                        <?php 
                                    }
                                }
                                ?>
                                
                            </ul>
                        </div>
                        
                        

                    </div>
                    <div class="card-action">
                        <a href="#">Just a demo</a>
                    </div>
                    </div>
                </div>
            </div>
                             
        </div>



      <script type="text/javascript" src="js/materialize.min.js"></script>
    </body>
  </html>