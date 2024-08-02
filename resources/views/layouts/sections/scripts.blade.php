<!-- BEGIN: Vendor JS-->
<script src="{{ asset(mix('assets/vendor/libs/jquery/jquery.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/popper/popper.js')) }}"></script>
@if (!Route::is('request-basic'))
    <script src="{{ asset(mix('assets/vendor/js/bootstrap.js')) }}"></script>
@endif
<script src="{{ asset(mix('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/js/menu.js')) }}"></script>
@if (Route::is('dashboard'))
    <script src="{{ asset(mix('js/scan-qr.js')) }}"></script>
@endif
@yield('vendor-script')
<!-- END: Page Vendor JS-->

<!-- Datatables -->
@if (Route::is('request-basic'))
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script> --}}
    <script src="{{ asset('assets/vendor/libs/DataTables/datatables.min.js') }}"></script>
    @if (Auth::user()->isAdmin())
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
                                text: '<i class="bx bx-printer me-2"></i> Print'
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

<!-- BEGIN: Theme JS-->
<script src="{{ asset(mix('assets/js/main.js')) }}"></script>

<!-- END: Theme JS-->
<!-- Pricing Modal JS-->
@stack('pricing-script')
<!-- END: Pricing Modal JS-->
<!-- BEGIN: Page JS-->
@yield('page-script')
<!-- END: Page JS-->
