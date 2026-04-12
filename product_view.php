<?php
session_start();
include 'database.php'; // Ensure this line is included
include 'navbar.php';

if (!isset($_SESSION['user_name'])) { 
    header('location:login_form.php'); 
    exit();
}

$user_name = $_SESSION['user_name'];
$message = [];

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

    
    header("Location: user_cart.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shoe Store - Products</title>
    <style>
        /* Universal Styles */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        /* Layout wrapper below navbar */
        .page-wrapper {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            box-sizing: border-box;
            text-align: center;
        }

        h2 {
            margin-bottom: 40px;
            font-size: 36px;
            color: #333;
        }

        /* Product List Styling */
        .product-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        /* Product Item Styling */
        .product-item {
            background-color: #fff;
            margin: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            overflow: hidden;
            width: calc(33.333% - 30px);
            display: flex;
            flex-direction: column;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .product-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 6px 15px rgba(0,0,0,0.15);
        }

        /* Product Image Styling */
        .product-image {
            width: 100%;
            height: auto;
        }

        #img1 {
            height: 250px;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f9f9f9;
            padding: 10px;
        }

        #img1 img {
            max-height: 100%;
            max-width: 100%;
            object-fit: contain;
        }

        /* Product Details Styling */
        .product-details {
            padding: 20px;
            text-align: left;
            flex-grow: 1;
        }

        .product-details h3 {
            margin: 0 0 15px;
            font-size: 22px;
            color: #333;
        }

        .product-details p {
            margin: 0 0 20px;
            font-size: 18px;
            color: #666;
        }

        /* Button Styling */
        .btn {
            display: inline-block;
            padding: 10px 15px;
            background-color: #4CAF50;
            color: #fff;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .btn-details {
            background-color: #2196F3;
            margin-right: 10px;
        }

        .btn-add-to-cart {
            background-color: #ff9800;
        }

        .btn:hover {
            opacity: 0.9;
        }

        /* Error Message Styling */
        .message {
            margin-top: 20px;
            padding: 10px;
            background-color: #f44336;
            color: white;
            border-radius: 5px;
            text-align: center;
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .product-item {
                width: calc(50% - 30px);
            }
        }

        @media (max-width: 768px) {
            .page-wrapper {
                padding: 15px;
            }

            .product-item {
                width: 100%;
                margin: 10px 0;
            }

            h2 {
                font-size: 28px;
            }

            .product-details h3 {
                font-size: 20px;
            }

            .product-details p {
                font-size: 16px;
            }

            .btn {
                font-size: 14px;
                padding: 8px 12px;
            }
        }
    </style>
</head>
<body>
    <div class="page-wrapper">
        <h2 id="h2">Welcome <?php echo $_SESSION['user_name']; ?></h2>
       
        <?php
        if (!empty($message)) {
            foreach ($message as $msg) {
                echo '<div class="message">' . htmlspecialchars($msg) . '</div>';
            }
        }
        ?>

        <div class="product-list">
            <?php
            $showData = "SELECT * FROM products";
            $showRes = mysqli_query($conn, $showData);

            if ($showRes) {
                while ($fetch = mysqli_fetch_assoc($showRes)) {
                    ?>
                    <div class="product-item">
                        <div id="img1">
                            <img src="uploaded_img/<?php echo htmlspecialchars($fetch['image']); ?>" alt="<?php echo htmlspecialchars($fetch['name']); ?>" class="product-image">
                        </div>
                        <div class="product-details">
                            <h3><?php echo htmlspecialchars($fetch['name']); ?></h3>
                            <p>Rs. <?php echo htmlspecialchars($fetch['price']); ?></p>

                            <form method="POST" action="" style="display:inline;">
                                <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($fetch['id']); ?>">
                                <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($fetch['name']); ?>">
                                <input type="hidden" name="product_price" value="<?php echo htmlspecialchars($fetch['price']); ?>">
                                <input type="hidden" name="product_image" value="<?php echo htmlspecialchars($fetch['image']); ?>">
                                <button type="submit" class="btn btn-add-to-cart">Add to Cart</button>
                            </form>

                        </div>
                    </div>
                    <?php
                }
            } else {
                echo '<div class="message">Failed to fetch products: ' . mysqli_error($conn) . '</div>';
            }
            ?>
        </div>
    </div>
</body>
</html>
