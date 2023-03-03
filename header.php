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
$user_id = NULL;

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}
?>
<?php

    $cart_rows_number = 0;
    if($user_id !== NULL){
        $select_cart_number = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
        $cart_rows_number = mysqli_num_rows($select_cart_number); 
    }
    ?>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link rel="stylesheet" href="./usercss/home.css">
</head>

<header class="header">
    <div class="header-1">
        <a href="home.php" class="logo"><i class=" fas fa-book"></i> Book<span>Store</span></a>
        <!-- <form action="" class="search-form">
            <a href="search_page.php" class="fas fa-search"></a>
            <label for="search-box" class="fas fa-search"></label>
        </form> -->

        <div class="icons">
            <a href="search_page.php" class="fas fa-search"></a>
            <a href="#" class="fas fa-heart"></a>
            <a id="user-btn" href="userprofile.php" class="fas fa-user"></a>
            <a href="cart.php" class="fas fa-shopping-cart cart">(<?php echo $cart_rows_number; ?>)</a>
        </div>
    </div>

    <!-- navi -->
    <div class="header-2">
        <nav class="navbar">
            <a href="./home.php">Home</a>
            <a href="./feature.php">Featured</a>
            <a href="./shop.php">Shop</a>
            <a href="./latestproduct.php">latest product</a>
        </nav>

    </div>
</header>