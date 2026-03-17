<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shoe Store - Home</title>
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
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            box-sizing: border-box;
        }

        .hero {
            text-align: center;
            padding: 40px 20px;
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
    <?php
    include 'navbar.php';
    include 'database.php';
    ?>

    <div class="page-wrapper">
        <?php
        if (!empty($message)) {
            foreach ($message as $msg) {
                echo '<div class="message">' . htmlspecialchars($msg) . '</div>';
            }
        }
        ?>
        <div class="hero">
            <h1>IF THE SHOE FITS, BUY IT!</h1>
            <p>Welcome to Shoe Haven, your ultimate destination for stylish, comfortable, and high-quality footwear.<br>We believe that shopping for shoes should be enjoyable and hassle-free.</p>
            <a href="login_form.php" class="btn">Shop Now</a>
        </div>
        <div class="product-list">
            <?php
            $showData = "SELECT * FROM products";
            $showRes = mysqli_query($conn, $showData);

            // Check if the query was successful
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
                            <!-- <a href="user_cart.php" class="btn btn-add-to-cart" onclick="addToCart(<?php echo htmlspecialchars($fetch['id']); ?>)">Add to Cart</a> -->
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

    <script>
        function addToCart(productId) {
            // Replace this with your add to cart logic, e.g., AJAX request
            alert('Product added to cart! Product ID: ' + productId);
        }
    </script>
</body>
</html>