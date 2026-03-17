<?php

include'navbar.php';
include'database.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $user_type = $_POST['user_type'];

   $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $error[] = 'user already exist!';

   }else{

      if($pass != $cpass){
         $error[] = 'password not matched!';
      }else{
         $insert = "INSERT INTO user_form(name, email, password, user_type) VALUES('$name','$email','$pass','$user_type')";
         mysqli_query($conn, $insert);
         header('location:login_form.php');
      }
   }

};


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register form</title>

</head>
<body>
   
<div id="formcontainer">
   <style>
      /* #formcontainer{
         background-color: black;
         color: white;
         text-align: center; 
         margin-top: 4%;
         margin-left: 340px;
         margin-right: 340px;
         border: solid;
         padding: 10px; 
         font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif
      
      }

      #h3{
         font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif
      }

      #s1 { 
            color: black; 
            background-color: white; 
            padding: 8px; 
            margin-bottom: 10px; 
            cursor: pointer; 
            border-radius: 10px; 
            width: 25%; 
            border: 1px hidden; 
        } 
 
        #s1:hover { 
            background-color: gray;
            border: 1px solid white; 
            color: white; 
        }

        #option{
         background-color: white;
         color: black;
         cursor: pointer;
         border-radius: 10px;
         width: 25%;
         margin-top: 10px;
         padding: 8px;
        }
        #errormsg{
         margin: 10px 0;
         display: block;
         background: white;
         color: black;
         font-size: 20px;
         margin:10px 0;
         display: block;
         background: white;
         color: black;
         border-radius: 5px;
         font-size: 20px;
         padding: 10px;
        } */

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

      h2 {
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

      .form-group input[type="text"],
      .form-group input[type="email"],
      .form-group input[type="password"],
      .form-group select {
         width: calc(100% - 22px);
         padding: 10px;
         margin: 5px 0 20px;
         border: 1px solid #ccc;
         border-radius: 5px;
         font-size: 16px;
      }

      .form-group select {
         background-color: #fff;
         color: #333;
         cursor: pointer;
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

      .register-link {
         text-align: center;
         margin-top: 20px;
      }

      .register-link a {
         color: #007bff;
         text-decoration: none;
      }

      .register-link a:hover {
         text-decoration: underline;
      }

      .msg {
         margin: 10px 0;
         display: block;
         background-color: #dc3545;
         color: #fff;
         padding: 10px;
         border-radius: 5px;
         font-size: 16px;
      }
   </style>
   <div class="container">
      <form action="" method="post">
         <h2>Register Now</h2>

   <!-- <form action="" method="post">
      <h2 id="h3">Register now</h2><br> -->
      <!-- <?php
      // if(isset($error)){
      //    foreach($error as $error){
      //       echo '<span id="errormsg">'.$error.'</span>';
      //    };
      // };
      ?> -->
      <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" required>
         </div>
         <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
         </div>
         <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
         </div>
         <div class="form-group">
            <label for="cpassword">Confirm Password:</label>
            <input type="password" name="cpassword" id="cpassword" required>
         </div>
         <div class="form-group">
         <label for="user_type">User Type:</label>
            <select name="user_type" id="user_type" required>
               <option value="user">User</option>
               <option value="admin">Admin</option>
            </select>
         </div>
         <input type="submit" name="submit" value="Register now" class="btn">
         <div class="register-link">
            <p>Already have an account? <a href="login_form.php">Login now</a></p>
         </div>
      <!-- <label for="name">Name:</label> 
      <input type="text" name="name" id="name"><br><br>
      <label for="Email">Email:</label> 
      <input type="email" name="email" id="Email"><br><br>
      <label for="password">Password:</label> 
      <input type="password" name="password" id="password"><br><br>
      <label for="password">Confirm Password:</label> 
      <input type="password" name="cpassword" id="password"><br><br>
      <select id="option"name="user_type">
         <option value="user">user</option>
         <option value="admin">admin</option>
      </select><br><br>
      <input type="submit" name="submit" value="Register now" id="s1">
      <p>already have an account? <a href="login_form.php">login now</a></p> -->
   </form>

</div>

</body>
</html>