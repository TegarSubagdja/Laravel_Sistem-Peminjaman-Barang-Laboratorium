<!DOCTYPE html>
<html>

<head>
    <title>Laravel 11 Autocomplete Search from Database - ItSolutionStuff.com</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="card mt-5">
            <h3 class="card-header p-3">Laravel 11 Autocomplete Search from Database - ItSolutionStuff.com</h3>
            <div class="card-body">
                <form action="#" method="POST" enctype="multipart/form-data" class="mt-2">
                    @csrf
                    <input class="typeahead form-control" id="search" type="text">
                    <div class="mb-3 mt-3">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        var path = "/search";
        $('#search').typeahead({
            source: function(query, process) {
                return $.get(path, {
                    query: query
                }, function(data) {
                    return process(data.map(function(user) {
                        return user.nrp + ' ' + user.name;
                    }));
                });
            }
        });
    </script>
</body>

</html>
