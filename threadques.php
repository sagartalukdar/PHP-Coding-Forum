
<?php 
include'partials/connection.php';
session_start();
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>

  </head>
  <body>
    <!-- include header -->
    <?php include 'partials/header.php'?>
 
    <?php 
    if(isset($_GET['thread_id'])) {
    $id=$_GET['thread_id'];
    }
    $sql="select * from `thread` where `thread_id`=$id;";
    $res=mysqli_query($con,$sql);
    while($row=mysqli_fetch_assoc($res)){
      $thread_user_id= $row['thread_user_id'];
      $sql2="select user_email from `user` where user_id=$thread_user_id;";
      $res2=mysqli_query($con,$sql2);
      $row2=mysqli_fetch_assoc($res2);
    ?>
    
    <div class="container">
       <div class="jumbotron p-5" style="background-color:#f2f8ff ">
        <h2 class="display-4"> <?php echo $row['thread_title'] ?> </h2>
        <p class="lead"><?php echo $row['thread_desc'] ?></p>
        <hr class="my-4">
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea nobis maiores in illum provident tenetur minus, autem debitis corporis voluptatum dolorum quas</p>
        <p><b><a>Posted by : <?php echo $row2['user_email'];?></a></b></p>
       </div>
    </div>
    
    <?php } ?>
 
    <?php 
     if($_SERVER['REQUEST_METHOD']=="POST"){
       $comment=$_POST['comment'];
       $uid=$_POST['userid'];
       $sql="insert into `comment` (`comment_content`,`thread_id`,`comment_by_user_id`) values
       ('$comment','$id','$uid');";
       if(mysqli_query($con,$sql)){
        echo "commented";
       }else echo "notc";
     }
    ?>
    <div class="container">
    <?php
    if(isset($_SESSION['loggedin']) && $_SESSION["loggedin"]==true){
    ?>  
      <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post">
       Comment: 
       <input type="text" name="comment">
       <input type="hidden" name="userid" value="<?php echo $_SESSION['id']?>">
       <button type="submit">submit</button>
      </form>
    <?php }else{?>
      <h2 ><i>please login first to continue</i></h2>

    <?php }?>


    </div>

    <div class="container" id="ques" style="min-height:400px">

    <h3 class="my-2">Discussion Here </h3>
 
    <?php  
       $sql="select * from `comment` where `thread_id`=$id;";
       $res=mysqli_query($con,$sql);
       while($row=mysqli_fetch_assoc($res)){
           $userid=$row['comment_by_user_id'];
           $sql2="select * from `user` where user_id=$userid;";
           $res2=mysqli_query($con,$sql2);
           $row2=mysqli_fetch_assoc($res2);

        echo '
        <div class="media my-3" >
        <img src="https://www.shutterstock.com/image-vector/user-profile-icon-vector-avatar-600nw-2247726673.jpg" alt="" height=80 px width=90px>
         <span><b>'. $row2['user_email'].'</b>: </span>
         <span> '. $row['comment_content'] .'</span>     
         
        </div>
        ';
       }
    ?>
 

    </div>

    <?php include 'partials/footer.php'?>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>