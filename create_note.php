<?php
include 'partials/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $desc = $_POST['desc'];
    $sql = "INSERT INTO notess (title, des) VALUES ('$title', '$desc')";
    if (mysqli_query($conn, $sql)) {
        header("Location: index.php?success=1");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
