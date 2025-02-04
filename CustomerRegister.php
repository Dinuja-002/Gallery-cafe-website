<?php

$conn = mysqli_connect('localhost', 'root', '', 'thegallerycafe');

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);
  $cpassword = $_POST['cpassword'];


  $select = "SELECT * FROM users WHERE email = '$email'";
  $result = mysqli_query($conn, $select);

  if (mysqli_num_rows($result) > 0) {
    $error = 'User already exists!';
  } else {
    if ($password !== $cpassword) {
      $error = 'passwords does not match!';
    } else {

      $insert = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
      if (mysqli_query($conn, $insert)) {
        header('Location: Login.php');
        exit();
      } else {
        $error = 'Error inserting user data: ' . mysqli_error($conn);
      }
    }
  }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="Assets/Style1.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>The Gallery Cafe</title>
  <link rel="icon" href="img/favicon.ico">
  <link rel="stylesheet" type="text/css" href="Assets/Style1.css">
  <style type="text/css">
    body {
      background-image: url('img/bg-image.jpeg');
      background-size: cover;
    }
  </style>
</head>

<body>
  <div class="header">
    <h2>Register</h2>
  </div>

  <form method="post" action="CustomerRegister.php">
    <?php
    if (isset($error)) {
      echo '<p>' . $error . '</p>';
    }
    ?>
    <div class="input-group">
      <label>Username</label>
      <input type="text" name="username" required placeholder="Name">
    </div>
    <div class="input-group">
      <label>Email</label>
      <input type="email" name="email" required placeholder="Example@mail.com">
    </div>
    <div class="input-group">
      <label>Password</label>
      <input type="password" name="password" required placeholder="Password">
    </div>
    <div class="input-group">
      <label>Confirm password</label>
      <input type="password" name="cpassword" required placeholder="Confirm Password">
    </div>
    <div class="input-group">
      <button type="submit" class="btn" name="submit">Register</button>
    </div>
    <p>
      Already a member? <a href="Login.html">Sign in</a>
    </p>
  </form>

  <div class="footer">
    <div class="footer-box">
      <div class="social-media">
        <a href="#"><i class="fa-brands fa-facebook"></i></a>
        <a href="#"><i class="fa-brands fa-instagram"></i></a>
        <a href="#"><i class="fa-brands fa-twitter"></i></a>
        <a href="#"><i class="fa-brands fa-youtube"></i></a>
      </div>
      <div class="copyright">
        <label>Copyright &copy; 2025</label>
      </div>
      <div class="brand">
        <label>The Gallery <span>Café</span></label>
      </div>
    </div>
  </div>
</body>

</html>