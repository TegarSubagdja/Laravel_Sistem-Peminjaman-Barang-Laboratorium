<!-- BEGIN: Vendor JS-->
<script src="{{ asset(mix('assets/vendor/libs/jquery/jquery.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/popper/popper.js')) }}"></script>

@if (!Route::is('request-basic', 'admin-panel'))
    <script src="{{ asset(mix('assets/vendor/js/bootstrap.js')) }}"></script>
@endif

@if (Route::is('dashboard'))
    <script src="{{ asset(mix('js/scan-qr.js')) }}"></script>
@elseif (!Route::is('inventory-basic'))
    <script src="{{ asset('assets/vendor/libs/DataTables/datatables.min.js') }}"></script>
@endif

@if (Route::is('request-basic'))
    @if (Auth::user()->isAdmin())
        <script src="{{ asset('assets/vendor/libs/Typehead/bootstrap3-typeahead.min.js') }}"></script>

        <script>
            $(document).ready(function() {
                var table = $('#DataTables_Table_0').DataTable({
                    responsive: true,
                    columnDefs: [{
                            responsivePriority: 1,
                            targets: 0,
                        },
                        {
                            responsivePriority: 2,
                            targets: 1,
                        },
                        {
                            responsivePriority: 3,
                            targets: 2,
                        },
                        {
                            responsivePriority: 4,
                            targets: 3,
                        },
                        {
                            responsivePriority: 5,
                            targets: 4,
                        },
                        {
                            responsivePriority: 5,
                            targets: 8,
                        },
                        {
                            className: '',
                            orderable: false,
                            targets: 0,
                        },
                    ],
                    order: [
                        [5, 'desc']
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
                                    columns: [1, 2, 3, 4, 5]
                                },
                                title: 'Rekap Peminjaman Barang Laboratorium Informatika',
                                messageTop: 'Rekap Peminjaman Barang Laboratorium'
                            }
                        ]
                    }],
                });
                table.buttons().container()
                    .appendTo('#exportButtons');
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

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const editButtons = document.querySelectorAll('.approve');

                editButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const id = this.getAttribute('data-id');
                        const user = this.getAttribute('data-user');
                        const item = this.getAttribute('data-item');
                        // const desc = this.getAttribute('data-item');

                        document.querySelector('#user').value = user;
                        document.querySelector('#item').value = item;
                        // document.querySelector('#desc').value = desc;

                        document.querySelector('#add-desc').setAttribute('action',
                            `/approve/${id}`);
                    });
                });

                const modalDesc = document.getElementById('smallModal');
                modalDesc.addEventListener('hidden.bs.offcanvas', function() {
                    document.querySelector('#add-desc').reset();
                    // document.querySelector('#form-add-record').setAttribute('action', '/add-user');
                });
            });
        </script>
    @else
        <script>
            $(document).ready(function() {
                var table = $('#DataTables_Table_0').DataTable({
                    responsive: true,
                    columnDefs: [{
                            responsivePriority: 1,
                            targets: 0
                        },
                        {
                            responsivePriority: 2,
                            targets: 1
                        },
                        {
                            responsivePriority: 3,
                            targets: 2
                        },
                        {
                            responsivePriority: 4,
                            targets: 3
                        },
                        {
                            responsivePriority: 5,
                            targets: 4
                        },
                        {
                            className: '',
                            orderable: false,
                            targets: 0,
                        }
                    ],
                    order: [
                        [5, 'desc']
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

@if (Route::is('inventory-basic'))
    @if (Auth::user()->isAdmin())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const editButtons = document.querySelectorAll('.edit-item');
                const title = document.getElementById('exampleModalLabel');

                editButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const labOption = document.getElementById('lab');
                        const name = this.getAttribute('data-name');
                        const lab = this.getAttribute('data-lab');
                        const desc = this.getAttribute('data-desc');
                        const code = this.getAttribute('data-code');

                        title.innerHTML = 'Edit Item';
                        document.querySelector('#name').value = name;
                        for (let i = 0; i < labOption.options.length; i++) {
                            if (labOption.options[i].value === lab) {
                                labOption.selectedIndex = i;
                                break;
                            }
                        }
                        document.querySelector('#desc').value = desc;
                        document.querySelector('#code').value = code;
                        document.querySelector('#form-add-new-record').setAttribute('action',
                            `/update-item/${code}`);
                    });
                });

                const offcanvasElement = document.getElementById('add-new-record');
                offcanvasElement.addEventListener('hidden.bs.offcanvas', function() {
                    title.innerHTML = "Tambah Barang";
                    document.querySelector('#form-add-new-record').reset();
                    document.querySelector('#form-add-new-record').setAttribute('action', '/add-item');
                });

                // Menambahkan event listener pada tombol card item
                const cardButtons = document.querySelectorAll('.rent');

                cardButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const code = this.getAttribute('data-code');

                        $.ajax({
                            url: '/detail-item',
                            type: 'POST',
                            contentType: 'application/json',
                            data: JSON.stringify({
                                decodeText: code
                            }),
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {

                                var item = response.item;
                                var $code = document.getElementById('input-code');
                                var $name = document.getElementById('input-name');
                                var $desk = document.getElementById('input-desk');
                                var $pic = document.getElementById('pic');
                                var $lab = document.getElementById('lab');

                                // Update the modal content
                                $code.value = item.code;
                                $name.value = item.name;
                                $desk.innerHTML = item.description;
                                $pic.src = `${baseUrl}/${item.picture}`;
                                $lab.innerHTML = item.lab.name;

                                // Show the modal
                                $('#myModal').modal('show');
                            },
                            error: function(xhr, status, error) {
                                console.error("Error sending data: ", error);
                                alert("Failed to send data");
                            }
                        });
                    });
                });
            });
        </script>
    @else
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Menambahkan event listener pada tombol card item
                const cardButtons = document.querySelectorAll('.rent');

                cardButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const code = this.getAttribute('data-code');

                        $.ajax({
                            url: '/detail-item',
                            type: 'POST',
                            contentType: 'application/json',
                            data: JSON.stringify({
                                decodeText: code
                            }),
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {

                                var item = response.item;
                                console.log(document.getElementById('input-code'));
                                var $code = document.getElementById('input-code');
                                var $name = document.getElementById('input-name');
                                var $desk = document.getElementById('input-desk');
                                var $pic = document.getElementById('pic');
                                var $lab = document.getElementById('lab');

                                // Update the modal content
                                $code.value = item.code;
                                $name.value = item.name;
                                $desk.innerHTML = item.description;
                                $pic.src = `${baseUrl}/${item.picture}`;
                                $lab.innerHTML = item.lab.name;

                                // Show the modal
                                $('#myModal').modal('show');
                            },
                            error: function(xhr, status, error) {
                                console.error("Error sending data: ", error);
                                alert("Failed to send data");
                            }
                        });
                    });
                });
            });
        </script>
    @endif
