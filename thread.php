
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
    if(isset($_GET['id'])) {
    $id=$_GET['id'];
    }
    $sql="select * from `category` where `category`.`id`=$id;";
    $res=mysqli_query($con,$sql);
    while($row=mysqli_fetch_assoc($res)){
     
    ?>
    
    <div class="container">
       <div class="jumbotron p-5" style="background-color:wheat">
        <h2 class="display-4">Welcome to <?php echo $row['category_name'] ?> forum</h2>
        <p class="lead"><?php echo $row['category_description'] ?></p>
        <hr class="my-4">
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea nobis maiores in illum provident tenetur minus, autem debitis corporis voluptatum dolorum quas</p>
        <a class="btn btn-primary btn-lg mb-4" href="" role="button">Learn more..</a>
       </div>
    </div>
    
    <?php } ?>

    <?php 
      if($_SERVER['REQUEST_METHOD']=="POST"){
        $title=$_POST['title'];
        $desc=$_POST['description'];
        $uid=$_POST['userid'];
        $sql="insert into `thread` (`thread_title`,`thread_desc`,`thread_cat_id`,`thread_user_id`)values
        ('$title','$desc','$id','$uid');";
        if(mysqli_query($con,$sql)){
          echo ' thread inserted';
        }else echo  "not inserted";
      }
    ?>

    <div class="container" id="ques">
      
    <?php
    if(isset($_SESSION['loggedin']) && $_SESSION["loggedin"]==true){
    ?>  
      <h2 ><i>Ask your Query</i></h2>     
      <form action="<?php echo $_SERVER['REQUEST_URI']?>" class="my-4" method="post">
        
        <div class="mb-3">
          <label for="title" class="form-label">Thread title</label>
          <input type="text" class="form-control" name="title" aria-describedby="tt">
          <div id="tt" class="form-text">Add your forum title before post your Query.</div>
        </div>
        <div class="mb-3">
          <label for="description" class="form-label">Thread description</label>
          <input type="text" class="form-control" name="description">
        </div>
          <input type="hidden" name="userid" value="<?php echo $_SESSION['id']?>">
        <button type="submit" class="btn btn-success">Post</button>
      </form>
    <?php }else{?>
      <h2 ><i>Ask your Query:please login first to continue</i></h2>

    <?php }?>
     <h3 class="text-center my-2">Browse Questions</h3>
    <?php 
      if(isset($_GET['id'])){
        $id=$_GET['id'];
      }
        $sql="select * from `thread` where `thread_cat_id`=$id;";
        $res=mysqli_query($con,$sql);
        $forums=false;
        while($row=mysqli_fetch_assoc($res)){
          $forums=true;
          $thread_user_id= $row['thread_user_id'];
          $sql2="select user_email from `user` where user_id=$thread_user_id;";
          $res2=mysqli_query($con,$sql2);
          $row2=mysqli_fetch_assoc($res2);
    ?>

     
      <div class="media my-3" >
        <img src="https://www.shutterstock.com/image-vector/user-profile-icon-vector-avatar-600nw-2247726673.jpg" alt="" height=80 px width=90px>
        <span><b><?php echo $row2['user_email'];?></b></span>   
        <div class="media-body">
            <h5 class="mt-0">
             <a href="/codingforum/threadques.php?thread_id=<?php echo $row['thread_id'] ?>"><?php echo $row['thread_title'] ?></a> 
            </h5>
              <?php echo $row['thread_desc'] ?>
           </div>
      </div>
  
    <?php } ?>

    <?php 
        if(!$forums){
          echo '<h4 class="text-center"><i>No Forums Yet!</i></h4>';
        }
    ?>

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