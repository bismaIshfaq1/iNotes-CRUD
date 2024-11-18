<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "notes";


$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['noteId'], $_POST['titleEdit'], $_POST['descEdit'])) {
        $noteId = $_POST['noteId'];
        $titleEdit = $_POST['titleEdit'];
        $descEdit = $_POST['descEdit'];

        $sql = "UPDATE `notess` SET title='$titleEdit', des='$descEdit' WHERE id=$noteId";
        if (mysqli_query($conn, $sql)) {
            header("Location: index.php?update=success");
        } else {
            echo "Error updating note: " . mysqli_error($conn);
        }
    }
}



mysqli_close($conn);
?>
