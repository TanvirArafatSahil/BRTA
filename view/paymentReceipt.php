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
    <title>Payment Receipt</title>
    <link rel="stylesheet" href="../css/paymentReceipt.css">
</head>
<body>
    <header>
        <h1>Payment Receipt</h1>
    </header>
    <main>
        <h2>Transaction Details</h2>
        <table>
            <tr><th>Transaction ID:</th><td><?php echo htmlspecialchars($payment['transaction_id']); ?></td></tr>
            <tr><th>Application ID:</th><td><?php echo htmlspecialchars($payment['application_id']); ?></td></tr>
            <tr><th>Payment Method:</th><td><?php echo htmlspecialchars($payment['payment_method']); ?></td></tr>
            <tr><th>Bank/Mobile Service:</th><td><?php echo htmlspecialchars($payment['bank_name'] ?: $payment['mobile_service']); ?></td></tr>
        </table>
        <p>Thank you for your payment!</p>
    </main>
</body>
</html>
