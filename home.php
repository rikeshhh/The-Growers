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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TheGrowers</title>

    <!--Font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />


    <!-- CSS Linked -->
    <link rel="stylesheet" href="usercss/style.css?v=<?php echo time(); ?>">
</head>

<body>

    <?php include 'header.php'; ?>

    <section class="home">

 


        <div class="content">
            <h3>If a tree dies, plant another in its place.</h3>
            <p id="spare-time">It's impossible to walk thorugh a book store and be in the bad mood at the same time.
            </p>
            <a href="shop.php" class="white-btn">discover more</a>
        </div>

        <!-- <img src="./usercss/download (1).jpeg" class="contentTwo"> -->

    </section>

    <section class="products">

        <h1 class="title">latest products</h1>

        <div class="box-container">

            <?php  
         $select_products = mysqli_query($conn, "SELECT * FROM `products` where type='latestproduct' ORDER BY id DESC LIMIT 6") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
            <form action="" method="post" class="box">
                <a href="productdetail.php?id=<?php echo $fetch_products['id']?>">
                    <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
                </a>
                <div class="name"><?php echo $fetch_products['name']; ?></div>
                <div class="price">NRS <?php echo $fetch_products['price']; ?>/-</div>
                <!-- <div class="author">By: <?php echo $fetch_products['author']; ?></div> -->
                <!-- <input type="number" min="1" name="product_quantity" value="1" class="qty"> -->
                <input type="hidden" name="product_id" value="<?php echo $fetch_products['id']; ?>">
                <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                <input type="submit" value="add to cart" name="add_to_cart" class="btn">
                <!-- <a href="#"><i class="fas fa-shopping-cart cart"></i></a> -->
            </form>
            <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
      ?>
        </div>

        <div class="load-more" style="margin-top: 2rem; text-align:center">
            <a href="latestproduct.php" class="option-btn">load more</a>
        </div>

    </section>
    <?php include ('featureproduct.php');
    ?>
    <section id="indoor">
    <?php
include ('./indoor/indoorproduct.php');
?>

    </section>
<section>
<?php
include ('./outdoor/outdoorproduct.php');
?>
</section>
<section>
<?php
include ('./pot/pot.php');
?>
</section>

    <section class="about">

        <div class="flex">

            <div class="image">
                <img src="images/about-img.jpg" alt="">
            </div>

            <div class="content">
                <h3>about us</h3>
                <p>We offer a tremendous gathering of books in the various classifications of Fiction, Non-fiction,
                    Biographies, History, Religions, Self Help, Children.</p>
                <a href="aboutus.php" target=" " class="btn">read more</a>
            </div>

        </div>

    </section>

    <section class="home-contact">

        <div class="content">
            <h3>have any questions?</h3>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Atque cumque exercitationem repellendus, amet
                ullam voluptatibus?</p>
            <a href="contact.php" class="white-btn">contact us</a>
        </div>

    </section>





    <?php include 'footer.php'; ?>

    <!-- custom js file link  -->

</body>

</html>