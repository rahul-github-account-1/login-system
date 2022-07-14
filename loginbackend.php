<?php
    session_start();
    require "links.php"; 
    $not_exist = false;
    $pass_incorr = false;
    if (isset($_POST['submit'])) {
        $entered_email = $_POST['email'];
        $entered_pass = $_POST['password'];
        $equery = "SELECT * from `registration` where `email`='$entered_email'";
        $emailquery = mysqli_query($con, $equery);
        $resrows = mysqli_num_rows($emailquery);
        if ($resrows > 0) {
            $row = mysqli_fetch_assoc($emailquery);
            $db_username = $row['username'];
            $db_pass = $row['pass'];
            $verifying = password_verify($entered_pass, $db_pass);
            if ($verifying) {
                $_SESSION['loggedin']=true;
                $_SESSION['not_exist']=false;
                $_SESSION['pass_incorr']=false;
                    $_SESSION['username']=$db_username;
                    header('Location: welcome.php');
            } 
            else {
                $pass_incorr = true;
                $not_exist=false;
                $_SESSION['pass_incorr']=true;
                $_SESSION['loggedin']=false;
                $_SESSION['not_exist']=false;
            }
        } else {
            
            $not_exist = true;
            $_SESSION['not_exist']=true;
            $_SESSION['loggedin']=false;
        }
        header('Location: welcome.php');

    }
?> 