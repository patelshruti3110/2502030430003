<?php
 include 'database.php';
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<table border="1" >

 <tr>
 <th>Id</th>
 <th>Name</th>
 <th>Email</th>
 <th>Password</th>
 <th>Update</th>
 <th>Delete</th>
 </tr>

 <?php
 $showData = "SELECT * FROM users";
 $showRes = $conn->query($showData);
 $i = 1;
 while($fetch = mysqli_fetch_assoc($showRes)){
 ?>

 <tr>
 <td><?php echo $i ?></td>
 <td><?php echo $fetch['name'] ?></td>
 <td><?php echo  $fetch['email'] ?></td>
<td><?php echo $fetch['password'] ?></td>
 <td><a href="update.php?id=<?php echo $fetch['id'] ?>">Update</a>  </td>
 <td><a href="delete.php?id=<?php echo $fetch['id'] ?>">Delete</a>  </td>
 </tr>

 <?php
 
 $i++;

 }

 ?>
 </table>
    
</body>
</html>