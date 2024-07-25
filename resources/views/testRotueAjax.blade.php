<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>AJAX Call Example</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <input type="text" id="valueInput" placeholder="Enter value">
    <button id="sendButton">Send AJAX Request</button>

    <script>
        $(document).ready(function() {
            $('#sendButton').on('click', function() {
                var value = $('#valueInput').val();
                $.ajax({
                    url: '/datas',
                    type: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({
                        value: value
                    }),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        alert("Data sent successfully: " + response.data.value);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error sending data: ", error);
                        alert("F   ailed to send data");
                    }
                });
            });
        });
    </script>
</body>

</html>
