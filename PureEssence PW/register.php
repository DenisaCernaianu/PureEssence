  <?php
  
  @include 'config.php';

  if(isset($_POST['submit'])){


    $filter_name = filter_var($_POST['name'],FILTER_SANITIZE_STRING);
    $name=mysqli_real_escape_string($conn, $filter_name);
    $filter_email = filter_var($_POST['email'],FILTER_SANITIZE_STRING);
    $email=mysqli_real_escape_string($conn, $filter_email);
    $filter_password = filter_var($_POST['password'],FILTER_SANITIZE_STRING);
    $password=mysqli_real_escape_string($conn, md5($filter_password));
    $filter_cpassword = filter_var($_POST['cpassword'],FILTER_SANITIZE_STRING);
    $cpassword=mysqli_real_escape_string($conn, md5($filter_cpassword));

    $select_users = mysqli_query($conn, "SELECT * FROM  `users` WHERE email='$email'") or die('qury failed');

    if(mysqli_num_rows($select_users)>0){
        $message[] = 'user already exist';}

        else{
            if($password != $cpassword ){
                $message[] = 'password not matched!';
            }else{
                mysqli_query($conn, "INSERT INTO `users` (name, email, password)  VALUES ('$name', '$email' , '$password') ") or die('quey failed');
                $message[] = 'you are registered!';
                header('location:login.php');
            }
        }
    
    }
    
  ?>
  
  <!DOCTYPE html>
  <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>register</title>

        <!-- font link-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

        <!--css file link --> 
        <link rel="stylesheet" href="style.css">
    </head>
    <body>



    <?php 
      if(isset($message)){
        foreach($message as $message){
            echo '
            <div class="message">
        <span>'.$message.'</span>
        <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
    </div>
       ';

        }
      }
    ?>

       <section class="form-container">

         <form  action="" method="post">
            <h3>register now</h3>
            <input type="text" name="name" class="box" placeholder="enter your username" required>
            <input type="email" name="email" class="box" placeholder="enter your email" required>
            <input type="password" name="password" class="box" placeholder="enter your password" required>
            <input type="password" name="cpassword" class="box" placeholder="confirm your password" required>
            <input type="submit" class="btn" name="submit" value="register now">
            <p>already have an account? <a href="login.php">login now</a></p>

         </form>    
       </section>

    </body>
  </html>