<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once('../model/authModel.php');

echo "Session started successfully.<br>";
echo "authModel.php included successfully.<br>";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "Form submitted successfully.<br>";

    // Retrieve POST data
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    echo "Username: $username<br>";
    echo "Password: $password<br>";

    if (authenticateUser($username, $password)) {
        echo "User authenticated successfully.<br>";
        $_SESSION['username'] = $username;
        setcookie('logged_in', 'true', time() + 3600, '/'); // 1-hour session
        header("Location: vehicleReg.php"); // Redirect to Vehicle Registration
        exit;
    } else {
        echo "Invalid username or password.<br>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form method="POST" action="">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
        <button type="submit">Login</button>
    </form>
</body>
</html>
