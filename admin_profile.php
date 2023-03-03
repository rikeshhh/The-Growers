<?php

include 'config.php';
session_start();
$admin_id = $_SESSION['admin_id'];



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>

    <!-- custom css file link  -->
    <link rel="stylesheet" href="usercss/userprofile.css">

</head>

<body>
    <?php include 'admin_header.php'; ?>

    <div class="container">

        <div class="profile">
            <?php
         $select = mysqli_query($conn, "SELECT * FROM `users` WHERE id = '$admin_id '") or die('query failed');
         if(mysqli_num_rows($select) > 0){
            $fetch = mysqli_fetch_assoc($select);
         }
         if($fetch['image'] == ''){
            echo '<img src="image/default-avatar.png">';
         }else{
            echo '<img src="uploaded_img/'.$fetch['image'].'">';
         }
      ?>
            <h3><?php echo $fetch['name']; ?></h3>
            <a href="admin_update_profile.php" class="btn">update profile</a>
            <a href="logout.php" class="delete-btn">logout</a>
        </div>

    </div>
</body>

</html>