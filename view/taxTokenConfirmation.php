<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$applicationID = $_GET['applicationID'] ?? '';
if (!$applicationID) {
    die("Invalid application ID.");
}

require_once('../model/authModel.php');
$application = getTaxTokenApplication($applicationID);
if (!$application) {
    die("Application not found.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tax Token Confirmation</title>
    <link rel="stylesheet" href="../css/taxTokenConfirmation.css">
</head>
<body>
    <header>
        <h1>Tax Token Confirmation</h1>
    </header>
    <main>
        <h2>Application Details</h2>
        <table>
            <tr><th>Application ID:</th><td><?php echo htmlspecialchars($application['id']); ?></td></tr>
            <tr><th>Permit Type:</th><td><?php echo htmlspecialchars($application['permit_type']); ?></td></tr>
            <tr><th>Registration Number:</th><td><?php echo htmlspecialchars($application['reg_number']); ?></td></tr>
        </table>
        <a href="taxTokenPayment.php?applicationID=<?php echo $application['id']; ?>" class="button">Pay Now</a>
    </main>
</body>
</html>
