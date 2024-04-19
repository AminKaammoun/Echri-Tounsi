<?php
if (isset($message)) {
   foreach ($message as $message) {
      echo '
         <div class="message">
            <span>' . $message . '</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
   }
}
?>

<header class="header">
   <?php
   $current_page = basename($_SERVER['PHP_SELF']);
   if ($current_page !== 'home.php') {
      echo '<a href="javascript:void(0);" onclick="goBack();" class="back-button navbar">
                 <i class="fas fa-arrow-left"></i> Back
             </a>';
   }
   ?>
   <section class="flex">

      <a href="home.php" class="logo " style="display: flex;justify-content: center;align-items: center;gap:2rem"><img
            src="images/logo_board.png" width="250px" />

      </a>

      <nav class="navbar">
         <a href="home.php">Home</a>
         <a href="about.php">About</a>
         <a href="orders.php">Orders</a>
         <a href="shop.php">Shop</a>
         <a href="contact.php">Contact</a>
      </nav>

      <div class="icons">
         <?php
         $count_wishlist_items = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
         $count_wishlist_items->execute([$user_id]);
         $total_wishlist_counts = $count_wishlist_items->rowCount();

         $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
         $count_cart_items->execute([$user_id]);
         $total_cart_counts = $count_cart_items->rowCount();
         ?>
         <div id="menu-btn" class="fas fa-bars"></div>
         <a href="search_page.php"><i class="fas fa-search"></i></a>
         <a href="wishlist.php"><i class="fas fa-heart"></i><span>(
               <?= $total_wishlist_counts; ?>)
            </span></a>
         <a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(
               <?= $total_cart_counts; ?>)
            </span></a>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
         <?php
         $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
         $select_profile->execute([$user_id]);
         if ($select_profile->rowCount() > 0) {
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
            ?>
            <p>
               <?= $fetch_profile["name"]; ?>
            </p>
            <a href="update_user.php" class="btn">update profile</a>
            <div class="flex-btn">
               <a href="user_register.php" class="option-btn">register</a>
               <a href="user_login.php" class="option-btn">login</a>
            </div>
            <a href="components/user_logout.php" class="delete-btn"
               onclick="return confirm('logout from the website?');">logout</a>
            <?php
         } else {
            ?>
            <p>please login or register first!</p>
            <div class="flex-btn">
               <a href="user_register.php" class="option-btn">register</a>
               <a href="user_login.php" class="option-btn">login</a>
            </div>
            <?php
         }
         ?>


      </div>
      <div>
         <p>
            <?= $fetch_profile["name"]; ?>
         </p>
      </div>

   </section>
   <script>
      function goBack() {
         if (window.location.pathname !== 'http://localhost/Echri-Tounsi/home.php') {
            history.back();
         } else {
            window.location.href = 'other_page.php'; // Change 'other_page.php' to the desired fallback page
         }
      }
      window.onscroll = function () { scrollFunction() };

      function scrollFunction() {
         var backButton = document.querySelector('.back-button');
         if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            backButton.style.bottom = "10px"; // Adjust this value as needed
         } else {
            backButton.style.bottom = "20px"; // Adjust this value as needed
         }
      }
      window.onload = function () {
         scrollFunction();
      };
   </script>
</header>