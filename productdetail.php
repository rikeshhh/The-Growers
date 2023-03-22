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
    // $product_author=$_POST['author'];
    // $product_genres=$_POST['genres'];
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

<head>
    <link rel="stylesheet" href="usercss/home.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
</head>
<title>product detail</title>
<?php  include ('header.php');
    ?>
<?php
$id = $_GET["id"];
  $select_products = mysqli_query($conn, "SELECT * FROM `products` where id ='$id'") or die('query failed');
  if(mysqli_num_rows($select_products) > 0){
     while($fetch_products = mysqli_fetch_assoc($select_products)){
?>
<form action="" method="post">
    <section id="prodetails" class="section-p1">
        <div class="single-pro-image">
            <img src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="" width="100%" id="MainImg" alt="">
        </div>
        <div class="single-pro-details">
            <h6><a href="home.php">Home</a>/<a href="shop.php">Feature</a></h6>
            <h4>
                <div class="name"><?php echo $fetch_products['name']; ?></div>
            </h4>
            <h3>
                <div class="author">Scientific Name: <?php echo $fetch_products['author']; ?></div>
            </h3>
            <h3>
                <div class="genres">Genres: <?php echo $fetch_products['genres']; ?></div>
            </h3>
            <h2>
                <div class="price">NRS <?php echo $fetch_products['price']; ?>/-</div>
            </h2>
            <input type="submit" value="add to cart" name="add_to_cart" class="btn">
            <h4>Product Details</h4>
            <p>
            <div class="product_desc"><br><?php echo $fetch_products['product_desc']; ?></div>
            </p>
            <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
            <input type="hidden" name="product_desc" value="<?php echo $fetch_products['product_desc']; ?>">
        </div>
      
    </section>
</form>


<div class="container">
    <h1 style="border-bottom: 1px solid black;">Plant care tips</h1>
    <div style="display:flex;gap: 40px;">
    <label for="desc">Water:</label> 
    <input id="desc" value="<?php echo $fetch_products['water']; ?>">  
</div>
<div style="display:flex;gap: 40px;flex-direction:row;">
    <label for="desc">Soil:</label> 
    <input id="desc" value="<?php echo $fetch_products['soil']; ?>">  
</div>
<div style="display:flex;gap: 40px;flex-direction:row;">
    <label for="desc">Sunlight:</label> 
    <input id="desc" value="<?php echo $fetch_products['sunlight']; ?>">  
</div>
<div style="display:flex;gap: 40px;flex-direction:row;">
    <label for="desc">Fertilizer:</label> 
    <input id="desc" value="<?php echo $fetch_products['fertilizer']; ?>">  
</div>
<div style="display:flex;flex-direction:row;gap: 40px;">
    <label for="desc">Humidity:</label> 
    <input id="desc" value="<?php echo $fetch_products['humidity']; ?>">  
</div>
  
</div>
<section class="products">

    <h1 class="title">You may also like</h1>

    <div class="box-container">

        <?php  
         $select_products = mysqli_query($conn, "SELECT * FROM `products` where type='featureproduct' order by id DESC LIMIT 3") or die('query failed');
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

    <div class="load-more" style="margin-top: 2rem; text-align:center">
        <a href="feature.php" class="option-btn">load more</a>
    </div>

</section>
<?php include('footer.php');
?>
<?php
     }
    }