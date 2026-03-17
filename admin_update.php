<?php

include 'database.php';

$id = $_GET['update'];

if(isset($_POST['update_product'])){  

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_company = $_POST['product_company'];
   $product_image = $_FILES['product_image']['name'];
   $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
   $product_image_folder = 'uploaded_img/'.$product_image;

   if(empty($product_name) || empty($product_price)|| empty($product_company) || empty($product_image)){
      $message[] = 'Please fill out all!';    
   } else {
      // Escape single quotes in product_name
      $product_name = mysqli_real_escape_string($conn, $product_name);
      $update_data = "UPDATE products SET name='$product_name', price='$product_price', company='$product_company',image='$product_image' WHERE id='$id'";
      $upload = mysqli_query($conn, $update_data);

      if($upload){
         move_uploaded_file($product_image_tmp_name, $product_image_folder);
         header('Location: adminproduct_page.php');
      } else {
         $message[] = 'Failed to update product!'; 
      }
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <!-- <link rel="stylesheet" href="css/style.css"> -->
</head>
<body>
   <style>
       body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        #container {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 20px;
            margin: 50px auto;
            border-radius: 10px;
            max-width: 800px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        #admin {
            background-color: #444;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        #admin h2 {
            margin-bottom: 20px;
        }
        label {
            display: block;
            text-align: left;
            margin: 10px 0 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="number"],
        input[type="file"],
        select {
            width: calc(100% - 22px);
            padding: 10px;
            margin: 5px 0 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        input[type="submit"] {
            background-color: #28a745;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #218838;
        }
        #msg {
            display: block;
            background-color: #28a745;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 16px;
        }
        a {
            display: inline-block;
            margin-top: 15px;
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s;
        }
        a:hover {
            color: #0056b3;
        }

   </style>

<?php
   if(isset($message)){
      foreach($message as $msg){
         echo '<span id="msg">'.$msg.'</span>';
      }
   }
?>

<div id="container">
<div id="admin">
   <?php
      $select = mysqli_query($conn, "SELECT * FROM products WHERE id = '$id'");
      while($row = mysqli_fetch_assoc($select)){
   ?>
   
   <form action="" method="post" enctype="multipart/form-data">
      <h3 class="title">Update The Product</h3>
      <label for="name">Enter Product Name:</label> 
      <input type="text" name="product_name" id="box" value="<?php echo htmlspecialchars($row['name']); ?>"><br><br>
      <label for="name">Enter Product Price:</label> 
      <input type="number" name="product_price" id="box" value="<?php echo htmlspecialchars($row['price']); ?>"><br><br>
      <label for="name">Enter Product Company:</label> 
      <input type="text" name="product_company" id="box" value="<?php echo htmlspecialchars($row['company']); ?>"><br><br>

      <input type="file" id="box" name="product_image" accept="image/png, image/jpeg, image/jpg"><br><br>
      <input type="submit" value="update product" name="update_product" id="button"><br><br>
      <a href="adminproduct_page.php" id="btn">Go back!</a>
   </form>
   <?php } ?>
</div>
</div>

</body>
</html>