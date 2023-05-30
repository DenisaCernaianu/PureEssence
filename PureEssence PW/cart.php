<?php 
@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
    header('location:login.php');
}

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    mysqli_query($conn,"DELETE FROM `cos` WHERE id='$delete_id'") or  die('query failed');
    header('location:cart.php');
}

if(isset($_POST['update_quantity'])){
    $cart_id = $_POST['cart_id'];
    $cart_quantity = $_POST['cart_quantity'];
    mysqli_query($conn, "UPDATE `cos` SET cantitate = '$cart_quantity' WHERE id = '$cart_id'") or die('query failed');
    $message[] = 'cart quantity updated!';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cart</title>

    <!-- font link-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

<!--admin css file link --> 
<link rel="stylesheet" href="style.css">

</head>
<body>


<?php @include 'header.php'; ?>

<section class="heading-w">
<h1 class="title">your shopping cart</h1>
</section>


<section  class="cart">
<div class="box-container">

<?php
$total = 0;
$select_cart =mysqli_query($conn,"SELECT * FROM `cos` WHERE user_id = '$user_id'") or die('failed');
if(mysqli_num_rows($select_cart)>0){
    while($fetch_cart = mysqli_fetch_assoc($select_cart)){

?>
<form action="" method="POST" class="box">
  <p><a href="view_page.php?pid=<?php echo $fetch_cart['pr_id'];?>">see details</a></p>
       <div class = "price">$<?php echo $fetch_cart['pret'];?></div>
       <img src="uploaded_images/<?php echo $fetch_cart['imag'];?>"alt="" class="image">
       <div class="name"><?php echo $fetch_cart['nume'];?></div>
       <a href="cart.php?delete=<?php echo $fetch_cart['id']; ?>" class="delete-btn" onclick="return confirm('delete this from your cart?');">Delete</a>
       <form action="" method="post">
         <input type="hidden" value="<?php echo $fetch_cart['id'];?>" name="cart_id">
         <input type="number" min="1" value="<?php echo $fetch_cart['cantitate'];?>"  name="cart_quantity" class="qty">
         <input type="submit" value="update" name="update_quantity" class="option-btn">
         
       <div class="sub-total"> sub-total : <span><?php echo $sub_total = ($fetch_cart['pret'] * $fetch_cart['cantitate']); ?>$</span></div>
       </form>
       <input type="hidden" name="product_id" value="<?php echo $fetch_cart['id'];?>">
       <input type="hidden" name="product_name" value="<?php echo $fetch_cart['nume'];?>">
       <input type="hidden" name="product_price" value="<?php echo $fetch_cart['pret'];?>">
       <input type="hidden" name="product_image" value="<?php echo $fetch_cart['imag'];?>">




</form>
<?php
$total += $sub_total;
}

}else{
    print '<p class="empty">your cart is empty</p>';
}

?>

<div class="cart-total">
    <p>Total: <span><?php echo $total;?>$</span></p>
    <a href="shop.php" class="option-btn">continue shopping</a>
    <a href="checkout.php" class="btn">checkout</a>


</div>

</div>
</section>

<?php @include 'footer.php';?>

<script src="script.js"></script>
    
</body>
</html>