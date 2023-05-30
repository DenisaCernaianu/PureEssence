<?php 
@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
    header('location:login.php');
}

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    mysqli_query($conn,"DELETE FROM `wishlist` WHERE id='$delete_id'") or  die('query failed');
    header('location:wishlist.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>wishlist</title>

    <!-- font link-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

<!--admin css file link --> 
<link rel="stylesheet" href="style.css">

</head>
<body>


<?php @include 'header.php'; ?>

<section class="heading-w">
<h1 class="title">wishlist</h1>
</section>

<section  class="wishlist">
<div class="box-container">

<?php
$select_wishlist =mysqli_query($conn,"SELECT * FROM `wishlist` WHERE user_id = '$user_id'") or die('failed');
if(mysqli_num_rows($select_wishlist)>0){
    while($fetch_wishlist = mysqli_fetch_assoc($select_wishlist)){

?>
<form action="" method="POST" class="box">
  <p><a href="view_page.php?pid=<?php echo $fetch_wishlist['pr_id'];?>">see details</a></p>
       <div class = "price">$<?php echo $fetch_wishlist['pret'];?></div>
       <img src="uploaded_images/<?php echo $fetch_wishlist['imag'];?>"alt="" class="image">
       <div class="name"><?php echo $fetch_wishlist['nume'];?></div>
       <a href="wishlist.php?delete=<?php echo $fetch_wishlist['id']; ?>" class="delete-btn" onclick="return confirm('delete this from your wishlist?');">Delete from wishlist</a>
       <input type="hidden" name="product_id" value="<?php echo $fetch_wishlist['id'];?>">
       <input type="hidden" name="product_name" value="<?php echo $fetch_wishlist['nume'];?>">
       <input type="hidden" name="product_price" value="<?php echo $fetch_wishlist['pret'];?>">
       <input type="hidden" name="product_image" value="<?php echo $fetch_wishlist['imag'];?>">



</form>
<?php

}

}else{
    print '<p class="empty">no favourite products added yet</p>';
}

?>

</div>
</section>

<?php @include 'footer.php';?>

<script src="script.js"></script>
    
</body>
</html>