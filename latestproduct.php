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
        mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, image,quantity) VALUES('$user_id', '$product_name', '$product_price', '$product_image',1)") or die('query failed');
        $message[] = 'product added to cart!';
    }
 }

?>

<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />

    <link rel="stylesheet" href="usercss/home.css">
</head>
<title>latest</title>

<body>
    <?php include('header.php')
    ?>
    <section class="products">

        <h1 class="title">Latest products</h1>

        <div class="box-container">

            <?php  
             $limit=9;
             if(isset($_GET['page'])){
                 $page=$_GET['page'];
             }else{
                 $page=1;
             }
             $offset=($page-1)*$limit;
         $select_products = mysqli_query($conn, "SELECT * FROM `products` where type='latestproduct'ORDER BY id DESC LIMIT {$offset},{$limit}") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
            <form action="" method="post" class="box">
                <a href="productdetail.php?id=<?php echo $fetch_products['id']?>">
                    <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
                </a>
                <div class="name"><?php echo $fetch_products['name']; ?></div>
                <div class="price">NRS <?php echo $fetch_products['price']; ?>/-</div>
                <div class="author">By: <?php echo $fetch_products['author']; ?></div>
                <!-- <input type="number" min="1" name="product_quantity" value="1" class="qty"> -->
                <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                <input type="submit" value="add to cart" name="add_to_cart" class="btn">
            </form>
            <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
      ?>
        </div>
        <style>
        .pagination {
            margin-left: 15rem;
            margin-top: 20px;
        }

        .pagination span {
            display: inline-block;
            border: 1px solid #ff523b;
            margin-left: 10px;
            width: 40px;
            height: 40px;
            line-height: 40px;
            text-align: center;
            cursor: pointer;
        }

        .pagination span:hover {
            background: #ff523b;
            color: #fff;
        }

        .pagination a {
            color: black;
        }
        </style>
        <?php
        $select_products = mysqli_query($conn, "SELECT COUNT(*) FROM `products` where type='latestproduct' ") or die('query failed');
      $total_rows=mysqli_fetch_array($select_products)[0];
      $total_page=ceil($total_rows/$limit);
      echo'<div class="pagination">';
      if($page>1){
        echo'<a href=?page='.($page - 1).'><span>Prev</span></a>';
      }
      for($i=1; $i<=$total_page;$i++){
        echo '<a href="?page='.$i.'"><span>'.$i.'</span></a>';

      }
      if($total_page>$page){
        echo'<a href=?page='.($page + 1).'><span>Next</span></a>';
        echo '</div>';
      }
      ?>
    </section>
    <?php include('footer.php');
    ?>

    <body>

</html>