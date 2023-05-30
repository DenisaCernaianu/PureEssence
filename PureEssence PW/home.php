<?php 
@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
    header('location:login.php');
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>

<!-- font link-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

<!--admin css file link --> 
<link rel="stylesheet" href="style.css">

  <!-- custom js file link  -->
  <script src="script.js" defer></script>

</head>
<body>


<?php @include 'header.php'; ?>


<section class="home">


<div class="slide active" style="background: url(images/home-bg-3.png) no-repeat;">
        <div class="content">
            <span style="color: rgb(255, 255, 255)  !important;">The fragrance of Happiness</span>
            <h4>up to 50% off</h4>
            <a href="shop.php" class="btn">shop now</a>
        </div>
    </div>


    <div class="slide" style="background: url(images/home-bg-2.png) no-repeat;">
        <div class="content">
            <span style="color: rgb(255, 255, 255)  !important;">Life is beautiful.</span>
            <a href="shop.php" class="btn">shop now</a>
        </div>
    </div>

    <div class="slide " style="background: url(images/hpic1.jpg) no-repeat;">
        <div class="content">
            <span></span>
            <h3></h3>
            <a href="shop.php" class="btn">shop now</a>
        </div>
    </div>


    <div id="next-slide" onclick="next()" class="fas fa-angle-right"></div>
    <div id="prev-slide" onclick="prev()" class="fas fa-angle-left"></div>

   

</section>





<?php @include 'footer.php';?>

<script scr="script.js"></script>
    
</body>
</html>