@endif

@if (Route::is('admin-panel'))
    {{-- User --}}
    <script>
        $(document).ready(function() {
            var table = $('#DataTables_Table_0').DataTable({
                responsive: true,
                columnDefs: [{
                        className: 'text-start',
                        orderable: false,
                        targets: 0,
                    },
                    {
                        responsivePriority: 1,
                        targets: 0,
                    }
                ],
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

    {{-- Lab --}}
    <script>
        $(document).ready(function() {
            var table = $('#lab-table').DataTable({
                responsive: true,
                columnDefs: [{
                        className: 'text-start',
                        orderable: false,
                        targets: 0,
                    },
                    {
                        responsivePriority: 1,
                        targets: 0,
                    }
                ],
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
                .appendTo('#exportButtonsLab');
            // Menambahkan tombol "Tambah Record" di sebelah kanan dropdown export
            $('#exportButtonsLab').after(`
<button class="btn btn-danger create-new ms-2" tabindex="0" aria-controls="lab-table" type="button" data-bs-toggle="offcanvas" data-bs-target="#other-new-record">
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
                    const nomorInduk = this.getAttribute('data-nomorInduk');
                    const name = this.getAttribute('data-name');
                    const email = this.getAttribute('data-email');
                    document.querySelector('#number').value = nomorInduk;
                    document.querySelector('#name').value = name;
                    document.querySelector('#email').value = email;
                    document.querySelector('#form-add-record').setAttribute('action',
                        `/update-user/${nomorInduk}`);
                });
            });

            const offcanvasElement = document.getElementById('add-new-record');
            offcanvasElement.addEventListener('hidden.bs.offcanvas', function() {
                document.querySelector('#form-add-record').reset();
                document.querySelector('#form-add-record').setAttribute('action', '/add-user');
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editButtons = document.querySelectorAll('.edit-record-lab');

            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const idLab = this.getAttribute('data-id-lab');
                    const name = this.getAttribute('data-name-lab');
                    const location = this.getAttribute('data-location-lab');
                    document.querySelector('#name-lab').value = name;
                    document.querySelector('#location-lab').innerHTML = location;
                    document.querySelector('#form-other-record').setAttribute('action',
                        `/update-lab/${idLab}`);
                });
            });

            const offcanvasElement = document.getElementById('other-new-record');
            offcanvasElement.addEventListener('hidden.bs.offcanvas', function() {
                document.querySelector('#form-other-record').reset();
                document.querySelector('#form-other-record').setAttribute('action', '/add-lab');
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
