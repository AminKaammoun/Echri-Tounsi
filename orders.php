<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
}
;

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>orders</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <?php include 'components/user_header.php'; ?>

   <section class="orders">

      <h1 class="heading">Placed orders</h1>

      <div class="box-container">

         <?php
         if ($user_id == '') {
            ?>
            <div style="text-align: center;   max-width: fit-content; margin-left: auto; margin-right: auto;">
               <img src="images/sad-svgrepo-com.svg" alt="" width="150" height="150">
               <?php
               echo '<p class="empty">Please login to see your orders</p>';
               ?>
               <div class="flex-btn">
                  <a href="user_login.php" class="btn">login</a>
               </div>
               <br>
               <a href="user_register.php" style="font-size:15px; padding-top: 30px; padding-bottom: 30px; ">You don't have
                  an account? Register and make your first
                  order.</a>
            </div>
            <?php
         } else {
            $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ?");
            $select_orders->execute([$user_id]);
            if ($select_orders->rowCount() > 0) {
               while ($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)) {
                  ?>
                  <div class="box">
                     <p>placed on : <span>
                           <?= $fetch_orders['placed_on']; ?>
                        </span></p>
                     <p>name : <span>
                           <?= $fetch_orders['name']; ?>
                        </span></p>
                     <p>email : <span>
                           <?= $fetch_orders['email']; ?>
                        </span></p>
                     <p>number : <span>
                           <?= $fetch_orders['number']; ?>
                        </span></p>
                     <p>address : <span>
                           <?= $fetch_orders['address']; ?>
                        </span></p>
                     <p>payment method : <span>
                           <?= $fetch_orders['method']; ?>
                        </span></p>
                     <p>your orders : <span>
                           <?= $fetch_orders['total_products']; ?>
                        </span></p>
                     <p>total price : <span>$
                           <?= $fetch_orders['total_price']; ?>/-
                        </span></p>
                     <p> payment status : <span style="color:<?php if ($fetch_orders['payment_status'] == 'pending') {
                        echo 'red';
                     } else {
                        echo 'green';
                     }
                     ; ?>">
                           <?= $fetch_orders['payment_status']; ?>
                        </span> </p>
                  </div>
                  <?php
               }
            } else {
               echo '<p class="empty">no orders placed yet!</p>';
            }
         }
         ?>

      </div>

   </section>
   <?php include 'components/footer.php'; ?>

   <script src="js/script.js"></script>

</body>

</html>