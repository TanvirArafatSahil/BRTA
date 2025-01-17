<?php
require_once('../model/authModel.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $username = $data['username'] ?? '';
    $password = $data['password'] ?? '';
    $email = $data['email'] ?? '';
    $mobile = $data['mobile'] ?? '';
    $address = $data['address'] ?? '';
    $errors = [];

    // Validation
    if (empty($username)) $errors[] = "Username is required.";
    if (empty($password)) $errors[] = "Password is required.";
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Valid email is required.";
    if (empty($mobile) || !preg_match('/^\d{11}$/', $mobile)) $errors[] = "Mobile number must be 11 digits.";
    if (empty($address)) $errors[] = "Address is required.";

    if (empty($errors)) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT); // Secure password
        $result = registerUser($username, $hashedPassword, $email, $mobile, $address);

        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Registration successful']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Username already exists.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => $errors]);
    }

    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/registerAjax.js"></script>
</head>
<body>
    <h1>Register</h1>
    <form id="registerForm">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="mobile">Mobile Number:</label>
        <input type="text" id="mobile" name="mobile" maxlength="11" required><br>

        <label for="address">Address:</label>
        <textarea id="address" name="address" required></textarea><br>

        <button type="submit">Register</button>
    </form>
    <p id="statusMessage"></p>
</body>
</html>
