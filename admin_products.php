<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_POST['add_product'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $price = $_POST['price'];
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;
   $product_desc=$_POST['product_desc'];
   $author=$_POST['author'];
   $genres=$_POST['genres'];
   $water=$_POST['water'];
   $sunlight=$_POST['sunlight'];
   $fertilizer=$_POST['fertilizer'];
   $soil=$_POST['soil'];
   $humidity=$_POST['humidity'];

   $select_product_name = mysqli_query($conn, "SELECT name FROM `products` WHERE name = '$name' and type='latestproduct'") or die('query failed');

   if(mysqli_num_rows($select_product_name) > 0){
      $message[] = 'product name already added';
   }else{
      $add_product_query = mysqli_query($conn, "INSERT INTO `products`(name, price, image,product_desc,author,type,genres,water,soil,sunlight,fertilizer,humidity) VALUES('$name', '$price', '$image','$product_desc','$author','latestproduct','$genres','$water','$soil','$sunlight','$fertilizer','$humidity')") or die('query failed');

      if($add_product_query){
         if($image_size > 2000000){
            $message[] = 'image size is too large';
         }else{
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'product added successfully!';
         }
      }else{
         $message[] = 'product could not be added!';
      }
   }
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_image_query = mysqli_query($conn, "SELECT image FROM `latestproduct` WHERE id = '$delete_id'") or die('query failed');
   $fetch_delete_image = mysqli_fetch_assoc($delete_image_query);
   unlink('uploaded_img/'.$fetch_delete_image['image']);
   mysqli_query($conn, "DELETE FROM `products` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_products.php');
}

if(isset($_POST['update_product'])){

   $update_p_id = $_POST['update_p_id'];
   $update_name = $_POST['update_name'];
   $update_price = $_POST['update_price'];
   $update_product_desc=$_POST['update_product_desc'];
   $update_author=$_POST['update_author'];
   $update_genres=$_POST['update_genres'];

   mysqli_query($conn, "UPDATE `products` SET name = '$update_name', price = '$update_price',product_desc='$update_product_desc',author='$update_author',genres='$update_genres' WHERE id = '$update_p_id'") or die('query failed');

   $update_image = $_FILES['update_image']['name'];
   $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
   $update_image_size = $_FILES['update_image']['size'];
   $update_folder = 'uploaded_img/'.$update_image;
   $update_old_image = $_POST['update_old_image'];

   if(!empty($update_image)){
      if($update_image_size > 2000000){
         $message[] = 'image file size is too large';
      }else{
         mysqli_query($conn, "UPDATE `featuredproduct` SET image = '$update_image' WHERE id = '$update_p_id'") or die('query failed');
         move_uploaded_file($update_image_tmp_name, $update_folder);
         unlink('uploaded_img/'.$update_old_image);
      }
   }

   header('location:admin_products.php');

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>products</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="css/admin_style.css">

</head>

<body>

    <?php include 'admin_header.php'; ?>

    <!-- product CRUD section starts  -->

    <section class="add-products">

        <h1 class="title">Latest products</h1>

        <form action="" method="post" enctype="multipart/form-data">
            <h3>add product</h3>
            <input type="text" name="name" class="box" placeholder="enter product name" required>
            <input type="number" min="0" name="price" class="box" placeholder="enter product price" required>
            <input type="text" name="author" class="box" placeholder="enter Scientific name" required>
            <input type="text" list="genres" name="genres" class="box" placeholder="Enter Types" required>
            <datalist id="genres">
                <option>Indoor</option>
                <option>Outdoor</option>
                <option>Gifts</option>
                <option>Decoration</option>
                <option>Pots</option>

                <!-- <option>Novel</option>
                <option>Detective</option>
                <option>Mystery</option>
                <option>Fantasy</option>
                <option>Historical Fiction</option>
                <option>Horror</option>
                <option>Literary Fiction</option>
                <option>Romance</option>
                <option>SCi-fic</option>
                <option>Short stories</option>
                <option>Suspense and Thrillers</option>
                <option>Women's Fiction</option>
                <option>Biographies and Autobiographies</option>
                <option>Cookbooks</option>
                <option>Essays</option>
                <option>History</option>
                <option>Memoir</option>
                <option>Poetry</option>
                <option>Self-Help</option>
                <option>True Crime</option> -->
            </datalist>
            <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box" required>
            <!-- <input type="text" name="product_desc" class="box" placeholder="enter product description" required> -->
            <textarea name="product_desc" class="box" placeholder="enter product description" required>
</textarea>
<p style="
width:170px;
padding:20px;
border-radius:50px;
 background-image: linear-gradient(45deg, #CC0099,#3366FF);
 margin: 0 auto;
 font-size: 1.7rem;
    cursor: pointer;
    font-weight: 500;
    margin-top: 20px;
">Care and tips</p>
<textarea name="water" class="box" placeholder="Water" required>
</textarea>
<textarea name="soil" class="box" placeholder="Soil" required>
</textarea>
<textarea name="sunlight" class="box" placeholder="Sunlight" required>
</textarea>
<textarea name="fertilizer" class="box" placeholder="Fertilizer" required>
</textarea>
<textarea name="humidity" class="box" placeholder="Humidity" required>
</textarea>

            <input type="submit" value="add product" name="add_product" class="btn">
        </form>

    </section>

    <!-- product CRUD section ends -->

    <!-- show products  -->


    <div class="box-container">
        <style>
        .product-container table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .product-container img {
            height: 10rem;
            width: 10rem;
        }

        .product-container {
            display: flex;
            flex-wrap: wrap;
            text-align: center;
        }

        .product-container th {
            padding: 5px;
            font-weight: normal;
        }

        .product-container td {
            padding: 10px 5px;
        }

        .product-name {
            font-weight: bold;
            font-size: 20px;
        }

        .product-content {
            font-size: 16px;
        }
        </style>
        <div class="product-container">
            <table>
                <tr>
                    <th>
                        <div class="product-name">Products</div>
                    </th>
                    <th>
                        <div class="product-name">Name</div>
                    </th>
                    <th>
                        <div class="product-name">Price</div>
                    </th>
                    <th>
                        <div class="product-name">Scientific Name</div>
                    </th>
                </tr>
                <?php
                 $limit=9;
                 if(isset($_GET['page'])){
                     $page=$_GET['page'];
                 }else{
                     $page=1;
                 }
                 $offset=($page-1)*$limit;
         $select_products = mysqli_query($conn, "SELECT * FROM `products` where type='latestproduct'ORDER BY id DESC  LIMIT {$offset},{$limit}") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
                <tr>
                    <td><img src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt=""></td>
                    <td>
                        <div class="product-content">
                            <?php echo $fetch_products['name']; ?>
                        </div>
                    </td>
                    <td>
                        <div class="product-content" style="color:red">NRS <?php echo $fetch_products['price']; ?>/-
                        </div>
                    </td>
                    <td>
                        <div class="product-content"><?php echo $fetch_products['author']; ?></div>
                    </td>
                    <td style="width:1px"> <a
                            href="admin_featuredproduct.php?update=<?php echo $fetch_products['id']; ?>"
                            class="option-btn">update</a></td>
                    <td style="text-align:left"> <a
                            href="admin_featuredproduct.php?delete=<?php echo $fetch_products['id']; ?>"
                            class="delete-btn" onclick="return confirm('delete this product?');">delete</a></td>
                </tr>
        </div>
        <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
      ?>
        </table>
        <style>
        .pagination {
            margin-left: 5rem;
            margin-top: 20px;
            margin-bottom: 15rem;
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
        $select_products = mysqli_query($conn, "SELECT COUNT(*) FROM `products` where type='latestproduct'") or die('query failed');
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
    </div>



    <section class="edit-product-form">
        <?php
      if(isset($_GET['update'])){
         $update_id = $_GET['update'];
         $update_query = mysqli_query($conn, "SELECT * FROM `products` WHERE id = '$update_id'") or die('query failed');
         if(mysqli_num_rows($update_query) > 0){
            while($fetch_update = mysqli_fetch_assoc($update_query)){
   ?>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="update_p_id" value="<?php echo $fetch_update['id']; ?>">
            <input type="hidden" name="update_old_image" class="image" value="<?php echo $fetch_update['image']; ?>">
            <img src="uploaded_img/<?php echo $fetch_update['image']; ?>" alt="">
            <div class="field">
                <input type="text" name="update_name" value="<?php echo $fetch_update['name']; ?>" class="box" required
                    placeholder="enter product name">
                <input type="number" name="update_price" value="<?php echo $fetch_update['price']; ?>" min="0"
                    class="box" required placeholder="enter product price">
                <input type="text" name="update_author" value="<?php echo $fetch_update['author']; ?>" class="box"
                    required placeholder="enter scientific name">
                <input type="text" list="genres" name="update_genres" value="<?php echo $fetch_update['genres']; ?>"
                    class="box" required placeholder="enter Genres">
                <datalist id="genres">
                    <option>Indoor</option>
                    <option>Outdoor</option>
                    <option>Gifts</option>
                    <option>Decoration</option>
                 
                    
                </datalist>
                <input type="file" class="desc" name="update_image" accept="image/jpg, image/jpeg, image/png">
                <!-- <input type="text" name="update_product_desc" value="<?php echo $fetch_update['product_desc']; ?>"
                    class="desc" required placeholder="product description"> -->
                <textarea name="update_product_desc" class="desc" placeholder="enter Description">
                <?php echo $fetch_update['product_desc'];?>
            </textarea>
            </div>
            <input type="submit" value="update" name="update_product" class="btn">
            <input type="reset" value="cancel" id="close-update" class="option-btn">
        </form>
        <?php
         }
      }
      }else{
         echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
      }
   ?>

    </section>


    <!-- custom admin js file link  -->
    <script>
    let navbar = document.querySelector(".header .navbar");
    let accountBox = document.querySelector(".header .account-box");

    document.getElementById("close-update").addEventListener("click", () => {
        document.querySelector(".edit-product-form").style.display = "none";
        window.location.href = "admin_products.php";
    });


    document.querySelector("#menu-btn").onclick = () => {
        navbar.classList.toggle("active");
        accountBox.classList.remove("active");
    };

    document.querySelector("#user-btn").onclick = () => {
        accountBox.classList.toggle("active");
        navbar.classList.remove("active");
    };

    window.onscroll = () => {
        navbar.classList.remove("active");
        accountBox.classList.remove("active");
    };
    </script>

</body>

</html>