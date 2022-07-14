<?php
        session_start();
        
    require "links.php";
    $show_email = false;
    $show_pass = false;
    if (isset($_POST['submit'])) {
        $username = mysqli_real_escape_string($con, trim($_POST['username']));
        $email = mysqli_real_escape_string($con, trim($_POST['email']));
        $password = mysqli_real_escape_string($con, trim($_POST['password']));
        $cpassword = mysqli_real_escape_string($con, trim($_POST['cpassword']));
        $hashpass = password_hash($password, PASSWORD_BCRYPT);
        $hashcpass = password_hash($cpassword, PASSWORD_BCRYPT);
        $email_query = "select * from `signup`.`registration` where `registration`.`email`='$email'";
        $emailquery = mysqli_query($con, $email_query);
        $ans = mysqli_num_rows($emailquery);
        if ($ans > 0) {
            $_SESSION['signup']=false;
            $_SESSION['show_email']=true;
            $_SESSION['show_pass']=false;
            header('Location: signup.php');
        } else {
            if ($password === $cpassword) {
                $insert_query = "INSERT into `signup`.`registration`(`username`,`email`,`pass`,`cpass`) VALUES ('$username','$email','$hashpass','$hashcpass') ";
                $insertquery = mysqli_query($con, $insert_query);
                $_SESSION['signup']=true;
                $_SESSION['show_email']=false;
                $_SESSION['show_pass']=false;
                header('Location: thanks.php');
            } else {
                $_SESSION['signup']=false;
                $_SESSION['show_email']=false;
                $_SESSION['show_pass']=true;
                header('Location: signup.php');
            }
        }
    }
    ?>