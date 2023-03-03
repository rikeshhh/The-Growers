<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
$user_id = $_SESSION['user_id'];
?>
<?php
    $select_cart_number = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
     $cart_rows_number = mysqli_num_rows($select_cart_number); 
 ?>

<head>
    <link rel="stylesheet" href="usercss/home.css">
</head>

<header class="header">
    <div class="header-1">
        <a href="#" class="logo"><i class=" fas fa-book"></i> Info<span>Sys</span></a>
        <form action="" class="search-form">
            <input type="text" name="search" placeholder="Search Here" id="search-box">
            <label for="search-box" class="fas fa-search"></label>
        </form>

        <div class="icons">
            <div id="search-btn" class="fas fa-search"></div>
            <a href="#" class="fas fa-heart"></a>
            <div id="user-btn" class="fas fa-user"></div>
            <a href="cart.php" class="fas fa-shopping-cart cart">(<?php echo $cart_rows_number; ?>)</a>
        </div>
        <!-- <div class="user-box">
            <p>username : <span><?php echo $_SESSION['user_name']; ?></span></p>
            <p>email : <span><?php echo $_SESSION['user_email']; ?></span></p>
            <a href="logout.php" class="delete-btn">logout</a>
        </div> -->
    </div>

    <!-- navi -->
    <div class="header-2">
        <nav class="navbar">
            <a href="home.php">Home</a>
            <a href="feature.php">Featured</a>
            <a href="shop.php">Shop</a>
            <a href="latestproduct.php">latest product</a>
            <a href="#blogs">blogs</a>
        </nav>

    </div>
</header>