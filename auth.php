<?php
// if(isset($message)){
//    foreach($message as $message){
//       echo '
//       <div class="message">
//          <span>'.$message.'</span>
//          <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
//       </div>
//       ';
//    }
// }
?>

<?php 
function check_auth($conn, $session){
    $user_id = $session['user_id'];
    if($user_id)   {
    $user = mysqli_query($conn, "SELECT * FROM `users` WHERE user_id = '$user_id'") or die('query failed');
    if(!isset($user)) return false;
    return $user;
    }
}

function get_cart($user_id, $conn){
    $carts = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
    return $carts;
}
 ?>