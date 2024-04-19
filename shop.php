<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};
$category = isset($_GET['category']) ? $_GET['category'] : 'All';
include 'components/wishlist_cart.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>shop</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">


</head>
<body>

<div class="sidebar">
<footer class="footer" id="footer">
        <section class="grid">
            <div class="box">
                <h3>Filter by category</h3>
             
                <a href="shop.php?category=All"> <i class="fas fa-angle-right"></i> All</a>
                <a href="shop.php?category=Male"> <i class="fas fa-angle-right"></i> Male Clothes</a>
                <a href="shop.php?category=Female"> <i class="fas fa-angle-right"></i> Female Clothes</a>
                <a href="shop.php?category=Kids"> <i class="fas fa-angle-right"></i> Kids Clothes</a>
                <a href="shop.php?category=Dates"> <i class="fas fa-angle-right"></i> Dates</a>
                <a href="shop.php?category=Oil"> <i class="fas fa-angle-right"></i> Oil</a>
                <a href="shop.php?category=Traditional sweet"> <i class="fas fa-angle-right"></i> Traditional Sweets</a>
                <a href="shop.php?category=Key ring"> <i class="fas fa-angle-right"></i> Key Ring</a>
                <a href="shop.php?category=Magnetic sticker"> <i class="fas fa-angle-right"></i> Magnetic Sticker</a>
                <a href="shop.php?category=Craftmanship"> <i class="fas fa-angle-right"></i> Craftmanship</a>
            </div>
        </section>
    </footer>
</div>

<?php include 'components/user_header.php'; ?>

<section class="products">
    <h1 class="heading">Products</h1>
    <h5 class="heading" style="color: grey;"><?php echo ucfirst($category); ?></h5>
   <div class="box-container">
      
      <?php
      if($category === 'All'){
         $select_products = $conn->prepare("SELECT * FROM `products`"); 
      }else{
         $select_products = $conn->prepare("SELECT * FROM `products` WHERE id_under_category = (SELECT id FROM subcategory WHERE name = :category)"); 
         $select_products->bindParam(':category', $category);
      }
         $select_products->execute();
         if($select_products->rowCount() > 0){
            while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
      ?>
      <form action="" method="post" class="box">
         <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
         <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
         <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
         <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
         <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
         <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>
         <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
         <div class="name"><?= $fetch_product['name']; ?></div>
         <div class="flex">
            <div class="price"><span>$</span><?= $fetch_product['price']; ?><span>/-</span></div>
            <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
         </div>
         <input type="submit" value="add to cart" class="btn" name="add_to_cart">
      </form>
      <?php
         }
      }else{
         echo '<p class="empty">no products found!</p>';
      }
      ?>
   </div>
</section>

<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>
