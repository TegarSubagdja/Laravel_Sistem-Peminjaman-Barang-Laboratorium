@extends('layouts/contentNavbarLayout')

@section('title', 'Inventory - Basic Tables')

@section('page-script')
    <script src="{{ asset('assets/js/ui-popover.js') }}"></script>
@endsection

@section('content')
    <table id="DataTables_Table_0" class="display" style="width:100%">
        <thead>
            <tr>
                <th></th>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Salary</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th></th>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Salary</th>
            </tr>
        </tfoot>
    </table>
    <script src="{{ asset('assets/vendor/libs/DataTables/datatables.min.js') }}"></script>
    <script>
        // Formatting function for row details - modify as you need
        function format(d) {
            // `d` is the original data object for the row
            return (
                '<dl>' +
                '<dt>Full name:</dt>' +
                '<dd>' +
                d.user_id +
                '</dd>' +
                '<dt>Extension number:</dt>' +
                '<dd>' +
                d.item_id +
                '</dd>' +
                '<dt>Extra info:</dt>' +
                '<dd>And any further details here (images etc)...</dd>' +
                '</dl>'
            );
        }

        let table = new DataTable('#DataTables_Table_0', {
            ajax: {
                url: '/lives',
                type: 'GET' // Menentukan metode POST untuk request
            },
            columns: [{
                    className: 'dt-control',
                    orderable: false,
                    data: null,
                    defaultContent: ''
                },
                {
                    data: 'user_id'
                },
                {
                    data: 'item_id'
                },
                {
                    data: 'loan_date'
                },
                {
                    data: 'return_date'
                }
            ],
            layout: {
                topStart: {
                    buttons: ['createState', 'savedStates']
                }
            },
            order: [
                [1, 'asc']
            ],
            rowId: 'id'
        });

        // State handling for restoring child rows
        table.on('requestChild', function(e, row) {
            row.child(format(row.data())).show();
        });

        // Add event listener for opening and closing details
        table.on('click', 'tbody td.dt-control', function(e) {
            let tr = e.target.closest('tr');
            let row = table.row(tr);

            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
            } else {
                // Open this row
                row.child(format(row.data())).show();
            }
        });
    </script>
@endsection
