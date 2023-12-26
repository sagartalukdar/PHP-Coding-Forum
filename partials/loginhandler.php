<?php
include 'connection.php';
$err="";
if($_SERVER['REQUEST_METHOD']=='POST'){
    $email=$_POST['loginemail'];
    $pass=$_POST['loginpassword'];
    
    $existsql="select * from `user` where `user_email`='$email'";
    $res=mysqli_query($con,$existsql);
    $num=mysqli_num_rows($res);
    if($num==1){
        $row=mysqli_fetch_assoc($res);
        if(password_verify($pass,$row['user_password'])){
            session_start();
            $_SESSION['loggedin']=true;
            $_SESSION['id']=$row['user_id'];
            $_SESSION['username']=$email;
            
        }
        header("Location:/codingforum/index.php");
    }
}
?>