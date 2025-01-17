<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply for Tax Token</title>
    <link rel="stylesheet" href="../css/applyTaxToken.css">
    <script src="../js/applyTaxToken.js"></script>
</head>
<body>
    <header>
        <h1>Apply for Tax Token</h1>
        <nav>
            <a href="vehicleReg.php">Back to Homepage</a>
        </nav>
    </header>
    <main>
        <form id="taxTokenForm" enctype="multipart/form-data">
            <table>
                <tr>
                    <th>Permit Type:</th>
                    <td>
                        <select id="permitType" name="permitType" required>
                            <option value="">--Select--</option>
                            <option value="Bus">Bus</option>
                            <option value="Truck">Truck</option>
                            <option value="Other">Other</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Registration Number:</th>
                    <td><input type="text" id="regNumber" name="regNumber" required></td>
                </tr>
                <tr>
                    <th>Chassis Number:</th>
                    <td><input type="text" id="chassisNumber" name="chassisNumber" required></td>
                </tr>
                <tr>
                    <th>Full Name:</th>
                    <td><input type="text" id="fullName" name="fullName" required></td>
                </tr>
                <tr>
                    <th>License Number:</th>
                    <td><input type="text" id="licenseNumber" name="licenseNumber" required></td>
                </tr>
                <tr>
                    <th>Permit Application Form:</th>
                    <td><input type="file" id="permitFile" name="permitFile" required></td>
                </tr>
                <tr>
                    <th>Inspection Certificate:</th>
                    <td><input type="file" id="inspectionCertificate" name="inspectionCertificate" required></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button type="button" onclick="submitTaxToken()">Submit</button>
                        <p id="statusMessage"></p>
                    </td>
                </tr>
            </table>
        </form>
    </main>
</body>
</html>
