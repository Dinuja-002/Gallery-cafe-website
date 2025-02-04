<?php
$conn = mysqli_connect('localhost', 'root', '', 'thegallerycafe');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['query']) && isset($_POST['name']) && isset($_POST['email'])) {
    $query = mysqli_real_escape_string($conn, $_POST['query']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $insert = "INSERT INTO enquiries (query, name, email) VALUES ('$query', '$name', '$email')";
    if (mysqli_query($conn, $insert)) {
		
        echo '<script>alert("Query submitted successfully!"); window.location.href = "index.html";</script>';
		
    } else {
		
        echo '<script>alert("Error: ' . mysqli_error($conn) . '"); window.location.href = "index.html";</script>';
		
    }
}

mysqli_close($conn);
?>
