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

   <style>
      .breadcrumb {
         text-align: left;
         font-size: 18px;

      }

      .breadcrumb a {
         text-decoration: none;
         color: #555;
      }

      .breadcrumb a:hover {
         color: #007bff;
      }
   </style>
</head>

<body>

   <?php include 'components/user_header.php'; ?>

   <section class="orders">

      <div class="breadcrumb">
         <a href="home.php">Home</a> / Orders
      </div>

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
            $number_orders = $select_orders->rowCount();
            $number = 1;
            if ($select_orders->rowCount() > 0) {
               while ($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)) {
                  ?>
                  <div class="box">
                     <section class="order">
                        <h3>Order num: <?php echo $number ?></h3>
                        <div class="flex">
                           <div class="order-details">

                              <table>
                                 <tr>
                                    <td>
                                       <p>Order date :</p>
                                    </td>
                                    <td>
                                       <p>
                                          <span class="order-info">
                                             <?= $fetch_orders['placed_on']; ?>
                                          </span>
                                       </p>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td>
                                       <p>name :</p>
                                    </td>
                                    <td>
                                       <span class="order-info">
                                          <?= $fetch_orders['name']; ?>
                                       </span>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td>
                                       <p>email:</p>
                                    </td>
                                    <td>
                                       <span class="order-info">
                                          <?= $fetch_orders['email']; ?>
                                       </span>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td>
                                       <p>number:</p>
                                    </td>
                                    <td>
                                       <span class="order-info">
                                          <?= $fetch_orders['number']; ?>
                                       </span>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td>
                                       <p>address:</p>
                                    </td>
                                    <td>
                                       <span class="order-info">
                                          <?= $fetch_orders['address']; ?>
                                       </span>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td>
                                       <p>payment method:</p>
                                    </td>
                                    <td>
                                       <span class="order-info">
                                          <?= $fetch_orders['method']; ?>
                                       </span>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td>
                                       <p>your orders:</p>
                                    </td>
                                    <td>
                                       <span class="order-info">
                                          <?= $fetch_orders['total_products']; ?>
                                       </span>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td>
                                       <p>total price:</p>
                                    </td>
                                    <td>
                                       <span class="order-info">
                                          <?= $fetch_orders['total_price']; ?>
                                       </span>
                                    </td>
                                 </tr>
                              </table>
                           </div>
                           <h3
                              style="background-color: <?= ($fetch_orders['payment_status'] == "pending") ? '#e74c3c' : '#69d981'; ?> ;">
                              payment status: <?= $fetch_orders['payment_status']; ?></h3>
                           <?php $number++; ?>
                        </div>
                     </section>

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