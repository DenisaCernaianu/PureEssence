<?php 
@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:login.php');
}

if(isset($_POST['add_product'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
    $details = mysqli_real_escape_string($conn, $_POST['details']);
    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'uploaded_images/'.$image;

    $selected_product_name=mysqli_query($conn, "SELECT nume FROM `produse` WHERE nume='$name' ") or die('query failed');

    if(mysqli_num_rows($selected_product_name)>0){
        $message[] = 'product name already exist!';
    }else {
        $insert_product = mysqli_query($conn, "INSERT INTO `produse` (nume, detalii, pret, imag, cantitate) VALUES ('$name', '$details', '$price', '$image','$quantity') ") or die ('query failed');

        if($insert_product){
            if($image_size>2000000){
                $message[] = 'image size is too large!';
            }else {
                move_uploaded_file($image_tmp_name, $image_folder);
                $message[] = 'product added successfully!';
            }
        }
    }

}


if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    $select_delete_image = mysqli_query($conn, "SELECT imag FROM `produse` WHERE id='$delete_id'") or die('query failed');
    $fetch_delete_image = mysqli_fetch_assoc($select_delete_image);
    unlink('uploaded_images/'.$fetch_delete_image['imag']);
    mysqli_query($conn, "DELETE FROM `produse` WHERE id = '$delete_id'") or die('query failed');
    mysqli_query($conn, "DELETE FROM `wishlist` WHERE pr_id = '$delete_id'") or die('query failed');
    mysqli_query($conn, "DELETE FROM `cos` WHERE pr_id = '$delete_id'") or die('query failed');
    header('location:admin_products.php');

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>products</title>
    
 <!-- font link-->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

<!--admin css file link --> 
<link rel="stylesheet" href="admin_style.css">

</head>
<body>

<?php @include 'admin_header.php'; ?>

<section class="add-products">

<form action="" method="POST" enctype="multipart/form-data">
    <h3>add new product</h3>
    <input type="text" class="box" required placeholder="enter product name" name="name">
    <input type="number" min="0" class="box" required placeholder="enter product price" name="price">
    <input type="number" min="0" class="box" required placeholder="enter product quantity" name="quantity"> 
   <textarea name="details" class="box" required placeholder ="enter product details"    cols="30" rows="10"></textarea>
   <input type="file" accept="image/jpg, image/jpeg, image/png" required class="box" name="image">
   <input type="submit" value="add product" name="add_product" class="btn">


</form>

</section>


<section class="show-products">

<div class="box-container">
<?php
  $select_products = mysqli_query($conn, "SELECT * FROM `produse`") or die('query failed');
  if(mysqli_num_rows($select_products)>0){
    while($fetch_products = mysqli_fetch_assoc($select_products)){
?>
<div class="box">
    <img class="image" src="uploaded_images/<?php echo $fetch_products['imag'] ?>" 
    alt="">
    <div class="nume"><?php echo $fetch_products['nume']; ?></div>
    <div class="pret"><?php echo $fetch_products['pret']; ?>$</div>
    <div class="cantitate"><?php echo $fetch_products['cantitate']; ?>ml</div>
    <div class="detalii"><?php echo $fetch_products['detalii']; ?></div>
    <a href="admin_update_product.php?update=<?php echo $fetch_products['id'] ; ?>" class="option-btn">update</a>
    <a href="admin_products.php?delete=<?php echo $fetch_products['id'] ; ?>" class="delete-btn" onclick="return confirm('delete this product?');">delete</a>



</div>
<?php
    }
  }else{
         echo'<p class="empty">no products added yet</p>';
  }
?>

</div>


</section>



<script src="admin_script.js"></script>
    

</body>
</html>