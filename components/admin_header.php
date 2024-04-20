<?php
if (isset($message)) {
   foreach ($message as $message) {
      if (
         $message === "product name already exist!"
         || $message === "category name already exist!"
         || $message === "Sub category name already exist!"
         || $message === "please enter old password!"
         || $message === "incorrect username or password!"
      ) {
         echo '
         <div class="message-warn">
            <span>' . $message . '</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
      } else {
         echo '
         <div class="message">
            <span>' . $message . '</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
      }


   }
}
?>

<header class="header">

   <section class="flex">


      <?php
      $current_page = basename($_SERVER['PHP_SELF']);
      if ($current_page !== 'dashboard.php') {
         echo '<a href="javascript:void(0);" onclick="goBack();" class="back-button navbar">
                <i class="fas fa-arrow-left"></i> Back
            </a>';
      }
      ?>
      <?php
      if ($current_page !== 'dashboard.php') {
         echo '<a href="javascript:void(0);" onclick="goForward();" class="forward-button navbar">
                    <i class="fas fa-arrow-right"></i> Forward
                  </a>';
      }
      ?>
      <a href="../admin/dashboard.php" class="logo "
         style="display: flex;justify-content: center;align-items: center;gap:2rem"><img src="../images/logo_board.png"
            width="150px" />

      </a>
      <nav class="navbar">
         <a href="../admin/dashboard.php">home</a>
         <a href="../admin/products.php">products</a>
         <a href="../admin/category.php">categories</a>
         <a href="../admin/subcategory.php">Subcategories</a>
         <a href="../admin/placed_orders.php">orders</a>
         <a href="../admin/admin_accounts.php">admins</a>
         <a href="../admin/users_accounts.php">users</a>
         <a href="../admin/messages.php">messages</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
         <?php
         $select_profile = $conn->prepare("SELECT * FROM `admins` WHERE id = ?");
         $select_profile->execute([$admin_id]);
         $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p><?= $fetch_profile['name']; ?></p>
         <a href="../admin/update_profile.php" class="btn">update profile</a>
        
         <?php if (!isset($fetch_profile["name"])) { ?>
                    <div class="flex-btn">
                        <a href="user_register.php" class="option-btn">register</a>
                        <a href="user_login.php" class="option-btn">login</a>
                    </div>
                <?php } ?>
         <a href="../components/admin_logout.php" class="delete-btn"
            onclick="return confirm('logout from the website?');">logout</a>
      </div>
      <div class="navbar">
         <p style="font-size: 20px;"><?= $fetch_profile['name']; ?></p>
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
      function goForward() {
         history.forward(); // Using the browser's forward function
      }

      function scrollFunction() {
         var backButton = document.querySelector('.back-button');
         if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            backButton.style.bottom = "10px"; // Adjust this value as needed
         } else {
            backButton.style.bottom = "20px"; // Adjust this value as needed
         }
         var forwardButton = document.querySelector('.forward-button');
         if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            forwardButton.style.bottom = "10px"; // Adjust this value as needed
         } else {
            forwardButton.style.bottom = "20px"; // Adjust this value as needed
         }
      }
      window.onload = function () {
         scrollFunction();
      };
   </script>

</header>