<?php

// Basic MySQL credentials for XAMPP
$server = "localhost";
$user   = "root";
$pass   = "";

// Connect to MySQL server (without database first)
$conn = mysqli_connect($server, $user, $pass);
if (!$conn) {
    die("Server not connected..!<br>" . mysqli_connect_error());
}

// Create database if it doesn't exist
$database       = "shruti";
$databaseCreate = "CREATE DATABASE IF NOT EXISTS `$database`";
$res            = mysqli_query($conn, $databaseCreate);

if (!$res) {
    die("Database NOT Created<br>" . mysqli_error($conn));
}

// Reconnect selecting the database
$conn = mysqli_connect($server, $user, $pass, $database);
if (!$conn) {
    die("Database connection failed..!<br>" . mysqli_connect_error());
}

// ---- TABLE DEFINITIONS USED ACROSS PROJECT ----

// 1) Demo users table used by showData.php
$createUsersTable = "CREATE TABLE IF NOT EXISTS `users` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `password` VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

// 2) Main auth table used by register_form.php & login_form.php
$createUserFormTable = "CREATE TABLE IF NOT EXISTS `user_form` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(100) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `user_type` ENUM('admin','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

// 3) Products table used by adminproduct_page.php, home.php, user_page.php, etc.
$createProductsTable = "CREATE TABLE IF NOT EXISTS `products` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(150) NOT NULL,
    `price` DECIMAL(10,2) NOT NULL,
    `company` VARCHAR(100) NOT NULL,
    `image` VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

// 4) Cart table used by user_cart.php
$createCartTable = "CREATE TABLE IF NOT EXISTS `cart` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_name` VARCHAR(100) NOT NULL,
    `product_id` INT NOT NULL,
    `product_name` VARCHAR(150) NOT NULL,
    `product_price` DECIMAL(10,2) NOT NULL,
    `product_image` VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

// Execute all table creation queries safely
$tableQueries = [
    $createUsersTable,
    $createUserFormTable,
    $createProductsTable,
    $createCartTable,
];

foreach ($tableQueries as $sql) {
    if (!mysqli_query($conn, $sql)) {
        die("Error creating table: " . mysqli_error($conn));
    }
}

?>

<?php

$server = "localhost";
$user = "root";
$pass = "";

$conn = mysqli_connect($server, $user, $pass);
if(!$conn){
    die("Server not connected..!<br>");

}

$database = "shruti";

$databaseCreate = "CREATE DATABASE IF NOT EXISTS $database";
$res = mysqli_query($conn, $databaseCreate);

if(!$res){
    die("Database  NOT Created<br>");
}

$conn = mysqli_connect($server, $user, $pass,$database);

$table = "users";

$createTable = "CREATE TABLE IF NOT EXISTS $table(
id int AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(100),
email VARCHAR(100),
password VARCHAR(100)
)";
$resTable = mysqli_query($conn, $createTable);
if(!$resTable){
    die ("Table Created..!");
}

?>