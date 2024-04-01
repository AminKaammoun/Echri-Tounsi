<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:admin_login.php');
}
;
$select_categories = $conn->prepare("SELECT * FROM `category`");
$select_categories->execute();
$categories = $select_categories->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['add_subcategory'])) {

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    $cate = intval($_POST['category']);
   $cate = filter_var($cate, FILTER_SANITIZE_STRING);

    $select_subcategories = $conn->prepare("SELECT * FROM `subcategory` WHERE name = ?");
    $select_subcategories->execute([$name]);

    if ($select_subcategories->rowCount() > 0) {
        $message[] = 'Sub category name already exist!';
    } else {

        $insert_subcategories = $conn->prepare("INSERT INTO `subcategory`(name, category_id) VALUES(?,?)");
        $insert_subcategories->execute([$name, $cate]);

        if ($insert_subcategories) {
            $message[] = 'new subcategory added!';
        }
    }
}
;

if (isset($_GET['delete'])) {

    $delete_id = $_GET['delete'];
    $delete_category = $conn->prepare("DELETE FROM `subcategory` WHERE id = ?");
    $delete_category->execute([$delete_id]);
    header('location:subcategory.php');
 }


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>subcategory</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <link rel="stylesheet" href="../css/admin_style.css">

</head>

<body>

    <?php include '../components/admin_header.php'; ?>

    <section class="add-products">

        <h1 class="heading">add SubCategory</h1>

        <form action="" method="post" enctype="multipart/form-data">
            <div class="flex">
                

                <div class="inputBox">
                    <span>category (required)</span>
                    <select name="category" id="category" class="box" required>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category['id']; ?>">
                                <?= $category['name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="inputBox">
                    <span>Subcategory name</span>
                    <input type="text" class="box" required maxlength="100" placeholder="enter SubCategory name"
                        name="name">
                </div>
            </div>

            <input type="submit" value="add SubCategory" class="btn" name="add_subcategory">
        </form>

    </section>

    <section class="show-products">

        <h1 class="heading">Subcategories </h1>

        <div class="box-container">

            <?php
            $select_subcategories = $conn->prepare("SELECT * FROM `subcategory`");
            $select_subcategories->execute();
            if ($select_subcategories->rowCount() > 0) {
                while ($fetch_subcategories = $select_subcategories->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <div class="box">
                        <div class="name">
                            <?= $fetch_subcategories['name']; ?>
                        </div>
                        <div class="flex-btn">
                            <a href="update_subcategory.php?update=<?= $fetch_subcategories['id']; ?>" class="option-btn">update</a>
                            <a href="subcategory.php?delete=<?= $fetch_subcategories['id']; ?>" class="delete-btn"
                                onclick="return confirm('delete this subcategory?');">delete</a>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo '<p class="empty">no subcategories added yet!</p>';
            }
            ?>

        </div>

    </section>








    <script src="../js/admin_script.js"></script>

</body>

</html>