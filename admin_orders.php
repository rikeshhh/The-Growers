<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

if(isset($_POST['update_order'])){

   $order_update_id = $_POST['order_id'];
   $update_payment = $_POST['update_payment'];
   mysqli_query($conn, "UPDATE `orders` SET payment_status = '$update_payment' WHERE id = '$order_update_id'") or die('query failed');
   $message[] = 'payment status has been updated!';

}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `orders` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_orders.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>orders</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="css/admin_style.css">

</head>

<body>

    <?php include 'admin_header.php'; ?>

    <style>
    .placed-order {
        display: flex;
        flex-wrap: wrap;
        text-align: center;
        padding-top: 30px;
    }

    .placed-order table {
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
    }

    .placed-order th {
        padding: 5px;
        font-size: 17px;
        font-weight: bold;
    }

    .placed-order td {
        font-size: 14px;
    }

    .btn,
    .option,
    .white-btn {
        display: inline-block;
        margin-top: 1rem;
        padding: 1rem 3rem;
        cursor: pointer;
        color: var(--white);
        font-size: 1.8rem;
        border-radius: 0.5rem;
        text-transform: capitalize;
        background-color: #f39c12;
        height: 28px;
        padding-bottom: 30px;
    }

    .delete,
    .white-btn {
        display: inline-block;
        margin-top: 1rem;
        padding: 1rem 3rem;
        cursor: pointer;
        color: var(--white);
        font-size: 1.8rem;
        border-radius: 0.5rem;
        text-transform: capitalize;
        background-color: #c0392b;
        height: 28px;
        padding-bottom: 30px;
    }

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
    <br>
    <br>
    <h1 class="title">placed orders</h1>
    <div class="placed-order">
        <table>
            <tr>
                <th width="10%">Placed on</th>
                <th>Name</th>
                <th>Number</th>
                <th>Address</th>
                <th>Total Products</th>
                <th>Total Price</th>
                <th>Payment Method</th>
                <th>Status</th>
            </tr>
            <?php
            $limit=6;
            if(isset($_GET['page'])){
                $page=$_GET['page'];
            }else{
                $page=1;
            }
            $offset=($page-1)*$limit;
      $select_orders = mysqli_query($conn, "SELECT * FROM `orders`ORDER BY id DESC LIMIT {$offset},{$limit}") or die('query failed');
      if(mysqli_num_rows($select_orders) > 0){
         while($fetch_orders = mysqli_fetch_assoc($select_orders)){
      ?>
            <tr>
                <td><?php echo $fetch_orders['placed_on']; ?></td>
                <td><?php echo $fetch_orders['name']; ?></td>
                <td><?php echo $fetch_orders['number']; ?></td>
                <td><?php echo $fetch_orders['address']; ?></td>
                <td><?php echo $fetch_orders['total_products']; ?></td>
                <td style="color:red">NRS <?php echo $fetch_orders['total_price']; ?></td>
                <td><?php echo $fetch_orders['method']; ?></td>
                <td>
                    <form action="" method="post">
                        <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
                        <select name="update_payment">
                            <option value="" selected disabled><?php echo $fetch_orders['payment_status']; ?></option>
                            <option value="pending">pending</option>
                            <option value="completed">completed</option>
                        </select>
                </td>
                <td><input type="submit" value="update" name="update_order" class="option"></td>
                <td><a href="admin_orders.php?delete=<?php echo $fetch_orders['id']; ?>"
                        onclick="return confirm('delete this order?');" class="delete">delete</a></td>
                </form>
                <?php
         }
      }else{
         echo '<p class="empty">no orders placed yet!</p>';
      }
      ?>
        </table>
        <?php
        $select_products = mysqli_query($conn, "SELECT COUNT(*) FROM `orders`") or die('query failed');
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

    <!-- custom admin js file link  -->
    <script src="js/admin_script.js"></script>

</body>

</html>