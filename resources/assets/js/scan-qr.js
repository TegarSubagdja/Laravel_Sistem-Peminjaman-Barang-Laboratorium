import { Html5Qrcode } from "html5-qrcode";

let scanSuccessful = false;
let html5Qrcode;

function onScanSuccess(decodedText, decodedResult) {
  if (scanSuccessful) {
    return;
  }

  scanSuccessful = true;

  console.log(`Code matched = ${decodedText}`, decodedResult);

  $.ajax({
    url: '/detail-item',
    type: 'POST',
    contentType: 'application/json',
    data: JSON.stringify({
      decodeText: decodedText
    }),
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function (response) {
      console.log(response);

      // Assuming response is the JSON object returned from the server
      var item = response.item;
      var $code = document.getElementById('code');
      var $name = document.getElementById('name');
      var $desk = document.getElementById('desk');
      var $pic = document.getElementById('pic');
      var $lab = document.getElementById('lab');
      var $quantity = document.getElementById('quantity');

      // Update the modal content
      $code.value = item.code;
      $name.value = item.name;
      $desk.innerHTML = item.description;
      $pic.src = `${baseUrl}/${item.picture}`;
      $lab.innerHTML = item.lab.name;

      var maxQuantity = item.quantity - item.reserved;
      $quantity.max = maxQuantity;

      // Show the modal
      $('#myModal').modal('show');

      html5Qrcode.stop().then(() => {
        console.log("Scanner stopped.");
      }).catch(error => {
        console.error("Failed to stop the scanner: ", error);
      });
    },
    error: function (xhr, status, error) {
      console.error("Error sending data: ", error);
      alert("Failed to send data");
      scanSuccessful = false;
    }
  });
}

function onScanFailure(error) {
  // console.warn(`Code scan error = ${error}`);
}

document.addEventListener('DOMContentLoaded', function () {
  html5Qrcode = new Html5Qrcode("reader");

  document.getElementById('startScan').addEventListener('click', function () {
    scanSuccessful = false;
    html5Qrcode.start(
      { facingMode: "environment" },
      { fps: 10, qrbox: { width: 500, height: 500 } },
      onScanSuccess,
      onScanFailure
    ).then(() => {
      console.log("Scanning started.");
    }).catch(err => {
      console.error("Unable to start scanning:", err);
    });
  });
});
