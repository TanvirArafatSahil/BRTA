<?php
require_once('../model/authModel.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $permitType = $_POST['permitType'] ?? '';
    $regNumber = $_POST['regNumber'] ?? '';
    $chassisNumber = $_POST['chassisNumber'] ?? '';
    $fullName = $_POST['fullName'] ?? '';
    $licenseNumber = $_POST['licenseNumber'] ?? '';
    $permitFile = $_FILES['permitFile'] ?? null;
    $inspectionCertificate = $_FILES['inspectionCertificate'] ?? null;

    $errors = [];

    // Validate required fields
    if (empty($permitType)) $errors[] = "Permit Type is required.";
    if (empty($regNumber)) $errors[] = "Registration Number is required.";
    if (empty($chassisNumber)) $errors[] = "Chassis Number is required.";
    if (empty($fullName)) $errors[] = "Full Name is required.";
    if (empty($licenseNumber)) $errors[] = "License Number is required.";

    // Validate file uploads
    if (!$permitFile || $permitFile['error'] !== UPLOAD_ERR_OK) {
        $errors[] = "Permit Application Form upload failed.";
    }
    if (!$inspectionCertificate || $inspectionCertificate['error'] !== UPLOAD_ERR_OK) {
        $errors[] = "Inspection Certificate upload failed.";
    }

    if (!empty($errors)) {
        echo json_encode(['success' => false, 'message' => implode(", ", $errors)]);
        exit;
    }

    // Save files
    $permitFilePath = '../uploads/' . basename($permitFile['name']);
    move_uploaded_file($permitFile['tmp_name'], $permitFilePath);

    $inspectionFilePath = '../uploads/' . basename($inspectionCertificate['name']);
    move_uploaded_file($inspectionCertificate['tmp_name'], $inspectionFilePath);

    // Save application to database
    $applicationID = saveTaxTokenApplication($permitType, $regNumber, $chassisNumber, $fullName, $licenseNumber, $permitFilePath, $inspectionFilePath);

    if ($applicationID) {
        echo json_encode(['success' => true, 'applicationID' => $applicationID]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to save application.']);
    }
}
?>
