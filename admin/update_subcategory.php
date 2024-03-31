<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_POST['update'])){

   $pid = $_POST['pid'];
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   

   
   $cate = intval($_POST['category']);
   $cate = filter_var($cate, FILTER_SANITIZE_STRING);

   
   
   
   $update_product = $conn->prepare("UPDATE `subcategory` SET name = ?, category_id = ? WHERE id = ?");
   $update_product->execute([$name, $cate,$pid]);

   $message[] = 'subcategory updated successfully!';

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>update subcategory</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="update-product">

   <h1 class="heading">update subcategory</h1>

   <?php
      $update_id = $_GET['update'];
      $select_products = $conn->prepare("SELECT * FROM `subcategory` WHERE id = ?");
      $select_products->execute([$update_id]);
      if($select_products->rowCount() > 0){
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
   
            $select_categories = $conn->prepare("SELECT * FROM `category`");
            $select_categories->execute();
            $categories = $select_categories->fetchAll(PDO::FETCH_ASSOC);
            
            
    
   ?>


   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
      
      
      <span>update name</span>
      <input type="text" name="name" required class="box" maxlength="100" placeholder="enter product name" value="<?= $fetch_products['name']; ?>">
      
      
               <span>category</span>
               <select name="category" id="category" class="box" required>
                  <?php foreach ($categories as $category): ?>
                     <option value="<?= $category['id']; ?>"><?= $category['name']; ?></option>
                  <?php endforeach; ?>
               </select> 
          

          
               
 
      
      
      
      <div class="flex-btn">
         <input type="submit" name="update" class="btn" value="update">
         <a href="subcategory.php" class="option-btn">go back</a>
      </div>
   </form>
   
   <?php
         }
      }else{
         echo '<p class="empty">no product found!</p>';
      }
   ?>

</section>












<script src="../js/admin_script.js"></script>
   
</body>
</html>