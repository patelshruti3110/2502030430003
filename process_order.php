<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            color: #333;
            text-align: center;
            padding: 20px;
        }
        
        #confirmation-container {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            padding: 40px;
            max-width: 600px;
            margin: 50px auto;
        }
        
        h1 {
            font-size: 36px;
            color: #333;
        }
        
        h2 {
            font-size: 24px;
            color: #666;
            margin-bottom: 20px;
        }
        
        p {
            font-size: 18px;
            line-height: 1.6;
            color: #555;
            margin-bottom: 30px;
        }
        
        button {
            padding: 15px 30px;
            font-size: 18px;
            color: #fff;
            border: none;
            border-radius: 5px;
            margin: 10px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        
        #btn-continue {
            background-color: #28a745; /* Green */
        }
        
        #btn-continue:hover {
            background-color: #218838;
        }
        
        #btn-logout {
            background-color: #dc3545; /* Red */
        }
        
        #btn-logout:hover {
            background-color: #c82333;
        }
        
        a {
            color: inherit;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div id="confirmation-container">
    <h1>Order Confirmation</h1>
    <h2>Cash On Delivery</h2>
    <p id="p">
        Thank you for your shopping with us!<br>We will dispatch the product soon. The product will be delivered at your doorstep within 7 working days.<br>
        Enjoy 10% off on your next purchase with this coupon code: <strong>THANKYOU10</strong>.   
    </p>
    <button id="btn-continue"><a href="product_view.php">Continue Shopping</a></button>
    <button id="btn-logout"><a href="login_form.php">Logout</a></button>
</div>

</body>
</html>