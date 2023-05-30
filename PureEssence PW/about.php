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
    <title>about</title>

    <!-- font link-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

<!--admin css file link --> 
<link rel="stylesheet" href="style.css">

</head>
<body>


<?php @include 'header.php'; ?>


<section class="heading">
    <h3>about us</h3>
    <p> <a href="home.php">home</a> / about </p>
</section>

<section class="about">

    
    <div class="flex">

        <div class="image">
            <img src="images/about-3.jpg" alt="">
        </div>

        <div class="content">
            <h3>who we are?</h3>
            <p>At PureEssence we are constantly pushing the boundaries of the world of e-commerce and we are here for our customers every step of the way. We offer an extensive range of products combined with availability, technology and consistently amazing prices. Anyone can feel their best with just the right products that will suit their personal needs the best and make the selection in a simple way.
            </p>
     <p> Accessible means: </p>

    <li>User-friendly website</li>
<li>  Excellent customer service</li>
<li>Reliable and fast delivery </li>
<li>Always affordable prices</li>
<li>Surprisingly affordable</li>
<li>Innovative tools and technologies</li>

<p>Our mission is to make our portfolio accessible to every customer in every moment of their life. At PureEssence we know that there are many different reasons, occasions and feelings that affect selection and usage of products for personal need. As we believe everybody is unique, we want to give each and every one of our customers the right tools to make the best choice possible.</p>
            <a href="#reviews" class="btn">clients reviews</a>
        </div>

    </div>

</section>

<section class="reviews" id="reviews">

    <h1 class="title">reviews</h1>

    <div class="box-container">

        <div class="box">
            <img src="images/pic-1.jpg" alt="">
            <p>I love your services and my perfume, Good Girl smells amaizing.</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <h3>Monica L.</h3>
        </div>

        <div class="box">
            <img src="images/pic-2.jfif" alt="">
            <p>I bought two perfumes Nomade and La vie est belle and they both smell great.</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Lara M.</h3>
        </div>

        <div class="box">
            <img src="images/Rpic-3.jfif" alt="">
            <p>My wife loves your perfumes.Thank you for services!</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <h3>James J.</h3>
        </div>

       

       

    </div>

</section>











<?php @include 'footer.php'; ?>

<script src="script.js"></script>

</body>
</html>