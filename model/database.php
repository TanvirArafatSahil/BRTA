<?php
function getConnection()
{
    // Test database connection in database.php
$conn = mysqli_connect('127.0.0.1', 'root', '', 'brta');
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

    return $conn;
}
?>
