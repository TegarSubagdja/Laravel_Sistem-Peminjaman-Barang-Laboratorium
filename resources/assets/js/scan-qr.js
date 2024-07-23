import { Html5QrcodeScanner } from "html5-qrcode";

function onScanSuccess(decodedText, decodedResult) {
    // Handle the scanned code as you like
    console.log(`Code matched = ${decodedText}`, decodedResult);
}

function onScanFailure(error) {
    // Handle scan failure (optional)
    console.warn(`Code scan error = ${error}`);
}

document.addEventListener('DOMContentLoaded', function () {
    const startButton = document.getElementById('startScanButton');

    // Instantiate Html5QrcodeScanner
    const html5QrcodeScanner = new Html5QrcodeScanner(
        "reader",
        { fps: 10, qrbox: { width: 250, height: 250 } },
        /* verbose= */ false
    );

    startButton.addEventListener('click', function () {
        // Render the scanner with success and failure callbacks
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    });
});
