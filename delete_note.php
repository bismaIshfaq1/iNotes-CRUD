<?php
include 'partials/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $delete_id = $_POST['delete_id'];
    $sql = "DELETE FROM notess WHERE id = $delete_id";
    mysqli_query($conn, $sql);
    header("Location: index.php?deleted=1");
}

mysqli_close($conn);
?>
