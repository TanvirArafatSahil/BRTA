<?php
require_once('../model/authModel.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $email = $_POST['email'] ?? '';
    $mobile = $_POST['mobile'] ?? '';
    $address = $_POST['address'] ?? '';
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
            header("Location: login.php");
            exit;
        } else {
            $errors[] = "Username already exists.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Register</h1>
    <?php if (!empty($errors)): ?>
        <ul style="color: red;">
            <?php foreach ($errors as $error): ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <form method="POST" action="">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="mobile">Mobile Number:</label>
        <input type="text" id="mobile" name="mobile" maxlength="11" pattern="\d{11}" title="Must be 11 digits" required><br>

        <label for="address">Address:</label>
        <textarea id="address" name="address" required></textarea><br>

        <button type="submit">Register</button>
    </form>
    <p><a href="login.php">Back to Login</a></p>
</body>
</html>
