<style>
    .search-box {
        margin-top: 10px;
        margin-right: 30px;
        display: inline-block;
    }

    .search-input {
        font-size: 16px;
        width: 300px;
        padding: 6px;
        border: 1px solid #ccc;
        border-radius: 7px;
        outline: none;
        background-color: #F7FEFF;
    }

    .search-button {
        position: absolute;
        top: 50%;
        right: 10px;
        transform: translateY(-50%);
        font-size: 20px;
        padding: 6px;
        border: none;
        background: none;
        cursor: pointer;
    }

    .search-button i {
        color: #555;
    }
</style>
<?php
if (isset($message)) {
    foreach ($message as $msg) {
        if ($msg == "incorrect username or password!") {
            echo '
         <div class="message-warn">
            <span>' . $msg . '</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
        } else {
            echo '
         <div class="message">
            <span>' . $msg . '</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
        }
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
        echo '<a href="javascript:void(0);" onclick="goForward();" class="forward-button navbar">      
             <i class="fas fa-arrow-right"></i> Forward
           </a>';
    }
    ?>

    <section class="flex">

        <a href="home.php" class="logo " style="display: flex;justify-content: center;align-items: center;gap:2rem"><img src="images/logo_board.png" width="250px" />
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
            <!--<a href="search_page.php"><i class="fas fa-search"></i></a>-->
            <a href="wishlist.php"><i class="fas fa-heart"></i><span>(<?= $total_wishlist_counts; ?>)</span></a>
            <a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(<?= $total_cart_counts; ?>)</span></a>
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
                <?php if (!isset($fetch_profile["name"])) { ?>
                    <div class="flex-btn">
                        <a href="user_register.php" class="option-btn">register</a>
                        <a href="user_login.php" class="option-btn">login</a>
                    </div>
                <?php } ?>
                <a href="components/user_logout.php" class="delete-btn" onclick="return confirm('logout from the website?');">logout</a>
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
            <?php if (isset($fetch_profile["name"])) { ?>
                <h2 style="margin-right: 10px;">
                    Welcome <?= $fetch_profile["name"]; ?>
                </h2>
            <?php } ?>
        </div>
    </section>
    <div class="search-box">
        <form action="search_page.php" method="post">
            <input type="text" name="search_box" placeholder="    Search for products" maxlength="100" class="search-input">
            <button type="submit" class="search-button"><i class="fas fa-search"></i></button>
        </form>
    </div>


    <script>
        function goBack() {
            if (window.location.pathname !== 'http://localhost/Echri-Tounsi/home.php') {
                history.back();
            } else {
                window.location.href = 'other_page.php'; // Change 'other_page.php' to the desired fallback page
            }
        }

        function goForward() {
            history.forward(); // Using the browser's forward function
        }

        window.onscroll = function() {
            scrollFunction();
        };

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

        window.onload = function() {
            scrollFunction();
        };
    </script>
</header>