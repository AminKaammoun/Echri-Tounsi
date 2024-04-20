<!--
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



      <div class="search-box">
         <form action="search_page.php" method="post">
            <input type="text" name="search_box" placeholder="Search here..." maxlength="100" class="search-input" style="font-size: 16px; width: 150px; padding: 6px;" required>
            <button type="submit" class="search-button" name="search_btn" style="font-size: 20px; padding: 6px; border: none; background: none;"><i class="fas fa-search"></i></button>
         </form>
      </div>


   </section>



</header>