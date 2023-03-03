<?php

include 'config.php';

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};
?>
<style>
.cart-page {
    margin: 20px auto;
    margin-bottom: 90px;
}

body {
    background: #f5f5f5;
}

table {
    width: 100%;
    border-collapse: collapse;
    background: #f5f5f5;
}

.cart-info {
    display: flex;
    flex-wrap: wrap;
}

th {
    text-align: left;
    padding: 5px;
    color: white;
    background: #ff523b;
    font-weight: bold;
    font-size: 16px;
    padding-left: 40px;
    padding-right: 40px;
}

.center {
    text-align: center;
    font-size: 24px;
    font-weight: bold;
}

td {
    text-align: left;
    padding: 5px;
    font-weight: normal;
    font-size: 12px;
    padding-left: 40px;
    padding-right: 40px;
}

.empty {
    text-align: center;
    font-size: 24px;
    color: red;
    margin-bottom: 40px;

}
</style>

<body>
    <div class="center">
        YOUR ORDERS
    </div>

    <!--cart items detail-->
    <div class="small-container cart-page">

        <table>
            <tr>
                <th>Placed on</th>
                <th>Product</th>
                <th>Total Price</th>
                <th>Payment Method</th>
                <th>payment status</th>
            </tr>
            <?php
$select_orders = mysqli_query($conn, "SELECT * FROM `orders`where user_id='$user_id'") or die('query failed');
if(mysqli_num_rows($select_orders) > 0){
 while($fetch_orders = mysqli_fetch_assoc($select_orders)){
?>
            <tr>
                <td>
                    <div class="cart-info">
                        <?php echo $fetch_orders['placed_on']; ?>
                    </div>
                </td>
                <td>
                    <div class="cart-info">
                        <?php echo $fetch_orders['total_products']; ?>
                    </div>
                </td>

                <td>
                    <div class="cart-info">
                        NRS <?php echo $fetch_orders['total_price']; ?>/-
                    </div>
                </td>

                <td>
                    <div class="cart-info">
                        <?php echo $fetch_orders['method']; ?>
                    </div>
                </td>

                <td>
                    <div class="cart-info">
                        <?php echo $fetch_orders['payment_status']; ?>
                    </div>
                </td>
            </tr>
            <?php
 
}
}else{
 echo '<p class="empty">no orders placed yet!</p>';
}
?>
        </table>
    </div>
    <!-----------js for toggle menu----------->
    <script>
    var menuitems = document.getElementById("menuitems");

    menuitems.style.maxHeight = "0px";

    function menutoggle() {
        if (menuitems.style.maxHeight = "0px") {
            menuitems.style.maxHeight = "200px";
        } else {
            menuitems.style.maxHeight = "0px";
        }
    }
    </script>
</body>

</html>