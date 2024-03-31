<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:admin_login.php');
};

if (isset($_POST['add_category'])) {

   
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size_01 = $_FILES['image']['size'];
   $image_tmp_name_01 = $_FILES['image']['tmp_name'];
   $image_folder_01 = '../uploaded_img/' . $image;


   $select_category = $conn->prepare("SELECT * FROM `category` WHERE name = ?");
   $select_category->execute([$name]);

   if ($select_category->rowCount() > 0) {
      $message[] = 'category name already exist!';
   } else {

      $insert_category = $conn->prepare("INSERT INTO `category`(name,image) VALUES(?,?)");
      $insert_category->execute([$name, $image]);

      if ($insert_category) {
         if ($image_size_01 > 2000000 ) {
            $message[] = 'image size is too large!';
         } else {
            move_uploaded_file($image_tmp_name_01, $image_folder_01);

            $message[] = 'new category added!';
         }
      }
   }
};

if (isset($_GET['delete'])) {

   $delete_id = $_GET['delete'];
   $delete_category_image = $conn->prepare("SELECT * FROM `category` WHERE id = ?");
   $delete_category_image->execute([$delete_id]);
   $fetch_delete_image = $delete_category_image->fetch(PDO::FETCH_ASSOC);
   unlink('../uploaded_img/' . $fetch_delete_image['image']);
   $delete_category = $conn->prepare("DELETE FROM `category` WHERE id = ?");
   $delete_category->execute([$delete_id]);
   header('location:category.php');
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>category</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>

<body>

   <?php include '../components/admin_header.php'; ?>

   <section class="add-products">

      <h1 class="heading">add category</h1>

      <form action="" method="post" enctype="multipart/form-data">
         <div class="flex">
            <div class="inputBox">
               <span>category name (required)</span>
               <input type="text" class="box" required maxlength="100"  name="name"  placeholder="Enter Category Name" >
            </div>
            <div class="inputBox">
               <span>image 01 (required)</span>
               <input type="file" name="image" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
            </div>

         </div>

         <input type="submit" value="add category" class="btn" name="add_category">
      </form>

   </section>

   <section class="show-products">

      <h1 class="heading">category added</h1>

      <div class="box-container">

         <?php
         $select_category = $conn->prepare("SELECT * FROM `category`");
         $select_category->execute();
         if ($select_category->rowCount() > 0) {
            while ($fetch_category = $select_category->fetch(PDO::FETCH_ASSOC)) {
         ?>
               <div class="box">
                  <img src="../uploaded_img/<?= $fetch_category['image']; ?>" alt="">
                  <div class="name"><?= $fetch_category['name']; ?></div>
                  <div class="flex-btn">
                     <a href="update_category.php?update=<?= $fetch_category['id']; ?>" class="option-btn">update</a>
                     <a href="category.php?delete=<?= $fetch_category['id']; ?>" class="delete-btn" onclick="return confirm('delete this category?');">delete</a>
                  </div>
               </div>
         <?php
            }
         } else {
            echo '<p class="empty">no category added yet!</p>';
         }
         ?>

      </div>

   </section>








   <script src="../js/admin_script.js"></script>

</body>

</html>