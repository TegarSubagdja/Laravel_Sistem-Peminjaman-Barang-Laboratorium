@extends('layouts/contentNavbarLayout')

@section('title', 'Inventory - Basic Tables')

@section('content')

    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Dashboard /</span>
        <span class="text-danger">Request</span>
    </h4>

    <!-- Hoverable Table rows -->
    <div class="card">
        <div class="card-datatable table-responsive">
            <div class="dataTables_wrapper dt-bootstrap5 no-footer" id="DataTables_Table_0_wrapper">
                <div class="card-header flex-column flex-md-row pb-2">
                    <div class="head-label text-center">
                        <h5 class="card-title mb-0">DataTable with Buttons</h5>
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
                            <th>User_id</th>
                            <th>Item_id</th>
                            <th>Status</th>
                            <th>Rent</th>
                            <th>Due</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($requests as $req)
                            <tr>
                                <td>
                                    <i class="bx bx-user bx-sm text-danger me-3"></i>
                                    <span class="fw-medium">{{ $req->user->name }}</span>
                                </td>
                                <td>
                                    {{ $req->item->name }}
                                </td>
                                <td>
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
                                <td class="small">
                                    {{ $req->loan_date }}
                                </td>
                                <td class="small">
                                    {{ $req->return_date }}
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item edit-record" href="javascript:void(0);"
                                                data-bs-toggle="offcanvas" data-bs-target="#add-new-record"
                                                data-fullname="{{ $req->user_id }}" data-post="{{ $req->item_id }}"
                                                data-email="{{ $req->loan_date }}" data-date="{{ $req->return_date }}">
                                                <i class="bx bx-edit-alt me-1"></i> Edit
                                            </a>
                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                    class="bx bx-trash me-1"></i>
                                                Delete</a>
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
    <!--/ Hoverable Table rows -->

    {{-- Modal --}}
    <div class="offcanvas offcanvas-end" id="add-new-record">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="exampleModalLabel">Tambah Record</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body flex-grow-1">
            <form class="add-new-record pt-0 row g-2 fv-plugins-bootstrap5 fv-plugins-framework" id="form-add-new-record"
                onsubmit="return false" novalidate="novalidate">
                <div class="col-sm-12 fv-plugins-icon-container">
                    <label class="form-label" for="basicFullname">NRP / NODOS</label>
                    <div class="input-group input-group-merge has-validation">
                        <span id="basicFullname2" class="input-group-text"><i class="bx bx-user"></i></span>
                        <input type="text" id="basicFullname" class="form-control dt-full-name" name="basicFullname"
                            placeholder="NRP/NODOS" aria-label="John Doe" aria-describedby="basicFullname2">
                    </div>
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    </div>
                </div>
                <div class="col-sm-12 fv-plugins-icon-container">
                    <label class="form-label" for="basicPost">Nama</label>
                    <div class="input-group input-group-merge has-validation">
                        <span id="basicPost2" class="input-group-text"><i class="bx bx-user"></i></span>
                        <input type="text" id="basicPost" name="basicPost" class="form-control dt-post"
                            placeholder="Nama peminjam" aria-label="Web Developer" aria-describedby="basicPost2">
                    </div>
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    </div>
                </div>
                <div class="col-sm-12 fv-plugins-icon-container">
                    <label class="form-label" for="basicEmail">Tanggal Peminjaman</label>
                    <div class="input-group input-group-merge has-validation">
                        <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                        <input type="date" id="basicEmail" name="basicEmail" class="form-control dt-email"
                            placeholder="MM/DD/YYYY">
                    </div>
                    <div
                        class="fv-plugins-message-container
                            fv-plugins-message-container--enabled invalid-feedback">
                    </div>
                    <div class="form-text">
                        You can use letters, numbers &amp; periods
                    </div>
                </div>
                <div class="col-sm-12 fv-plugins-icon-container">
                    <label class="form-label" for="basicDate">Tanggal Pengembalian</label>
                    <div class="input-group input-group-merge has-validation">
                        <span id="basicDate2" class="input-group-text"><i class="bx bx-calendar"></i></span>
                        <input type="date" class="form-control dt-date flatpickr-input" id="basicDate"
                            name="basicDate" aria-describedby="basicDate2" placeholder="MM/DD/YYYY"
                            aria-label="MM/DD/YYYY" readonly="readonly">
                    </div>
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editButtons = document.querySelectorAll('.edit-record');
            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const fullname = this.getAttribute('data-fullname');
                    const post = this.getAttribute('data-post');
                    const email = this.getAttribute('data-email');
                    const date = this.getAttribute('data-date');
                    const salary = this.getAttribute('data-salary');

                    document.querySelector('#basicFullname').value = fullname;
                    document.querySelector('#basicPost').value = post;
                    document.querySelector('#basicEmail').value = email;
                    document.querySelector('#basicDate').value = date;
                    document.querySelector('#basicSalary').value = salary;
                });
            });
        });
    </script>
@endsection
