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
    <title>orders</title>

    <!-- font link-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

<!--admin css file link --> 
<link rel="stylesheet" href="style.css">

</head>
<body>


<?php @include 'header.php'; ?>

<section class="placed-orders">
    <h1 class="title">placed orders</h1>


   <div class="box-container">
<?php
  
   $select_orders = mysqli_query($conn,"SELECT * FROM `comenzi` WHERE user_id = '$user_id'") or die('query failed');
   if(mysqli_num_rows($select_orders)> 0){
      while($fetch_orders = mysqli_fetch_assoc($select_orders)){

        ?>
        <div class="box">
            <p>placed on: <span><?php echo $fetch_orders['plasat'];?></span></p>
            <p>name: <span><?php echo $fetch_orders['nume'];?></span></p>
            <p>number: <span><?php echo $fetch_orders['numar'];?></span></p>
            <p>email: <span><?php echo $fetch_orders['email'];?></span></p>
            <p>address: <span><?php echo $fetch_orders['adresa'];?></span></p>
            <p>total products: <span><?php echo $fetch_orders['total_pr'];?></span></p>
            <p>total price: <span><?php echo $fetch_orders['total_pret'];?>$</span></p>
            <p>payment status: <span><?php echo $fetch_orders['status'];?></span></p>
            </form>
        </div>
     <?php
      }

   }else{
      print  '<p class="empty">no orders yet </p>';
   }

?>

   </div>



</section>

<?php @include 'footer.php';?>

<script src="script.js"></script>
    
</body>
</html>