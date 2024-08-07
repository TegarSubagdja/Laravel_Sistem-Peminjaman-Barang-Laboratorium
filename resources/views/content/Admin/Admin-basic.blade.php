@extends('layouts/contentNavbarLayout')

@section('title', 'Inventory - Basic Tables')

@section('page-script')
    <script src="{{ asset('assets/js/ui-popover.js') }}"></script>
@endsection

@section('content')

    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Dashboard /</span>
        <span class="text-danger">Admin</span>
    </h4>
    @if (session('success'))
        <div class="alert alert-danger alert-dismissible" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
        </div>
    @endif
    <!-- Table -->
    <div class="card">
        <div class="card-datatable table-responsive">
            <div class="dataTables_wrapper dt-bootstrap5 no-footer" id="DataTables_Table_0_wrapper">
                <div class="card-header flex-column flex-md-row pb-2">
                    <div class="head-label text-start small">
                        <h5 class="card-title mb-0">Daftar Pengguna</h5>
                    </div>
                    <div class="dt-action-buttons text-end p-sm-2">
                        <div class="dt-buttons flex-wrap" id="export">
                            {{-- Export Button --}}
                            <div id="exportButtons" class="btn-group"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive text-nowrap">
                {{-- Table Record --}}
                <table class="datatables-basic table border-top dataTable no-footer dtr-column collapsed"
                    id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" style="width: 1390px;">
                    <thead>
                        <tr>
                            <th class="text-start small">NRP</th>
                            <th class="text-start small">Nama</th>
                            <th class="text-start small">E-Mail</th>
                            <th class="text-start small">Password</th>
                            <th class="text-start small">Role</th>
                            @if (auth()->user()->isAdmin())
                                <th class="text-start small">Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($users as $user)
                            <tr>
                                <td class="text-start">{{ $user->nrp }}</td>
                                <td class="text-start">{{ $user->name }}</td>
                                <td class="text-start">{{ $user->email }}</td>
                                <td class="text-start text-truncate" style="max-width: 5vw">{{ $user->password }}</td>
                                <td class="text-start">{{ $user->role }}</td>
                                <td class="text-start">Action</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--/ End Table -->

    {{-- Modal Tambah --}}
    <div class="offcanvas offcanvas-end" id="add-new-record">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="exampleModalLabel">Tambah Record</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body flex-grow-1">
            <div class="nav-align-top mb-4">
                <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
                    <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-pills-justified-registered"
                            aria-controls="navs-pills-justified-registered" aria-selected="true"><i
                                class="tf-icons bx bx-user-check me-1"></i><span class="d-none d-sm-block">
                                Terdaftar</span></button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-pills-justified-new-user" aria-controls="navs-pills-justified-new-user"
                            aria-selected="false"><i class="tf-icons bx bx-user-plus me-1"></i><span
                                class="d-none d-sm-block">
                                User Baru</span></button>
                    </li>
                </ul>
                <div class="tab-content p-0">
                    {{-- Tabs user --}}
                    <div class="tab-pane fade active show" id="navs-pills-justified-registered" role="tabpanel">
                        <form action="/add-loan" method="POST"
                            class="add-new-record pt-0 row g-2 fv-plugins-bootstrap5 fv-plugins-framework"
                            id="form-add-record" novalidate="novalidate">
                            @csrf
                            <div class="col-sm-12 fv-plugins-icon-container">
                                <label class="form-label" for="nomorInduk">NRP / NODOS</label>
                                <div class="input-group input-group-merge has-validation">
                                    <span id="nomorInduk2" class="input-group-text"><i class="bx bx-id-card"></i></span>
                                    <input type="text" id="nomorIndukPencarian" class="form-control dt-full-name"
                                        name="nrp" placeholder="Masukan Nomer Induk" value="152021171" required>
                                </div>
                                <div
                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                </div>
                            </div>
                            <div class="col-sm-12 fv-plugins-icon-container">
                                <label class="form-label" for="code">Code Barang</label>
                                <div class="input-group input-group-merge has-validation">
                                    <span class="input-group-text"><i class="bx bx-barcode"></i></span>
                                    <input type="number" id="code" name="code" class="form-control dt-code"
                                        placeholder="Masukan Code Barang" value="102030" required>
                                </div>
                                <div
                                    class="fv-plugins-message-container
                                    fv-plugins-message-container--enabled invalid-feedback">
                                </div>
                            </div>
                            <div class="col-sm-12 fv-plugins-icon-container">
                                <label class="form-label" for="loan_date">Tanggal Peminjaman</label>
                                <div class="input-group input-group-merge has-validation">
                                    <span class="input-group-text"><i class="bx bx-calendar-plus"></i></span>
                                    <input type="date" id="loan_date" name="loan_date"
                                        class="form-control dt-loan_date" placeholder="" required>
                                </div>
                                <div
                                    class="fv-plugins-message-container
                                    fv-plugins-message-container--enabled invalid-feedback">
                                </div>
                            </div>
                            <div class="col-sm-12 fv-plugins-icon-container">
                                <label class="form-label" for="return_date">Tanggal Pengembalian</label>
                                <div class="input-group input-group-merge has-validation">
                                    <span class="input-group-text"><i class="bx bx-calendar-minus"></i></span>
                                    <input type="date" id="return_date" name="return_date"
                                        class="form-control dt-return_date" placeholder="">
                                </div>
                                <div
                                    class="fv-plugins-message-container
                                    fv-plugins-message-container--enabled invalid-feedback">
                                </div>
                            </div>
                            <div class="col-sm-12 mt-4">
                                <button type="submit" class="btn btn-danger data-submit me-sm-3 me-1">Simpan</button>
                                <button type="reset" class="btn btn-outline-secondary"
                                    data-bs-dismiss="offcanvas">Batal</button>
                            </div>
                            <input type="hidden">
                        </form>
                    </div>
                    {{-- End Tabs user --}}
                    {{-- Tabs new User --}}
                    <div class="tab-pane fade" id="navs-pills-justified-new-user" role="tabpanel">
                        <form action="/add-loan-new" method="POST"
                            class="add-new-record pt-0 row g-2 fv-plugins-bootstrap5 fv-plugins-framework"
                            id="form-add-new-record" novalidate="novalidate">
                            @csrf
                            <div class="col-sm-12 fv-plugins-icon-container">
                                <label class="form-label">NRP / NODOS</label>
                                <div class="input-group input-group-merge has-validation">
                                    <span id="nomorInduk2" class="input-group-text"><i class="bx bx-id-card"></i></span>
                                    <input type="text" id="nomorInduk" class="form-control dt-full-name"
                                        name="nomorInduk" placeholder="Masukan Nomer Induk" value="152021171" required>
                                </div>
                                <div
                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                </div>
                            </div>
                            <div class="col-sm-12 fv-plugins-icon-container">
                                <label class="form-label" for="basicPost">Nama</label>
                                <div class="input-group input-group-merge has-validation">
                                    <span id="username" class="input-group-text"><i class="bx bx-user"></i></span>
                                    <input type="text" id="basicPost" name="username" class="form-control dt-post"
                                        placeholder="Masukan Nama" value="Alif" required>
                                </div>
                                <div
                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                </div>
                            </div>
                            <div class="col-sm-12 fv-plugins-icon-container">
                                <label class="form-label" for="email">Email</label>
                                <div class="input-group input-group-merge has-validation">
                                    <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                                    <input type="email" id="email" name="email" class="form-control dt-email"
                                        placeholder="Masukan Email" value="alif@gmail.com">
                                </div>
                                <div
                                    class="fv-plugins-message-container
                              fv-plugins-message-container--enabled invalid-feedback">
                                </div>
                            </div>
                            <div class="col-sm-12 fv-plugins-icon-container">
                                <label class="form-label" for="password">Password</label>
                                <div class="input-group input-group-merge has-validation">
                                    <span class="input-group-text"><i class="bx bx-key"></i></span>
                                    <input type="password" id="password" name="password"
                                        class="form-control dt-password" placeholder="Masukan Password" value="password"
                                        required>
                                </div>
                                <div
                                    class="fv-plugins-message-container
                            fv-plugins-message-container--enabled invalid-feedback">
                                </div>
                            </div>
                            <div class="col-sm-12 fv-plugins-icon-container">
                                <label class="form-label">Role User</label>
                                <select id="lab" class="form-select" name="role" required>
                                    <option value="user">User</option>
                                    <option value="admin">Admin</option>
                                </select>
                                <div
                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                </div>
                            </div>
                            <div class="col-sm-12 fv-plugins-icon-container">
                                <label class="form-label" for="code">Code Barang</label>
                                <div class="input-group input-group-merge has-validation">
                                    <span class="input-group-text"><i class="bx bx-barcode"></i></span>
                                    <input type="number" id="new-code" name="code" class="form-control dt-code"
                                        placeholder="Masukan Code Barang" value="102030" required>
                                </div>
                                <div
                                    class="fv-plugins-message-container
                          fv-plugins-message-container--enabled invalid-feedback">
                                </div>
                            </div>
                            <div class="col-sm-12 fv-plugins-icon-container">
                                <label class="form-label" for="loan_date">Tanggal Peminjaman</label>
                                <div class="input-group input-group-merge has-validation">
                                    <span class="input-group-text"><i class="bx bx-calendar-plus"></i></span>
                                    <input type="date" id="new-loan_date" name="loan_date"
                                        class="form-control dt-loan_date" placeholder="" required>
                                </div>
                                <div
                                    class="fv-plugins-message-container
                          fv-plugins-message-container--enabled invalid-feedback">
                                </div>
                            </div>
                            <div class="col-sm-12 fv-plugins-icon-container">
                                <label class="form-label" for="return_date">Tanggal Pengembalian</label>
                                <div class="input-group input-group-merge has-validation">
                                    <span class="input-group-text"><i class="bx bx-calendar-minus"></i></span>
                                    <input type="date" id="new-return_date" name="return_date"
                                        class="form-control dt-return_date" placeholder="">
                                </div>
                                <div
                                    class="fv-plugins-message-container
                          fv-plugins-message-container--enabled invalid-feedback">
                                </div>
                            </div>
                            <div class="col-sm-12 mt-4">
                                <button type="submit" class="btn btn-danger data-submit me-sm-3 me-1">Simpan</button>
                                <button type="reset" class="btn btn-outline-secondary"
                                    data-bs-dismiss="offcanvas">Batal</button>
                            </div>
                            <input type="hidden">
                        </form>
                    </div>
                    {{-- End new user --}}
                </div>
            </div>

        </div>
    </div>
    {{-- End Moal Tambah --}}

    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editButtons = document.querySelectorAll('.edit-record');
            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const nomorInduk = this.getAttribute('data-fullname');
                    const post = this.getAttribute('data-post');
                    const email = this.getAttribute('data-email');
                    const date = this.getAttribute('data-date');
                    const salary = this.getAttribute('data-salary');

                    document.querySelector('#nomorInduk').value = fullname;
                    document.querySelector('#basicPost').value = post;
                    document.querySelector('#email').value = email;
                    document.querySelector('#basicDate').value = date;
                    document.querySelector('#basicSalary').value = salary;
                });
            });
            $('#DataTables_Table_0').on('click', '.lihat-selengkapnya', function(event) {
                event.preventDefault();
                const content = $(this).data('content');
                $('#modalText').text(content);
            });
        });
    </script> --}}
@endsection
