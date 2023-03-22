<?php

include 'config.php';
?>
<section class="products">

    <h1 class="title">Outdoor plants</h1>

    <div class="box-container">

        <?php  
         $select_products = mysqli_query($conn, "SELECT * FROM `products` where genres='Outdoor' ORDER BY id DESC LIMIT 6") or die('query failed');
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
    <!-- <div class="load-more" style="margin-top: 2rem; text-align:center">
        <a href="outdoor/outdoor.php" class="option-btn">load more</a>
    </div> -->

</section>