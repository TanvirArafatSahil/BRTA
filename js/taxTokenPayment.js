function togglePaymentOptions() {
    const paymentMethod = document.getElementById("paymentMethod").value;
    const bankOptions = document.getElementById("bankOptions");
    const mobileOptions = document.getElementById("mobileOptions");

    if (paymentMethod === "Bank") {
        bankOptions.style.display = "block";
        mobileOptions.style.display = "none";
    } else if (paymentMethod === "Mobile Banking") {
        bankOptions.style.display = "none";
        mobileOptions.style.display = "block";
    } else {
        bankOptions.style.display = "none";
        mobileOptions.style.display = "none";
    }
}
