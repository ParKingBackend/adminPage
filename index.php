
<div id="fashion">



<?php 
$message="";
if(isset($_POST['login'])){
    

$username =   $_POST['username'];
$password =   $_POST['password'];



     if($username != $db_username && $password != $db_password ){
        $message="Nav ievadīts pareizi!"; }
        // header("Location: login.php");

     if($username == "admin" && $password == "admin"){


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
                            <button class = "btn btn-success" name="login" type="submit">Log in</button>
                        </span>
                    </div>
                    <br>
                    </form><!--search form-->
                    <!-- /.input-group -->
                </div>
</div>
</div>
</div>