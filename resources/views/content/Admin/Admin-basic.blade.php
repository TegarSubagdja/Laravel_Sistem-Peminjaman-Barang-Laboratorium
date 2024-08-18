@extends('layouts/contentNavbarLayout')

@section('title', 'Inventory - Basic Tables')

@section('page-script')
    <script src="{{ asset('assets/js/ui-popover.js') }}"></script>
@endsection

@section('content')

    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Dashboard /</span>
        <span class="text-danger">Admin </span>
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
    <!-- Table User -->
    <div class="card mb-5">
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
                            <th></th>
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
                                <td></td>
                                <td class="text-start">{{ $user->nrp }}</td>
                                <td class="text-start">{{ $user->name }}</td>
                                <td class="text-start">{{ $user->email }}</td>
                                <td class="text-start text-truncate" style="max-width: 20vw">
                                    {{-- <div class="form-password-toggle">
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="{{ $user->id }}"
                                                placeholder="············" value="{{ $user->password }}" readonly>
                                            <span id="{{ $user->id }}" class="input-group-text cursor-pointer"><i
                                                    class="bx bx-hide"></i></span>
                                        </div>
                                    </div> --}}
                                    {{ $user->password }}
                                </td>
                                <td class="text-start">{{ $user->role }}</td>
                                <td class="text-start small">
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item edit-record" href="javascript:void(0);"
                                                data-bs-toggle="offcanvas" data-bs-target="#add-new-record"
                                                data-nomorInduk="{{ $user->nrp }}" data-name="{{ $user->name }}"
                                                data-email="{{ $user->email }}" data-password="{{ $user->password }}">
                                                <i class="bx bx-edit-alt me-1"></i> Edit
                                            </a>
                                            <form action="/delete-user/{{ $user->nrp }}" method="POST">
                                                @csrf
                                                <button type="submit" class="dropdown-item"><i
                                                        class="bx bx-trash me-1"></i> Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--/ End Table -->

    @if (session('succes'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{ session('succes') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
        </div>
    @elseif (session('errors'))
        <div class="alert alert-danger alert-dismissible" role="alert">
            {{ session('errors') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
        </div>
    @endif
    <!-- Table Lab -->
    <div class="card">
        <div class="card-datatable table-responsive">
            <div class="dataTables_wrapper dt-bootstrap5 no-footer" id="DataTables_Table_0_wrapper">
                <div class="card-header flex-column flex-md-row pb-2">
                    <div class="head-label text-start small">
                        <h5 class="card-title mb-0">Daftar Lab</h5>
                    </div>
                    <div class="dt-action-buttons text-end p-sm-2">
                        <div class="dt-buttons flex-wrap" id="export">
                            {{-- Export Button --}}
                            <div id="exportButtonsLab" class="btn-group"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive text-nowrap">
                {{-- Table Record --}}
                <table class="datatables-basic table border-top dataTable no-footer dtr-column collapsed" id="lab-table"
                    aria-describedby="DataTables_Table_0_info" style="width: 1390px;">
                    <thead>
                        <tr>
                            <th></th>
                            <th class="text-start small">ID</th>
                            <th class="text-start small">Nama</th>
                            <th class="text-start small">Location</th>
                            @if (auth()->user()->isAdmin())
                                <th class="text-start small">Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($labs as $lab)
                            <tr>
                                <td></td>
                                <td class="text-start">{{ $lab->id }}</td>
                                <td class="text-start">{{ $lab->name }}</td>
                                <td class="text-start">{{ $lab->location }}</td>
                                <td class="text-start small">
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item edit-record-lab" href="javascript:void(0);"
                                                data-bs-toggle="offcanvas" data-bs-target="#other-new-record"
                                                data-id-lab="{{ $lab->id }}" data-name-lab="{{ $lab->name }}"
                                                data-location-lab="{{ $lab->location }}">
                                                <i class="bx bx-edit-alt me-1"></i> Edit
                                            </a>
                                            <form action="/delete-lab/{{ $lab->id }}" method="POST">
                                                @csrf
                                                <button type="submit" class="dropdown-item text-danger"><i
                                                        class="bx bx-trash me-1"></i> Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--/ End Table -->

    {{-- Offcanvas User --}}
    <div class="offcanvas offcanvas-end" id="add-new-record">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="exampleModalLabel">Tambah Record</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body flex-grow-1">
            <form action="/add-user" method="POST"
                class="add-new-record pt-0 row g-2 fv-plugins-bootstrap5 fv-plugins-framework" id="form-add-record"
                novalidate="novalidate">
                @csrf
                <div class="col-sm-12 fv-plugins-icon-container">
                    <label class="form-label">NRP / NODOS</label>
                    <div class="input-group input-group-merge has-validation">
                        <span id="nomorInduk2" class="input-group-text"><i class="bx bx-id-card"></i></span>
                        <input type="text" id="number" class="form-control dt-full-name" name="nrp"
                            placeholder="Masukan Nomer Induk" required>
                    </div>
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    </div>
                </div>
                <div class="col-sm-12 fv-plugins-icon-container">
                    <label class="form-label">Nama</label>
                    <div class="input-group input-group-merge has-validation">
                        <span class="input-group-text"><i class="bx bx-barcode"></i></span>
                        <input type="text" id="name" name="name" class="form-control dt-code"
                            placeholder="Masukan Nama" required>
                    </div>
                    <div
                        class="fv-plugins-message-container
                  fv-plugins-message-container--enabled invalid-feedback">
                    </div>
                </div>
                <div class="col-sm-12 fv-plugins-icon-container">
                    <label class="form-label">E-Mail</label>
                    <div class="input-group input-group-merge has-validation">
                        <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                        <input type="email" id="email" name="email" class="form-control dt-loan_date"
                            placeholder="Masukan E-mail" required>
                    </div>
                    <div
                        class="fv-plugins-message-container
                  fv-plugins-message-container--enabled invalid-feedback">
                    </div>
                </div>
                <div class="col-sm-12 fv-plugins-icon-container">
                    <label class="form-label">Password</label>
                    <div class="input-group input-group-merge has-validation">
                        <span class="input-group-text"><i class="bx bx-key"></i></span>
                        <input type="password" id="password" name="password" class="form-control dt-return_date"
                            placeholder="Masukan Password">
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
                        class="fv-plugins-message-container
                  fv-plugins-message-container--enabled invalid-feedback">
                    </div>
                </div>
                <div class="col-sm-12 mt-4">
                    <button type="submit" class="btn btn-danger data-submit me-sm-3 me-1">Simpan</button>
                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Batal</button>
                </div>
                <input type="hidden">
            </form>
        </div>
    </div>
    {{-- End --}}

    {{-- Off Canvas Lab --}}
    <div class="offcanvas offcanvas-end" id="other-new-record">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="exampleModalLabel">Tambah Lab</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body flex-grow-1">
            <form action="/add-lab" method="POST"
                class="add-new-record pt-0 row g-2 fv-plugins-bootstrap5 fv-plugins-framework" id="form-other-record"
                novalidate="novalidate">
                @csrf
                <div class="col-sm-12 fv-plugins-icon-container">
                    <label class="form-label">Nama Lab</label>
                    <div class="input-group input-group-merge has-validation">
                        <span id="nomorInduk2" class="input-group-text"><i class="bx bx-id-card"></i></span>
                        <input type="text" id="name-lab" class="form-control dt-full-name" name="nameLab"
                            placeholder="Masukan Nomer Induk" required>
                    </div>
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    </div>
                </div>
                <div class="col-sm-12 fv-plugins-icon-container">
                    <label class="form-label">Lokasi</label>
                    <textarea class="form-control" name="locationLab" id="location-lab" placeholder="Masukan Lokasi" rows="10"></textarea>
                    <div
                        class="fv-plugins-message-container
                fv-plugins-message-container--enabled invalid-feedback">
                    </div>
                </div>
                <div class="col-sm-12 mt-4">
                    <button type="submit" class="btn btn-danger data-submit me-sm-3 me-1">Simpan</button>
                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Batal</button>
                </div>
                <input type="hidden">
            </form>
        </div>
    </div>
    {{-- End Moal Tambah --}}
@endsection
