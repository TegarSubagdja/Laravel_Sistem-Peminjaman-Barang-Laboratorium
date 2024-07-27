import { Html5QrcodeScanner } from "html5-qrcode";

let scanSuccessful = false;
let html5QrcodeScanner;

function onScanSuccess(decodedText, decodedResult) {
    // If scan has already been successful, ignore subsequent scans
    if (scanSuccessful) {
        return;
    }

    // Set flag indicating scan was successful
    scanSuccessful = true;

    // Handle the scanned code
    console.log(`Code matched = ${decodedText}`, decodedResult);

    // Send the decoded text to the server as JSON
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
            // alert("Data sent successfully: " + response.data);
            var offcanvas = new bootstrap.Offcanvas($('#add-new-record'));
            offcanvas.show();
            // Stop the scanner
            html5QrcodeScanner.clear().then(() => {
                console.log("Scanner stopped.");
            }).catch(error => {
                console.error("Failed to stop the scanner: ", error);
            });
        },
        error: function (xhr, status, error) {
            console.error("Error sending data: ", error);
            alert("Failed to send data");
            // Reset the scan flag on error
            scanSuccessful = false;
        }
    });
}

function onScanFailure(error) {
    // Handle scan failure (optional)
    console.warn(`Code scan error = ${error}`);
}

document.addEventListener('DOMContentLoaded', function () {
    const startButton = document.getElementById('startScanButton');

    // Instantiate Html5QrcodeScanner
    html5QrcodeScanner = new Html5QrcodeScanner(
        "reader",
        { fps: 10, qrbox: { width: 500, height: 500 } },
        /* verbose= */ false
    );

    startButton.addEventListener('click', function () {
        // Render the scanner with success and failure callbacks
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    });
});
