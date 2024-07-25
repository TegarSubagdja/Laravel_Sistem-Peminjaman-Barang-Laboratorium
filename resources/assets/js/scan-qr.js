import { Html5QrcodeScanner } from "html5-qrcode";

function onScanSuccess(decodedText, decodedResult) {
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
            alert("Data sent successfully: " + response.data);
        },
        error: function (xhr, status, error) {
            console.error("Error sending data: ", error);
            alert("Failed to send data");
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
    const html5QrcodeScanner = new Html5QrcodeScanner(
        "reader",
        { fps: 10, qrbox: { width: 500, height: 500 } },
        /* verbose= */ false
    );

    startButton.addEventListener('click', function () {
        // Render the scanner with success and failure callbacks
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    });
});
