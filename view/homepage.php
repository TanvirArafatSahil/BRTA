<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Get the logged-in username
$username = $_SESSION['username'];
?>

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
        <div class="container">
            <h1>Welcome, <?php echo htmlspecialchars($username); ?>!</h1>
            <nav>
                <ul>
                    <li><a href="../controller/logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <section class="services">
            <h2>Available Services</h2>
            <div class="service-card">
                <h3>Apply for Vehicle Registration</h3>
                <p>Register your vehicle quickly and securely online.</p>
                <!-- Ensure this link redirects -->
                <a href="vehicleReg.php" class="button">Get Started</a>
            </div>
            <div class="service-card">
                <h3>Apply for Tax Token</h3>
                <p>Easily apply for your vehicle tax token through our platform.</p>
                <a href="applyTaxToken.php" class="button">Get Started</a>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> BRTA Services. All Rights Reserved.</p>
    </footer>
</body>
</html>
