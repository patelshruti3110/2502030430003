<?php
session_start();
include 'database.php';

$user_name = $_SESSION['user_name'];

$product_id = $_POST['product_id'];
$product_name = $_POST['product_name'];
$product_price = $_POST['product_price'];
$product_image = $_POST['product_image'];

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
?>