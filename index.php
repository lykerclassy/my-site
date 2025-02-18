<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login/Signup</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="container">
    <!-- Toggle Buttons -->
    <div class="toggle-buttons">
      <button class="toggle-btn active" id="loginBtn">Login</button>
      <button class="toggle-btn" id="signupBtn">Sign Up</button>
    </div>

    <!-- Login Form -->
    <form id="loginForm" class="form active" action="login.php" method="POST">
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Login</button>
    </form>

    <!-- Signup Form -->
    <form id="signupForm" class="form" action="signup.php" method="POST">
      <input type="text" name="username" placeholder="Username" required>
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <input type="password" name="confirm_password" placeholder="Confirm Password" required>
      <button type="submit">Sign Up</button>
    </form>
  </div>
  <script src="script.js"></script>
</body>
</html>