function submitPayment() {
    const form = document.getElementById("paymentForm");
    const formData = new FormData(form);

    const statusMessage = document.getElementById("statusMessage");
    statusMessage.textContent = "Processing payment...";

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "../controller/taxTokenPaymentController.php", true);

    xhr.onload = function () {
        if (xhr.status === 200) {
            try {
                const response = JSON.parse(xhr.responseText);
                if (response.success) {
                    // Redirect to confirmation page
                    window.location.href = `paymentConfirmation.php?transactionID=${response.transactionID}`;
                } else {
                    statusMessage.textContent = "Error: " + response.message;
                }
            } catch (error) {
                statusMessage.textContent = "Invalid server response.";
            }
        } else {
            statusMessage.textContent = "Server error. Please try again.";
        }
    };

    xhr.onerror = function () {
        statusMessage.textContent = "Network error. Please check your connection.";
    };

    xhr.send(formData);
}
