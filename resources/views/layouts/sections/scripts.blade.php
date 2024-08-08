<!-- BEGIN: Vendor JS-->
<script src="{{ asset(mix('assets/vendor/libs/jquery/jquery.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/popper/popper.js')) }}"></script>

@if (!Route::is('request-basic', 'admin-panel'))
    <script src="{{ asset(mix('assets/vendor/js/bootstrap.js')) }}"></script>
@endif

@if (Route::is('dashboard'))
    <script src="{{ asset(mix('js/scan-qr.js')) }}"></script>
@endif

@if (Route::is('request-basic'))
    @if (Auth::user()->isAdmin())
        <script src="{{ asset('assets/vendor/libs/DataTables/datatables.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/Typehead/bootstrap3-typeahead.min.js') }}"></script>
        <script>
            $(document).ready(function() {
                var table = $('#DataTables_Table_0').DataTable({
                    responsive: false,
                    order: [
                        [3, 'desc']
                    ],
                    language: {
                        lengthMenu: "Show _MENU_ entries",
                        searchPlaceholder: 'Search here...'
                    }
                });

                new $.fn.dataTable.Buttons(table, {
                    buttons: [{
                        extend: 'collection',
                        text: '<i class="bx bx-export bx-sm me-sm-2"></i> <span class="d-none d-sm-inline-block">Export</span>',
                        className: 'btn btn-outline-danger buttons-collection dropdown-toggle btn-label-danger me-4',
                        buttons: [{
                                extend: 'copy',
                                className: 'dropdown-item',
                                text: '<i class="bx bx-copy me-2"></i> Copy'
                            },
                            {
                                extend: 'csv',
                                className: 'dropdown-item',
                                text: '<i class="bx bx-file me-2"></i> CSV'
                            },
                            {
                                extend: 'excel',
                                className: 'dropdown-item',
                                text: '<i class="bx bx-file me-2"></i> Excel'
                            },
                            {
                                extend: 'pdf',
                                className: 'dropdown-item',
                                text: '<i class="bx bx-file me-2"></i> PDF'
                            },
                            {
                                extend: 'print',
                                className: 'dropdown-item',
                                text: '<i class="bx bx-printer me-2"></i> Print',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4]
                                },
                                title: 'Rekap Peminjaman Barang Laboratorium Informatika',
                                messageTop: 'Rekap Peminjaman Barang Laboratorium'
                            }
                        ]
                    }],
                });
                table.buttons().container()
                    .appendTo('#exportButtons');
                // Menambahkan tombol "Tambah Record" di sebelah kanan dropdown export
                $('#exportButtons').after(`
            <button class="btn btn-danger create-new ms-2" tabindex="0" aria-controls="DataTables_Table_0" type="button" data-bs-toggle="offcanvas" data-bs-target="#add-new-record">
                <span>
                    <i class="bx bx-plus bx-sm me-sm-2"></i>
                    <span class="d-none d-sm-inline-block">Tambah Record</span>
                </span>
            </button>`);
            });
        </script>
        <script type="text/javascript">
            var path = "/search";
            $('#nomorIndukPencarian').typeahead({
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
    @else
        <script>
            $(document).ready(function() {
                var table = $('#DataTables_Table_0').DataTable({
                    responsive: false,
                    order: [
                        [3, 'desc']
                    ],
                    language: {
                        lengthMenu: "Show _MENU_ entries",
                        searchPlaceholder: 'Search here...'
                    }
                });
            });
        </script>
    @endif
@endif

@if (Route::is('admin-panel'))
    <script src="{{ asset('assets/vendor/libs/DataTables/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            var table = $('#DataTables_Table_0').DataTable({
                responsive: false,
                order: [
                    [1, 'asc']
                ],
                language: {
                    lengthMenu: "Show _MENU_ entries",
                    searchPlaceholder: 'Search here...'
                }
            });

            new $.fn.dataTable.Buttons(table, {
                buttons: [{
                    extend: 'collection',
                    text: '<i class="bx bx-export bx-sm me-sm-2"></i> <span class="d-none d-sm-inline-block">Export</span>',
                    className: 'btn btn-outline-danger buttons-collection dropdown-toggle btn-label-danger me-4',
                    buttons: [{
                            extend: 'copy',
                            className: 'dropdown-item',
                            text: '<i class="bx bx-copy me-2"></i> Copy'
                        },
                        {
                            extend: 'csv',
                            className: 'dropdown-item',
                            text: '<i class="bx bx-file me-2"></i> CSV'
                        },
                        {
                            extend: 'excel',
                            className: 'dropdown-item',
                            text: '<i class="bx bx-file me-2"></i> Excel'
                        },
                        {
                            extend: 'pdf',
                            className: 'dropdown-item',
                            text: '<i class="bx bx-file me-2"></i> PDF'
                        },
                        {
                            extend: 'print',
                            className: 'dropdown-item',
                            text: '<i class="bx bx-printer me-2"></i> Print',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4]
                            },
                            title: 'Rekap Peminjaman Barang Laboratorium Informatika',
                            messageTop: 'Rekap Peminjaman Barang Laboratorium'
                        }
                    ]
                }],
            });
            table.buttons().container()
                .appendTo('#exportButtons');
            // Menambahkan tombol "Tambah Record" di sebelah kanan dropdown export
            $('#exportButtons').after(`
    <button class="btn btn-danger create-new ms-2" tabindex="0" aria-controls="DataTables_Table_0" type="button" data-bs-toggle="offcanvas" data-bs-target="#add-new-record">
        <span>
            <i class="bx bx-plus bx-sm me-sm-2"></i>
            <span class="d-none d-sm-inline-block">Tambah Record</span>
        </span>
    </button>`);
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editButtons = document.querySelectorAll('.edit-record');

            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Ambil data dari atribut data- di tombol
                    const nomorInduk = this.getAttribute('data-nomorInduk');
                    const name = this.getAttribute('data-name');
                    const email = this.getAttribute('data-email');
                    // const date = this.getAttribute('data-password');

                    // Set nilai ke dalam input form di offcanvas
                    document.querySelector('#number').value = nomorInduk;
                    document.querySelector('#name').value = name;
                    document.querySelector('#email').value = email;
                    // document.querySelector('#password').value = date;
                    document.querySelector('#form-add-record').setAttribute('action',
                        `/update-user/${nomorInduk}`);
                });
            });

            // Reset form ketika offcanvas ditutup
            const offcanvasElement = document.getElementById('add-new-record');
            offcanvasElement.addEventListener('hidden.bs.offcanvas', function() {
                // Reset semua input di dalam form
                document.querySelector('#form-add-record').reset();
                document.querySelector('#form-add-record').setAttribute('action', '/add-user');
            });
        });
    </script>
@endif

<script src="{{ asset(mix('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/js/menu.js')) }}"></script>

@yield('vendor-script')
<!-- END: Page Vendor JS-->

<!-- Datatables -->

<!-- BEGIN: Theme JS-->
<script src="{{ asset(mix('assets/js/main.js')) }}"></script>

<!-- END: Theme JS-->
<!-- Pricing Modal JS-->
@stack('pricing-script')
<!-- END: Pricing Modal JS-->
<!-- BEGIN: Page JS-->
@yield('page-script')
<!-- END: Page JS-->
