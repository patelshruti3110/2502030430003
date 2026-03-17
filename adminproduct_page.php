<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Establish database connection
$conn = mysqli_connect("localhost", "root", "", "shruti");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$message = []; // Initialize an empty array for messages

if (isset($_POST['add_product'])) {
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $product_price = mysqli_real_escape_string($conn, $_POST['product_price']);
    $product_company = isset($_POST['product_company']) ? mysqli_real_escape_string($conn, $_POST['product_company']) : '';

    // File upload handling
    $product_image_name = $_FILES['product_image']['name'];
    $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
    $product_image_folder = 'uploaded_img/' . basename($product_image_name);

    // Validate inputs
    if (empty($product_name) || empty($product_price) || empty($product_company) || empty($product_image_name)) {
        $message[] = 'Please fill out all fields.';
    } else {
        // Check for valid image file
        $allowed_types = array('jpg', 'jpeg', 'png');
        $file_extension = pathinfo($product_image_name, PATHINFO_EXTENSION);
        if (!in_array($file_extension, $allowed_types)) {
            $message[] = 'Invalid file type. Only JPG, JPEG, and PNG are allowed.';
        } else {
            // Insert into database
            $insert = "INSERT INTO products (name, price, company, image) VALUES ('$product_name', '$product_price', '$product_company', '$product_image_name')";
            $upload = mysqli_query($conn, $insert);
            if ($upload) {
                if (move_uploaded_file($product_image_tmp_name, $product_image_folder)) {
                    $message[] = 'New product added successfully.';
                } else {
                    $message[] = 'Failed to upload the image. Please check directory permissions.';
                }
            } else {
                $message[] = 'Could not add the product. Please try again.';
            }
        }
    }
}

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    mysqli_query($conn, "DELETE FROM products WHERE id = $id");
    header('location: adminproduct_page.php');
}

// Fetch products from database
$select = mysqli_query($conn, "SELECT * FROM products");
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Page</title>
   <style>
     body {
         font-family: Arial, sans-serif;
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

      #product-display-table {
         width: 100%;
         border-collapse: collapse;
         margin: 20px 0;
      }

      #product-display-table th,
      #product-display-table td {
         padding: 12px;
         border: 1px solid #ddd;
         text-align: center;
      }

      #product-display-table th {
         background-color: #28a745;
         color: #fff;
      }

      #product-display-table td img {
         max-width: 100px;
      }

      #product-display-table a {
         display: inline-block;
         margin: 5px;
         padding: 5px 10px;
         border-radius: 5px;
         text-decoration: none;
         color: #fff;
      }

      #product-display-table a.update {
         background-color: #007bff;
      }

      #product-display-table a.delete {
         background-color: #dc3545;
      }

      #product-display-table a.cart {
         background-color: #ffc107;
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
   </style>
</head>

<body>

   <?php
   if (isset($message)) {
      foreach ($message as $msg) {
         echo '<span id="msg">' . htmlspecialchars($msg) . '</span>';
      }
   }
   ?>

   <div id="container">

      <div id="admin">

         <form action="adminproduct_page.php" method="post" enctype="multipart/form-data">
            <h2 id="h3">Add a new product</h2>
            <label for="product_name">Product Name:</label>
            <input type="text" name="product_name" id="box" required> <br>

            <label for="product_price">Product Price:</label>
            <input type="number" name="product_price" id="box" required><br>

            <label for="product_company">Select Company Name:</label>
            <select name="product_company" id="box" required>
               <option value="">Select Company</option>
               <option value="Adidas">Adidas</option>
               <option value="Campus">Campus</option>
               <option value="Nike">Nike</option>
               <option value="Puma">Puma</option>
               <option value="Skechers">Skechers</option>
            </select><br>
            <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_image" id="box" required><br><br>
            <input type="submit" id="submit" name="add_product" value="Add Product">
         </form>

      

      </div>

      <?php
      $i = 1;
      $select = mysqli_query($conn, "SELECT * FROM products");
      ?>

      <div id="product-display">
         <table id="product-display-table">
            <thead id="thead">
               <tr>
                  <th id="th">Product Number</th>
                  <th id="th">Product Image</th>
                  <th id="th">Product Name</th>
                  <th id="th">Product Price</th>
                  <th id="th">Product Company</th>
                  <th id="th">Action</th>

               </tr>
            </thead>
            <tbody>
               <?php while ($row = mysqli_fetch_assoc($select)) { ?>
                  <tr>
                     <td id="td"><?php echo $i; ?></td>
                     <td id="td"><img src="uploaded_img/<?php echo htmlspecialchars($row['image']); ?>" height="100" alt=""></td>
                     <td id="td"><?php echo htmlspecialchars($row['name']); ?></td>
                     <td id="td"><?php echo htmlspecialchars($row['price']); ?></td>
                     <td id="td"><?php echo htmlspecialchars($row['company']); ?></td>
                     <td id="td">
                        <a href="admin_update.php?update=<?php echo $row['id']; ?>" id="btn">Update</a>
                        <a href="adminproduct_page.php?delete=<?php echo $row['id']; ?>" id="btn">Delete</a>
                        <!-- <a href="product_cart.php?cart=<?php echo $row['id']; ?>" id="btn">Cart</a> -->
                     </td>
                  </tr>
               <?php
                  $i++;
               } ?>
            </tbody>
         </table>
      </div>

   </div>

</body>

</html>