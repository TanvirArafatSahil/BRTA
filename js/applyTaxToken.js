function submitTaxToken() {
    // Get the form and form data
    const form = document.getElementById("taxTokenForm");
    const formData = new FormData(form);

    // Display the "Submitting..." status
    const statusMessage = document.getElementById("statusMessage");
    statusMessage.textContent = "Submitting...";

    // Create an AJAX request
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "../controller/taxTokenController.php", true);

    xhr.onload = function () {
        // Handle the response
        if (xhr.status === 200) {
            try {
                const response = JSON.parse(xhr.responseText);
                if (response.success) {
                    // Redirect to the confirmation page if successful
                    window.location.href = `taxTokenConfirmation.php?applicationID=${response.applicationID}`;
                } else {
                    statusMessage.textContent = "Error: " + response.message;
                }
            } catch (error) {
                statusMessage.textContent = "Invalid response from server.";
            }
        } else {
            statusMessage.textContent = "Server error. Please try again later.";
        }
    };

    xhr.onerror = function () {
        // Handle network errors
        statusMessage.textContent = "Network error. Please check your connection.";
    };

    // Send the form data
    xhr.send(formData);
}
