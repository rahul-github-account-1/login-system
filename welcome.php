<?php 
    session_start();
    if(!isset($_SESSION['loggedin'])||$_SESSION['loggedin']!=true){
        header('Location: login.php');
    }

?>
<?php
    require "links.php";
    require "connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  
    <title><?php echo "welcome ".$_SESSION['username'] ?></title>
</head>
<body>
            <h1>Hello <?php echo $_SESSION['username']?></h1>
            <div class="container">
                <a class="btn btn-primary " href="logout.php" >Log Out</a>
            </div>
</body>
</html>