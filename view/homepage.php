<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Get the logged-in username
$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="../css/homepage.css">
</head>
<body>
    <header>
        <h1>Welcome, <?php echo htmlspecialchars($username); ?>!</h1>
        <nav>
            <a href="../controller/logout.php">Logout</a>
        </nav>
    </header>

    <main>
        <h2>Available Services</h2>
        <ul>
            <li>
                <a href="applyTaxToken.php">Apply for Tax Token</a>
            </li>
            <li>
                <a href="vehicleReg.php">Apply for Vehicle Registration</a>
            </li>
        </ul>
    </main>
</body>
</html>
