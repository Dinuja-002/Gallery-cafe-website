<?php
$conn = mysqli_connect('localhost', 'root', '', 'thegallerycafe');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['people']) && isset($_POST['date']) && isset($_POST['time'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $people = mysqli_real_escape_string($conn, $_POST['people']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $time = mysqli_real_escape_string($conn, $_POST['time']);

    $insert = "INSERT INTO reservation (name, email, people, date, time) VALUES ('$name', '$email', '$people', '$date', '$time')";
    if (mysqli_query($conn, $insert)) {

        echo '<script>alert("Reservation submitted successfully!"); window.location.href = "Reservation.html";</script>';
    } else {

        echo '<script>alert("Error: ' . mysqli_error($conn) . '"); window.location.href = "Reservation.html";</script>';
    }
}

mysqli_close($conn);
?>

