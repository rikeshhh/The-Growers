<?php

include 'config.php';

session_start();


$user_id = NULL;

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}

if(isset($_POST['add_to_cart'])){
    if($user_id == NULL){
        header("location:login.php?product_id=". $_POST["product_id"]);
    }
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
 //    $product_quantity = $_POST['product_quantity'];
 
    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
 
    if(mysqli_num_rows($check_cart_numbers) > 0){
       $message[] = 'already added to cart!';
    }else{
       mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, image) VALUES('$user_id', '$product_name', '$product_price', '$product_image')") or die('query failed');
       $message[] = 'product added to cart!';
    }
 }


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>search page</title>

    <!-- custom css file link  -->
    <link rel="stylesheet" href="usercss/style.css">

</head>

<body>

    <?php include 'header.php'; ?>
    <section class="search-form">
        <form action="" method="post">
            <input type="text" name="search" placeholder="search products..." class="box">
            <input type="submit" name="submit" value="search" class="btn">
        </form>
    </section>

    <section class="products" style="padding-top: 0;">

        <div class="box-container">
            <?php
      if(isset($_POST['submit'])){
         $search_item = $_POST['search'];
         $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE name LIKE '%{$search_item}%' or author LIKE '%{$search_item}%' or genres LIKE '%{$search_item}%' ORDER BY id DESC ") or die('query failed');
        //  $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE author LIKE '%{$search_item}%'") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
         while($fetch_product = mysqli_fetch_assoc($select_products)){
   ?>
            <form action="" method="post" class="box">
                <a href="productdetail.php?id=<?php echo $fetch_product['id']?>">
                    <img class="image" src="uploaded_img/<?php echo $fetch_product['image']; ?>" alt="">
                </a>
                <div class="name"><?php echo $fetch_product['name']; ?></div>
                <div class="price">NRS <?php echo $fetch_product['price']; ?>/-</div>
                <div class="author">By: <?php echo $fetch_product['author']; ?></div>
                <input type="hidden" name="product_id" value="<?php echo $fetch_product['id']; ?>">
                <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
                <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
                <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
                <input type="submit" value="add to cart" name="add_to_cart" class="btn">
            </form>
            <?php
            }
         }else{
            echo '<p class="empty">no result found!</p>';
         }
      }else{
         echo '<p class="empty">search something!</p>';
      }
   ?>
        </div>


    </section>
    <!-- 
    <?php include 'genres.php' ?> -->
    <?php include 'footer.php'; ?>

    <!-- custom js file link  -->
    <script src="js/script.js"></script>

</body>

</html>