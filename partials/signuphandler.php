<?php

include 'connection.php';
$err="";
if($_SERVER['REQUEST_METHOD']=='POST'){
    $email=$_POST['signupemail'];
    $pass=$_POST['signuppassword'];
    $cpass=$_POST['confirmsignuppassword'];

    $existsql="select * from `user` where `user_email`='$email'";
    $res=mysqli_query($con,$existsql);
    $numrow=mysqli_num_rows($res);
    if($numrow>0){
        $err= "email allready use";
    }else{
        if($pass==$cpass){
           $hash=password_hash($pass,PASSWORD_DEFAULT);
           $sql="insert into `user` (`user_email`,`user_password`) values ('$email','$hash');";
           $res=mysqli_query($con,$sql);
           if($res){
            header("Location: /codingforum/index.php?signupsuccess=true");
            exit();
           }
        }else{
            $err= "please enter same password as confirm password";
        }
    }
    header("Location:/codingforum/index.php?signupsuccess=false&error=$err");
}

?>