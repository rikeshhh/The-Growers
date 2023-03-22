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
    <link rel="stylesheet" href="./usercss/home.css?v=<?php echo time(); ?>">


</head>

<header class="header">
    <div class="header-1">
        <a href="home.php" class="logo"><i class="fas fa-trees"></i> The<span>Growers</span></a>
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
           <li><a href="./home.php">Home</a></li> 
           <li><a href="./feature.php">Featured</a></li>
            <!-- <a href="./shop.php">Shop</a> -->
            <li><a href="./latestproduct.php">latest product</a></li>
            <li><a href="#indoor">Indoor</a></li>
            <li>
            <ul class="dropdown">
  <a class="dropbtn">Dropdown</button>
  <ul class="dropdown-content">
<li><a href="#indoor">Indoor</a></li>
<a href="#outdoor">Outdoor</a><br>
<a href="#pots">Pots</a>
</ul>
    </li>
      </ul>
        </li>

        </nav>

    </div>
</header>