<?php

include'navbar.php';
include'database.php';

session_start();

if(isset($_POST['submit'])){

   // $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   // $cpass = md5($_POST['cpassword']);
   // $user_type = $_POST['user_type'];

   $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $row = mysqli_fetch_array($result);

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_name'] = $row['name'];
         header('location:admin_page.php');

      }elseif($row['user_type'] == 'user'){

         $_SESSION['user_name'] = $row['name'];
         header('location:user_page.php');

      }
     
   }else{
      $error[] = 'incorrect email or password!';
   }

};
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login form</title>


</head>
<body>
   <style>
      body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 30px;
            margin: 100px auto;
            border-radius: 10px;
            max-width: 400px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h3 {
            text-align: center;
            margin-bottom: 20px;
            color: #fff;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #fff;
        }

        .form-group input[type="email"],
        .form-group input[type="password"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin: 5px 0 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .form-group input[type="checkbox"] {
            margin-right: 5px;
        }

        .btn {
            background-color: #28a745;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }

        .btn:hover {
            background-color: #218838;
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
        }

        .login-link a {
            color: #007bff;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .msg {
            display: block;
            background-color: #dc3545;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 16px;
        }

   </style>
   
<!-- <div id="login">

   <form action="" method="post">
      <h3>Login now</h3>
      <?php
      // if(isset($error)){
      //    foreach($error as $error){
      //       echo '<span id="errormsg">'.$error.'</span>';
      //    };
      // };
      // ?>

      <label for="email">Email:</label> 
      <input type="email" name="email" id="email"><br><br>
      <label for="password">Password:</label> 
      <input type="password" name="password" id="password"><br><br> 
       <input type="submit" name="submit" value="Login now" id="s1">
      
      <p>don't have an account? <a href="register_form.php">Register now</a></p>
   </form>

</div> -->
<div class="container">
        <form action="" method="post">
            <h3>Login Now</h3>
            <?php
            if (isset($error)) {
                foreach ($error as $error) {
                    echo '<span class="msg">' . htmlspecialchars($error) . '</span>';
                }
            }
            ?>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>
            </div>
            <input type="submit" name="submit" value="Login now" class="btn">
            <div class="login-link">
                <p>Don't have an account? <a href="register_form.php">Register now</a></p>
            </div>
        </form>
    </div>
</body>
</html>