<?php include "db.php"; ?>
<div id="fashion">



<?php 
$message="";
if(isset($_POST['login'])){
    

$username =   $_POST['username'];
$password =   $_POST['password'];

$username = mysqli_real_escape_string($connection, $username);
$password = mysqli_real_escape_string($connection, $password);

$query = "SELECT * FROM clients WHERE username = '{$username}'";
$select_user_query = mysqli_query($connection, $query);
if(!$select_user_query){

    die("QUERY FAILED". mysqli_error($connection));

}


    while($row = mysqli_fetch_array($select_user_query)){

        $db_username = $row['username'];
        $db_password = $row['password'];


    }

     if($username != $db_username && $password != $db_password ){
        $message="Nav ievadīts pareizi!"; }
        // header("Location: login.php");

     if($username == $db_username && $password == $db_password){


        $_SESSION['username'] = $db_username;

        $message="";
        sleep(1);
         header("Location: admin/mainPage.php");
        
    }
      else{
        $message = "Laukumi nevar būt tukši!";
          header("Location: index.php");
          
     }
   

}


?>





<meta name="viewport" content="width=device-width, initial-scale=1.0">

<div class="form-wrap">
  <!-- Login -->
  <!-- <div class="well"> -->
      <div class="spacelog">
      <div class="col-xs-4 col-xs-offset-4">
      <h4 class=text-center><?php echo $message; ?></h4>
      <br>
                    <h5>Autorizēties</h5>
                    <br>
                    <br>
                    <form action="index.php" method="post">
                    <div class="form-group">
                    
                        <input name="username" type="text" class="form-control" placeholder="Ievadiet jūsu lietotājvārdu">
                        
                    </div>
                    <div class="input-group">
                        <input name="password" type="password" class="form-control" placeholder="Ievadiet jūsu paroli">
                        <span class="input-group-btn">
                            <button class = "btn btn-success" name="login" type="submit">Pieslēgties</button>
                        </span>
                    </div>
                    <br>
                    <a href="forgot.php?forgot=<?php echo uniqid(true); ?>">Aizmirsāt paroli?</a>
                    </form><!--search form-->
                    <!-- /.input-group -->
                </div>
</div>
</div>
</div>