<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];

    // Database connection
    $conn = new mysqli("localhost", "root", "", "notes");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Delete query
    $sql = "DELETE FROM notes WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $delete_id);

    // Execute query
    if ($stmt->execute()) {
        echo 'success'; // Send success response
    } else {
        echo 'error'; // Send error response
    }

    $stmt->close();
    $conn->close();
}
?>
