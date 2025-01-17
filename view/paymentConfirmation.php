<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$transactionID = $_GET['transactionID'] ?? '';
if (!$transactionID) {
    die("Invalid transaction ID.");
}

require_once('../model/authModel.php');
$payment = getPaymentDetails($transactionID);
if (!$payment) {
    die("Payment not found.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Confirmation</title>
</head>
<body>
    <h1>Payment Confirmation</h1>
    <p>Transaction ID: <?php echo htmlspecialchars($payment['transaction_id']); ?></p>
    <p>Application ID: <?php echo htmlspecialchars($payment['application_id']); ?></p>
    <p>Payment Method: <?php echo htmlspecialchars($payment['payment_method']); ?></p>
    <p>Bank/Mobile Service: <?php echo htmlspecialchars($payment['bank_name'] ?: $payment['mobile_service']); ?></p>
    <p>Thank you for your payment!</p>
</body>
</html>
