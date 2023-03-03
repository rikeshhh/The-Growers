<?php

include 'config.php';

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};
?>
<style>
table {
    display: flex;
    justify-content: center;
    width: 1600px;
    text-align: left;
    overflow: scroll;
    border-collapse: collapse;
    background-color: #f5f5f5;
}

th {
    padding-right: 40px;
    padding-left: 40px;
    padding-bottom: 10px;
    font-size: 16px;
}

td {
    padding-left: 40px;
    padding-bottom: 5px;
    text-align: left;
    font-size: 16px;
}
</style>

<body>
    <table>
        <tr>
            <th>Placed on</th>
            <th>Total Products</th>
            <th>Total Price</th>
            <th>Payment Method</th>
            <th>Order Status</th>
        </tr>
        <?php
$select_orders = mysqli_query($conn, "SELECT * FROM `orders`where user_id='$user_id'") or die('query failed');
if(mysqli_num_rows($select_orders) > 0){
 while($fetch_orders = mysqli_fetch_assoc($select_orders)){
?>
        <tr>
            <td><?php echo $fetch_orders['placed_on']; ?> </td>
            <td><?php echo $fetch_orders['total_products']; ?></td>
            <td>NRS <?php echo $fetch_orders['total_price']; ?>/- </td>
            <td><?php echo $fetch_orders['method']; ?></td>
            <td><?php echo $fetch_orders['payment_status']; ?></td>
        </tr>
        <?php
 
}
}else{
 echo '<p class="empty">no orders placed yet!</p>';
}
?>
    </table>
</body>