<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Search</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .product-card {
            margin: 10px 0;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Product Search</h2>
        <input type="text" id="search-input" class="form-control" placeholder="Search for products...">
        <div class="row mt-4" id="product-list">
            <div class="col-md-4 product-card" data-name="Apple">
                <div class="card">
                    <img src="apple.jpg" class="card-img-top" alt="Apple">
                    <div class="card-body">
                        <h5 class="card-title">Apple</h5>
                        <p class="card-text">Fresh red apples.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 product-card" data-name="Banana">
                <div class="card">
                    <img src="banana.jpg" class="card-img-top" alt="Banana">
                    <div class="card-body">
                        <h5 class="card-title">Banana</h5>
                        <p class="card-text">Sweet yellow bananas.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 product-card" data-name="Cherry">
                <div class="card">
                    <img src="cherry.jpg" class="card-img-top" alt="Cherry">
                    <div class="card-body">
                        <h5 class="card-title">Cherry</h5>
                        <p class="card-text">Juicy red cherries.</p>
                    </div>
                </div>
            </div>
            <!-- Add more product cards as needed -->
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#search-input').on('keyup', function() {
                var value = $(this).val().toLowerCase();
                $('#product-list .product-card').filter(function() {
                    $(this).toggle($(this).attr('data-name').toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
</body>

</html>
