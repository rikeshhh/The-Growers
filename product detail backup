<?php

include 'config.php';
session_start();

?>

<?php
  $select_products = mysqli_query($conn, "SELECT * FROM `products` where id ='$_GET[pid]'") or die('query failed');
  if(mysqli_num_rows($select_products) > 0){
     while($fetch_products = mysqli_fetch_assoc($select_products)){
?>
<form action="" method="post" class="box">
    <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
    <div class="name"><?php echo $fetch_products['name']; ?></div>
    <div class="price">Price NRP <?php echo $fetch_products['price']; ?>/-</div>
    <div class="product_desc">Description :<br><?php echo $fetch_products['product_desc']; ?></div>
    <input type="number" min="1" name="product_quantity" value="1" class="qty">
    <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
    <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
    <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
    <input type="submit" value="add to cart" name="add_to_cart" class="btn">
    <?php
  }
}