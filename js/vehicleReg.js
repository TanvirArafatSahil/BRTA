function submitVehicleReg() {
    let city = document.getElementById("city").value.trim();
    let vehicleClass = document.getElementById("vehicleClass").value.trim().toUpperCase();
    let series = document.getElementById("series").value.trim();
    let vehicleNumber = document.getElementById("vehicleNumber").value.trim();
  
    if (!city || !vehicleClass || !series || !vehicleNumber) {
      document.getElementById("msg").innerHTML = "All fields are required.";
      return;
    }
  
    if (!/^[A-Z]$/.test(vehicleClass)) {
      document.getElementById("msg").innerHTML = "Vehicle class must be a single uppercase letter.";
      return;
    }
  
    let json = {
      city: city,
      vehicleClass: vehicleClass,
      series: series,
      vehicleNumber: vehicleNumber,
    };
    let data = JSON.stringify(json);
  
    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", "../controller/vehicleRegController.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.send("vehicleData=" + encodeURIComponent(data));
  
    xhttp.onreadystatechange = function () {
      if (this.readyState === 4 && this.status === 200) {
        document.getElementById("msg").innerHTML = this.responseText;
      }
    };
  }
  