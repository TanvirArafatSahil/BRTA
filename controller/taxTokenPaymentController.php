<?php
require_once('../model/authModel.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $applicationID = $_POST['applicationID'] ?? '';
    $paymentMethod = $_POST['paymentMethod'] ?? '';
    $bankName = $_POST['bankName'] ?? '';
    $mobileService = $_POST['mobileService'] ?? '';

    $errors = [];

    if (empty($paymentMethod)) {
        $errors[] = "Payment method is required.";
    }
    if ($paymentMethod === "Bank" && empty($bankName)) {
        $errors[] = "Bank name is required.";
    }
    if ($paymentMethod === "Mobile Banking" && empty($mobileService)) {
        $errors[] = "Mobile banking service is required.";
    }

    if (!empty($errors)) {
        echo json_encode(['success' => false, 'message' => implode(", ", $errors)]);
        exit;
    }

    $transactionID = uniqid("TXN_");

    $success = savePaymentDetails($applicationID, $paymentMethod, $bankName, $mobileService, $transactionID);

    if ($success) {
        echo json_encode(['success' => true, 'transactionID' => $transactionID]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to save payment.']);
    }
}
?>
