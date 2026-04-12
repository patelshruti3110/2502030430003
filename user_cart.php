<?php
session_start();
include 'database.php';

$user_name = $_SESSION['user_name'] ?? 'guest';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'])) {

    $product_id = mysqli_real_escape_string($conn, $_POST['product_id']);
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $product_price = mysqli_real_escape_string($conn, $_POST['product_price']);
    $product_image = mysqli_real_escape_string($conn, $_POST['product_image']);
    $check = mysqli_query($conn, "
        SELECT * FROM cart 
        WHERE product_id='$product_id' 
        AND user_name='$user_name'
    ");

    if (mysqli_num_rows($check) > 0) {

        mysqli_query($conn, "
            UPDATE cart 
            SET quantity = quantity + 1 
            WHERE product_id='$product_id' 
            AND user_name='$user_name'
        ");

    } else {

        mysqli_query($conn, "
            INSERT INTO cart (user_name, product_id, product_name, product_price, product_image, quantity) 
            VALUES ('$user_name','$product_id','$product_name','$product_price','$product_image',1)
        ");
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['quantity'])) {

    foreach ($_POST['quantity'] as $product_id => $qty) {

        $qty = max(1, (int)$qty);

        mysqli_query($conn, "
            UPDATE cart 
            SET quantity='$qty' 
            WHERE product_id='$product_id' 
            AND user_name='$user_name'
        ");
    }
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];

    mysqli_query($conn, "
        DELETE FROM cart 
        WHERE product_id='$delete_id' 
        AND user_name='$user_name'
    ");

    header("Location: user_cart.php");
    exit();
}

$select = mysqli_query($conn, "
    SELECT * FROM cart 
    WHERE user_name='$user_name'
");

$grand_total = 0;
$total_quantity = 0;

$cart_items = [];

while ($row = mysqli_fetch_assoc($select)) {

    $subtotal = $row['product_price'] * $row['quantity'];

    $grand_total += $subtotal;
    $total_quantity += $row['quantity'];

    $row['subtotal'] = $subtotal;
    $cart_items[] = $row;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cart</title>
  
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f8f9fa;
      color: #333;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 20px;
    }

    .card {
      background-color: #fff;
      border: 1px solid #ddd;
      border-radius: 8px;
      margin-bottom: 20px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      margin: 0 auto;
      max-width: 1000px;
      /* Increase the max-width of the cart box */
    }

    .card-header {
      background-color: #007bff;
      color: #fff;
      padding: 15px;
      border-bottom: 1px solid #ddd;
      border-radius: 8px 8px 0 0;
      font-size: 20px;
    }

    .card-body {
      padding: 20px;
    }

    .row {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      margin-bottom: 20px;
    }

    .col-lg-3,
    .col-lg-5,
    .col-lg-4 {
      flex: 1;
      padding: 10px;
    }

    .bg-image {
      position: relative;
    }

    .bg-image img {
      max-width: 100%;
      height: auto;
      border-radius: 8px;
    }

    .btn {
      display: inline-block;
      padding: 10px 20px;
      font-size: 14px;
      border-radius: 5px;
      text-align: center;
      cursor: pointer;
      transition: background-color 0.3s ease;
      margin: 5px 0;
    }

    .btn-primary {
      background-color: #007bff;
      color: #fff;
      border: none;
    }

    .btn-primary:hover {
      background-color: #0056b3;
    }

    .btn-warning {
      background-color: #ffc107;
      color: #fff;
      border: none;
    }

    .btn-warning:hover {
      background-color: #e0a800;
    }

    .btn-danger {
      background-color: #dc3545;
      color: #fff;
      border: none;
    }

    .btn-danger:hover {
      background-color: #c82333;
    }

    .form-outline {
      width: 100px;
      margin: 0 10px;
    }

    .form-outline input {
      width: 100%;
      padding: 5px;
      font-size: 16px;
      border: 1px solid #ddd;
      border-radius: 5px;
    }

    .form-outline label {
      font-size: 12px;
      color: #555;
    }

    .summary-box {
      background-color: #fff;
      border: 1px solid #ddd;
      border-radius: 8px;
      padding: 20px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 400px;
      /* Increase the max-width of the summary box */
      margin-left: 20px;
    }

    .summary-box h5 {
      font-size: 18px;
      margin-bottom: 15px;
    }

    .summary-box p {
      margin: 5px 0;
    }
  </style>
</head>

<body>
  <?php include "navbar.php"; ?>

  <section class="h-100 gradient-custom">
    <div class="container">
      <div class="row d-flex justify-content-center my-4">
        <div class="col-md-8">
          <form method="POST" action="">
            <div class="card mb-4">
              <div class="card-header py-3">
                <h5 class="mb-0">Cart - <?php echo count($cart_items); ?> items</h5>
              </div>
              <div class="card-body">
                <?php foreach ($cart_items as $row) { ?>
                  <!-- Single item -->
                  <div class="row">
                    <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                      <!-- Image -->
                      <div class="bg-image hover-overlay hover-zoom ripple rounded" data-mdb-ripple-color="light">
                        <img src="uploaded_img/<?php echo htmlspecialchars($row['product_image']); ?>" class="w-100" alt="<?php echo htmlspecialchars($row['product_name']); ?>" />
                        <a href="#!">
                          <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
                        </a>
                      </div>
                      <!-- Image -->
                    </div>

                    <div class="col-lg-5 col-md-6 mb-4 mb-lg-0">
                      <!-- Data -->
                      <p><strong><?php echo htmlspecialchars($row['product_name']); ?></strong></p>
                      <div class="d-flex align-items-center mb-4 mt-4">
                        <!-- <a href="product_details.php?id=<?php echo htmlspecialchars($row['product_id']); ?>" class="btn btn-details btn-danger">Details</a> -->
                        <a href="user_cart.php?delete=<?php echo htmlspecialchars($row['product_id']); ?>" class="btn btn-sm btn-danger">Delete</a>
                      </div>
                      <!-- Data -->
                    </div>

                    <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                      <!-- Quantity -->
                      <div class="d-flex mb-4" style="max-width: 300px">
                        <div class="form-outline">
                          <input id="quantity-<?php echo $row['product_id']; ?>" min="1" name="quantity[<?php echo $row['product_id']; ?>]" value="<?php echo $row['quantity']; ?>" type="number" class="form-control" />
                          <label class="form-label" for="quantity-<?php echo $row['product_id']; ?>">Quantity</label>
                        </div>
                      </div>
                      <!-- Quantity -->

                      <!-- Price -->
                      <p class="text-start text-md-center">
                        <strong>₹<?php echo number_format($row['subtotal'], 2); ?></strong>
                      </p>
                      <!-- Price -->
                    </div>
                  </div>
                  <!-- Single item -->
                  <hr class="my-4" />
                <?php } ?>
                <button type="submit" class="btn btn-primary">Update Cart</button>
              </div>
            </div>
          </form>
        </div>
        <div class="col-md-4">
          <div class="summary-box">
            <h5>Order Summary</h5>
            <p>Total Quantity: <span id="total-quantity"><?php echo $total_quantity; ?></span></p>
            <p>Grand Total: ₹<span id="grand-total"><?php echo number_format($grand_total, 2); ?></span></p>
            <div class="d-flex justify-content-between align-items-center mt-3">
              <!-- <a href="wishlist.php" class="btn btn-warning"> -->
                <!-- <i class="fas fa-heart"></i> Wishlist -->
              <!-- </a> -->
              <form action="checkout.php" method="POST">
                <input type="hidden" name="grand_total" value="<?php echo $grand_total; ?>">
                <button type="submit" class="btn btn-danger">Buy Now</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</body>

</html>