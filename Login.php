<?php

$conn = mysqli_connect('localhost', 'root', '', 'thegallerycafe');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);


    if (empty($username)) {
        $error = "Username is required";
    }
    if (empty($password)) {
        $error = "Password is required";
    }

    $select = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $select);


    if (mysqli_num_rows($result) == 1) {
        $_SESSION['username'] = $username;
        $_SESSION['success'] = "You are now logged in";
        header('location: index.html');
    } else {
        $error = "Wrong username/password combination";
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
    <link rel="stylesheet" href="Assets/Login.css">
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
        <h2>Login</h2>
    </div>

    <form method="post" action="Login.php">
        <?php
        if (isset($error)) {
            echo '<p>' . $error . '</p>';
        }
        ?>
        <div class="input-group">
            <label>Username</label>
            <input type="text" name="username" required placeholder="Username">
        </div>
        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password" required placeholder="Password">
        </div>
        <div class="input-group">
            <button type="submit" class="btn" name="login_user">Login</button>
        </div>
        <p>
            Not yet a member? <a href="CustomerRegister.html">Sign up</a>
        </p>
    </form>
    </div>

</html>