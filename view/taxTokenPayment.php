<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tax Token Payment</title>
    <link rel="stylesheet" href="../css/taxTokenPayment.css">
    <script src="../js/taxTokenPayment.js"></script>
    <script src="../js/submitPayment.js"></script>
</head>
<body>
    <div class="container">
        <h1>Tax Token Payment</h1>
        <form id="paymentForm">
            <input type="hidden" name="applicationID" value="<?php echo htmlspecialchars($_GET['applicationID']); ?>">

            <label for="paymentMethod">Payment Method:</label>
            <select id="paymentMethod" name="paymentMethod" required onchange="togglePaymentOptions()">
                <option value="">--Select Payment Method--</option>
                <option value="Bank">Bank</option>
                <option value="Mobile Banking">Mobile Banking</option>
            </select>

            <div id="bankOptions">
                <label for="bankName">Bank Name:</label>
                <select id="bankName" name="bankName">
                    <option value="">--Select Bank--</option>
                    <option value="Sonali Bank">Sonali Bank</option>
                    <option value="Janata Bank">Janata Bank</option>
                    <option value="BRAC Bank">BRAC Bank</option>
                    <option value="Dutch-Bangla Bank">Dutch-Bangla Bank</option>
                </select>
            </div>

            <div id="mobileOptions">
                <label for="mobileService">Mobile Banking Service:</label>
                <select id="mobileService" name="mobileService">
                    <option value="">--Select Mobile Service--</option>
                    <option value="bKash">bKash</option>
                    <option value="Nagad">Nagad</option>
                    <option value="Rocket">Rocket</option>
                </select>
            </div>

            <button type="button" onclick="submitPayment()">Pay Now</button>
            <p id="statusMessage"></p>
        </form>
        <a class="back-link" href="homepage.php">Back to Homepage</a>
    </div>
</body>
</html>
