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
    <title>contact</title>

    <!-- font link-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

<!--admin css file link --> 
<link rel="stylesheet" href="style.css">


</head>
<body>


<?php @include 'header.php'; ?>


<section class="heading">
    <h3>contact us</h3>
    <p><a href="home.php">home</a> / contact </p>
</section>



<section class="reviews" id="reviews">

    <h1 class="title"></h1>

    <div class="box-container">

        <div class="box">
        <p>Client Service Phone Line</p>
        <p> <i class="fas fa-phone"></i> +(40) 0755 198 166</p>
       
            
        </div>

        <div class="box">

        <p>Send us an email!</p>
        <p> <i class="fas fa-envelope"></i> info@pureessence.com </p>
           
        </div>

        <div class="box">
            
            <p>Follow us:</p>
    
           <p> <a href="#"><i class="fab fa-instagram"></i> instagram</a></p>
           
        </div>

       

       

    </div>

</section>




<?php @include 'footer.php';?>

<script src="script.js"></script>
    
</body>
</html>