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
    url: '/datas',
    type: 'POST',
    contentType: 'application/json',
    data: JSON.stringify({
      decodeText: decodedText
    }),
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function (response) {
      console.log(response.data);


      // var offcanvas = new bootstrap.Offcanvas($('#add-new-record'));
      // offcanvas.show();



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
  console.warn(`Code scan error = ${error}`);
}

document.addEventListener('DOMContentLoaded', function () {
  html5Qrcode = new Html5Qrcode("reader");

  document.getElementById('startScan').addEventListener('click', function () {
    html5Qrcode.start(
      { facingMode: "environment" },
      { fps: 10, qrbox: { width: 500, height: 500 } },
      onScanSuccess,
      onScanFailure
    ).then(() => {
      console.log("Scanning started.");

      
      var $name = document.getElementById('nameWithTitle');
      var $desk = document.getElementById('desk');
      $name.value = "Tegar Subagdja";
      $desk.innerHTML = "Kita Coba Dlu";
      $('#myModal').modal('show');


    }).catch(err => {
      console.error("Unable to start scanning:", err);
    });
  });
});
