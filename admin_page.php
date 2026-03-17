<?php 
include 'database.php'; 
session_start(); 
if (!isset($_SESSION['admin_name'])) { 
    header('location:login_form.php'); 
} 
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
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        #container {
            background-color: #fff;
            color: #333;
            text-align: center;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            max-width: 500px;
            width: 100%;
            margin: 0 15px;
        }

        #h3 {
            font-size: 24px;
            margin: 10px 0;
            color: #555;
        }

        #h1 {
            color: #333;
            font-size: 36px;
            margin: 10px 0;
        }

        #p {
            font-size: 18px;
            color: #666;
            margin: 10px 0 20px 0;
        }

        #btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 18px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            margin: 10px 5px;
            transition: background-color 0.3s ease;
            cursor: pointer;
        }

        #btn:hover {
            background-color: #0056b3;
        }

        #btn:last-child {
            background-color: #28a745;
        }

        #btn:last-child:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<div id="container">
    <h3 id="h3">Hi, Admin</h3>
    <h1 id="h1">Welcome, <?php echo $_SESSION['admin_name']; ?></h1>
    <p id="p">This is an admin page.</p>
    <a href="logout.php" id="btn">Logout</a>
    <a href="adminproduct_page.php" id="btn">Add Product</a>
</div>

</body>
</html>
