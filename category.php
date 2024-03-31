<?php

include 'components/connect.php';
session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
}

include 'components/wishlist_cart.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>category</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="products">
   <h1 class="heading">category</h1>
   <div class="box-container">

   <?php
   if (isset($_GET['category'])) {
       $categoryName = $_GET['category'];

       // Fetch the category id based on the category name
       $selected_category_id = $conn->prepare("SELECT * FROM `category` WHERE name = :categoryName");
       $selected_category_id->bindParam(':categoryName', $categoryName);
       $selected_category_id->execute();
       $category = $selected_category_id->fetch(PDO::FETCH_ASSOC); // Use fetch instead of fetchAll

       // Check if the category exists
       if ($category) {
           // Fetch subcategory ids associated with the category
           $selected_sub_category_ids = $conn->prepare("SELECT * FROM `subcategory` WHERE category_id = :category_id");
           $selected_sub_category_ids->bindParam(':category_id', $category['id']);
           $selected_sub_category_ids->execute();
           $sub_category_ids = $selected_sub_category_ids->fetchAll(PDO::FETCH_COLUMN);
          
           // Fetch products based on the subcategory ids
           if (!empty($sub_category_ids)) {
               $placeholders = implode(',', array_fill(0, count($sub_category_ids), '?'));
               $sql = "SELECT * FROM `products` WHERE id_under_category IN ($placeholders)";
               $selected_products = $conn->prepare($sql);
               $selected_products->execute($sub_category_ids);
               $fetch_products = $selected_products->fetchAll(PDO::FETCH_ASSOC);

               if(count($fetch_products) > 0) {
                   foreach($fetch_products as $fetch_product) {
                       // Output product HTML
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
               } else {
                   echo '<p class="empty">No products found!</p>';
               }
           } else {
               echo '<p class="empty">No subcategories found!</p>';
           }
       } else {
           // Handle case when category does not exist
           echo "Category not found";
       }
   }
   ?>

   </div>
</section>

<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>
