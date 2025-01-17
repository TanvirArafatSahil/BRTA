document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("loginForm");
    const statusMessage = document.getElementById("statusMessage");

    form.addEventListener("submit", (event) => {
        event.preventDefault();

        const formData = {
            username: document.getElementById("username").value.trim(),
            password: document.getElementById("password").value.trim(),
        };

        statusMessage.textContent = "Processing login...";

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "../controller/loginCheck.php", true);
        xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");

        xhr.onload = function () {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                if (response.success) {
                    statusMessage.textContent = "Login successful! Redirecting...";
                    setTimeout(() => {
                        window.location.href = response.redirect; // Redirect to homepage
                    }, 1000);
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
