@extends('layouts/contentNavbarLayout')

@section('title', 'Inventory - Basic Tables')

@section('page-script')
    <script src="{{ asset('assets/js/ui-popover.js') }}"></script>
@endsection

@section('content')

    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Dashboard /</span>
        <span class="text-danger">Request</span>
    </h4>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
        </div>
    @elseif (session('error'))
        <div class="alert alert-danger alert-dismissible" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
        </div>
    @endif
    <!-- Table -->
    <div class="card">
        <div class="card-datatable table-responsive">
            <div class="dataTables_wrapper dt-bootstrap5 no-footer" id="DataTables_Table_0_wrapper">
                <div class="card-header d-flex flex-column flex-sm-row pb-2">
                    <div class="head-label text-start small">
                        <h5 class="card-title mb-0">Daftar Pengajuan</h5>
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
                            <th></th>
                            <th class="text-start">Nama Pengaju</th>
                            <th class="text-start">Item</th>
                            <th class="text-start">Jumlah</th>
                            <th class="text-start">Status</th>
                            <th class="text-start">Tanggal Peminjaman</th>
                            <th class="text-start">Tanggal Pengembalian</th>
                            <th class="text-start">Keterangan</th>
                            @if (auth()->user()->isAdmin())
                                <th class="text-start">Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($requests as $req)
                            <tr>
                                <td></td>
                                <td class="text-start">
                                    {{ $req->user->name }}
                                </td>
                                <td class="text-start">
                                    {{ $req->item->name }}
                                </td>
                                <td class="text-start">
                                    {{ $req->quantity }}
                                </td>
                                <td class="text-start">
                                    @if ($req->status == 'waiting')
                                        <span class="badge bg-label-warning me-1">{{ $req->status }}</span>
                                    @elseif ($req->status == 'approved')
                                        <span class="badge bg-label-success me-1">{{ $req->status }}</span>
                                    @elseif ($req->status == 'rejected')
                                        <span class="badge bg-label-danger me-1">{{ $req->status }}</span>
                                    @elseif ($req->status == 'cancelled')
                                        <span class="badge bg-label-dark me-1">{{ $req->status }}</span>
                                    @elseif ($req->status == 'done')
                                        <span class="badge bg-label-info me-1">{{ $req->status }}</span>
                                    @endif
                                </td>
                                <td class="text-start small">
                                    {{ $req->loan_date }}
                                </td>
                                <td class="text-start small">
                                    {{ $req->return_date }}
                                </td>
                                <td class="text-start text-truncate" style="max-width: 100px">
                                    @if ($req->desc)
                                        {{ $req->desc }}
                                    @else
                                        Keterangan tidak tersedia
                                    @endif
                                </td>
                                @if (auth()->user()->isAdmin())
                                    <td class="text-start">
                                        <div class="dropdown">
                                            @if ($req->isWaiting())
                                                <button type="button" class="btn btn-warning btn-sm approve"
                                                    data-bs-toggle="modal" data-bs-target="#smallModal"
                                                    data-id="{{ $req->id }}" data-user="{{ $req->user->name }}"
                                                    data-item="{{ $req->item->name }}">Approve</button>
                                            @elseif ($req->isApprove())
                                                <form action="/done/{{ $req->id }}" method="POST"
                                                    style="display: inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-sm">Done</button>
                                                </form>
                                            @endif
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown"><i
                                                    class="bx bx-dots-vertical-rounded"></i></button>
                                            <div class="dropdown-menu">
                                                <form action="/reject/{{ $req->id }}" method="POST">
                                                    @csrf
                                                    <button class="dropdown-item" href="javascript:void(0);"><i
                                                            class="bx bx-x me-1"></i> Reject</button>
                                                </form>
                                                <form action="/done/{{ $req->id }}" method="POST">
                                                    @csrf
                                                    <button type="submit" id="toggle" class="dropdown-item"
                                                        href="javascript:void(0);"><i class="bx bx-revision me-1"></i>
                                                        Returned</button>
                                                </form>
                                                <form action="/delete/{{ $req->id }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="dropdown-item text-danger"><i
                                                            class="bx bx-trash me-1"></i> Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                @endif
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
                            id="form-add-record">
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
                                <label class="form-label" for="code">Jumlah Barang</label>
                                <div class="input-group input-group-merge has-validation">
                                    <span class="input-group-text"><i class="bx bx-barcode"></i></span>
                                    <input type="number" id="quantity1" name="quantity" class="form-control dt-code"
                                        placeholder="Masukan Code Barang" value="102030" min="1" required>
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
                            id="form-add-new-record">
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
                                <label class="form-label" for="code">Jumlah Barang</label>
                                <div class="input-group input-group-merge has-validation">
                                    <span class="input-group-text"><i class="bx bx-barcode"></i></span>
                                    <input type="number" id="quantity2" name="quantity" class="form-control dt-code"
                                        placeholder="Masukan Code Barang" value="102030" min="1" required>
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
                                        class="form-control dt-return_date" placeholder="" required>
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
    {{-- End Modal Tambah --}}

    <!-- Small Modal -->
    <div class="modal fade" id="smallModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel2">Tambahkan Keterangan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST" id="add-desc">
                        @csrf
                        <div class="row g-2 mb-2">
                            <div class="col mb-0">
                                <label class="form-label" for="user">User</label>
                                <input type="text" class="form-control" id="user">
                            </div>
                            <div class="col mb-0">
                                <label for="item" class="form-label">Item</label>
                                <input id="item" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-0">
                                <label for="text-keterangan" class="form-label">Masukan Keterangan</label>
                                <textarea class="form-control" name="desc" id="text-keterangan" rows="3"></textarea>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Lewati</button>
                    <button type="submit" class="btn btn-danger">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
