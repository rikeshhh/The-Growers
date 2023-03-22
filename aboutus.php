<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>About US</title>
    <link rel="stylesheet" href="usercss/aboutus.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />

</head>

<body>
    <?php
    include 'header.php';
    ?>
    <div class="wrapper">
        <img src="./logo.png" width="60px" height="50px" id="center">
        <h1>The <br>Growers</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti sapiente modi repellendus debitis numquam inventore fugiat dolor vero odit, enim nemo dicta non hic voluptate eveniet reprehenderit, nihil asperiores. Maiores!</p>
    </div>
    <section class="parent-card">
        <div class="cards">
            <div class="one">
                <h1>Free Deliveries</h1>
                <p>Get plants delivered to your doorstep without hassle!</p>
            </div>
            <div class="one">
                <h1>Plant Care Support</h1>
                <p>
                Call 9802069969 if you need help in taking care of your plant!
                </p>
            </div>
            <div class="one">
                <h1>Outlets at locations</h1>
                <p>Call 9802069969 if you need help in taking care of your plant</p>
            </div>
        </div>
    </section>
<section class="buysection">
 <img class="image-radius" src="usercss/animatedplant-1.png"> 
<div>
    <div class="buysection-text-content">
    <h1>Buy Now</h1>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis, sapiente. Quidem odit maxime cum. Eligendi dignissimos magni vel inv</p>
    <a href="shop.php">Shop Now</a>  
</div>
  
  <div>
  
  </div>
</div>
</section>
<?php
include 'footer.php';
?>
</body>

</html>