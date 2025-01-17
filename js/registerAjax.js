document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("registerForm");
    const statusMessage = document.getElementById("statusMessage");

    form.addEventListener("submit", (event) => {
        event.preventDefault(); // Prevent form from submitting traditionally

        const formData = {
            username: document.getElementById("username").value.trim(),
            password: document.getElementById("password").value.trim(),
            email: document.getElementById("email").value.trim(),
            mobile: document.getElementById("mobile").value.trim(),
            address: document.getElementById("address").value.trim(),
        };

        statusMessage.textContent = "Processing registration...";

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "register.php", true);
        xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");

        xhr.onload = function () {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                if (response.success) {
                    statusMessage.textContent = "Registration successful! Redirecting...";
                    setTimeout(() => {
                        window.location.href = "login.php"; // Redirect to login
                    }, 2000);
                } else {
                    statusMessage.textContent = "Error: " + response.message;
                }
            } else {
                statusMessage.textContent = "Server error. Please try again.";
            }
        };

        xhr.onerror = function () {
            statusMessage.textContent = "Network error. Please check your connection.";
        };

        xhr.send(JSON.stringify(formData));
    });
});
