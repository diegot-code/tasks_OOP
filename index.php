<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="login.css">
</head>
<body>
  <div class="login-container">
    <div class="login-box">
      <h2>Login</h2>
      <form action="process.php" method="POST" class="login-form">
        <!-- <label for="username">Username</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required> -->
        <label for="userid">User ID</label>
        <input type="text" id="userid" name="user_id">

        <button type="submit" name="processType" value="login">Login</button>
      </form>
    </div>
  </div>
</body>
</html>
