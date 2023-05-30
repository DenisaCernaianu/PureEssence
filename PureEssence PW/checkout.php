<?php 
@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
    header('location:login.php');
};

if(isset($_POST['order'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $method = mysqli_real_escape_string($conn, $_POST['method']);
    $address=mysqli_real_escape_string($conn, 'flat no.' . $_POST['flat'].','. $_POST['street'].','.$_POST['city']);
    $placed_on=date('d-M-Y');

    $cart_total=0;
    $cart_products[]='';

    $cart_query = mysqli_query($conn,"SELECT * FROM `cos` WHERE user_id='$user_id'") or die('failed');
    if(mysqli_num_rows($cart_query)>0){
        while($cart_item =mysqli_fetch_assoc($cart_query)){
            $cart_products[] = $cart_item['nume'].'('.$cart_item['cantitate'].')';
            $sub_total =($cart_item['pret'] * $cart_item['cantitate']);
            $cart_total += $sub_total;
        }
    }

    $total_products = implode(', ', $cart_products);

    $order_query = mysqli_query($conn, "SELECT * FROM `comenzi` WHERE nume = '$name' AND numar= '$number' AND email='$email' AND metoda='$method' AND adresa='$address' AND total_pr='$total_products' AND total_pret='$cart_total'") or die('query failed');
   
    if($cart_total == 0){
        $message[]='your cart is empty';
    }elseif(mysqli_num_rows($order_query)>0){
        $message[]='order placed already';
    }else{
        mysqli_query($conn, "INSERT INTO `comenzi` (user_id, nume, numar, email, metoda, adresa, total_pr, total_pret, plasat) VALUES ('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products', '$cart_total', '$placed_on')") or die('failed');
       
        mysqli_query($conn,"DELETE FROM `cos` WHERE user_id='$user_id'") or die('fail');
        $message[]='order placed!';
    }

}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>checkout</title>

    <!-- font link-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

<!--admin css file link --> 
<link rel="stylesheet" href="style.css">

</head>
<body>


<?php @include 'header.php'; ?>


<section class="heading-w">
<h1 class="title">checkout</h1>
</section>


<section class="display-order">

    
<?php
$total = 0;
$select_cart =mysqli_query($conn,"SELECT * FROM `cos` WHERE user_id = '$user_id'") or die('failed');
if(mysqli_num_rows($select_cart)>0){
    while($fetch_cart = mysqli_fetch_assoc($select_cart)){
        $total_price =($fetch_cart['pret'] * $fetch_cart['cantitate']);
        $total += $total_price;
?>
<p> <?php echo $fetch_cart['nume'] ?><span>( <?php echo $fetch_cart['pret'].'$'.'x'.$fetch_cart['cantitate'] ?>)</span> </p>
<?php
}

}else{
    print '<p class="empty">your cart is empty</p>';
}

?>
<div class="total">total:<span><?php echo $total;?>$<span></div>

</section>

<section class="checkout">
     
   <form action="" method="POST">
     <h3>place your order</h3>
     <div class="flex">
       <div class="inputBox">
        <span>your name:</span>
        <input type="text" name="name" placeholder="enter your name">
       </div>
       <div class="inputBox">
        <span>your number:</span>
        <input type="text" name="number" placeholder="enter your number">
       </div>
       <div class="inputBox">
        <span>your email:</span>
        <input type="text" name="email" placeholder="enter your email">
       </div>
       <div class="inputBox">
        <span>payment method:</span>
        <select name="method" >
            <option value="cash on delivery">cash</option>
            <option value="credit card">card</option>
        </select>
       </div>
       <div class="inputBox">
        <span>addres line 1:</span>
        <input type="text" name="flat" placeholder="flat no.">
       </div>
       <div class="inputBox">
        <span>addres line 2:</span>
        <input type="text" name="street" placeholder="street name">
       </div>
       <div class="inputBox">
        <span>city:</span>
        <input type="text" name="city" placeholder="city name.">
       </div>
     </div>
     <input type="submit" name="order" value="order now" class="btn">
   </form>
</section>


<?php @include 'footer.php';?>

<script scr="script.js"></script>
    
</body>
</html>