<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$grand_total = $_POST['grand_total'];
// } else {
// header('Location: cart.php');
// exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>payment details</title>
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
padding: 20px;
}
.card-header {
background-color: #007bff;
color: #fff;
padding: 15px;
border-radius: 8px 8px 0 0;
font-size: 20px;
}
.form-group {
margin-bottom: 15px;
}
.form-group label {
display: block;
margin-bottom: 5px;
font-weight: bold;
}
.form-group input {
width: 100%;
padding: 10px;
font-size: 16px;
border: 1px solid #ddd;
border-radius: 5px;
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
</style>
</head>
<body>
<div class="container">
<div class="card">
<div class="card-header">
PAYMENT DETAILS
</div>
<div class="card-body">
<h5>Order Summary</h5>
<p>Grand Total: ₹<?php echo number_format($grand_total, 2); ?></p>
<form action="process_order.php" method="POST">
<div class="form-group">
<label for="name">Name</label>
<input type="text" id="name" name="name" required>
</div>
<div class="form-group">
<label for="address">Address</label>
<input type="text" id="address" name="address" required>
</div>
<div class="form-group">
<label for="email">Email</label>
<input type="email" id="email" name="email" required>
</div>
<div class="form-group">
<label for="phone">Phone</label>
<input type="tel" id="phone" name="phone" required>
</div>
<input type="hidden" name="grand_total" value="<?php echo $grand_total;
?>">
<button type="submit" class="btn btn-primary">Place Order</button>
</form>
</div>
</div>
</div>
</body>
</html>