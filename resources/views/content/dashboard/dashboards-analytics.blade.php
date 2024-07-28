@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard')

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>
@endsection

@section('content')
    {{-- Heading --}}
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Dashboard /</span>
        <span class="text-danger"> Scan QR-code</span>
    </h4>
    <div class="row">
        <div class="col-12 d-flex justify-content-center align-items-center">
            <div class="card w-100 h-100">
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <h5 class="card-title text-danger">Scan Barang</h5>
                    <div id="reader" class="w-100 mb-4" style="max-width: 250px;">
                    </div>
                    <button href="#" class="btn btn-sm btn-outline-danger">Mulai Scan</button>
                </div>
            </div>
        </div>
    </div>


    {{-- Modal and Trigger --}}
    <button class="dt-button create-new btn btn-danger mt-4" tabindex="0" aria-controls="DataTables_Table_0" type="button"
        data-bs-toggle="offcanvas" data-bs-target="#add-new-record"><span><i class="bx bx-plus me-sm-1"></i> <span
                class="d-none d-sm-inline-block">Add New
                Record</span></span></button>
    <div class="offcanvas offcanvas-end" id="add-new-record">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title" id="exampleModalLabel">New Record</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body flex-grow-1">
            <form class="add-new-record pt-0 row g-2 fv-plugins-bootstrap5 fv-plugins-framework" id="form-add-new-record"
                novalidate="novalidate" action="/send-message" method="POST">
                @csrf
                <div class="col-sm-12 fv-plugins-icon-container">
                    <label class="form-label" for="basicFullname">Full Name</label>
                    <div class="input-group input-group-merge has-validation">
                        <span id="basicFullname2" class="input-group-text"><i class="bx bx-user"></i></span>
                        <input type="text" id="basicFullname" class="form-control dt-full-name" name="basicFullname"
                            placeholder="John Doe" aria-label="John Doe" aria-describedby="basicFullname2">
                    </div>
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                </div>
                <div class="col-sm-12 fv-plugins-icon-container">
                    <label class="form-label" for="basicPost">Post</label>
                    <div class="input-group input-group-merge has-validation">
                        <span id="basicPost2" class="input-group-text"><i class="bx bxs-briefcase"></i></span>
                        <input type="text" id="basicPost" name="basicPost" class="form-control dt-post"
                            placeholder="Web Developer" aria-label="Web Developer" aria-describedby="basicPost2">
                    </div>
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                </div>
                <div class="col-sm-12 fv-plugins-icon-container">
                    <label class="form-label" for="basicEmail">Email</label>
                    <div class="input-group input-group-merge has-validation">
                        <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                        <input type="text" id="basicEmail" name="basicEmail" class="form-control dt-email"
                            placeholder="john.doe@example.com" aria-label="john.doe@example.com">
                    </div>
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                    <div class="form-text">
                        You can use letters, numbers &amp; periods
                    </div>
                </div>
                <div class="col-sm-12 fv-plugins-icon-container">
                    <label class="form-label" for="basicDate">Joining Date</label>
                    <div class="input-group input-group-merge has-validation">
                        <span id="basicDate2" class="input-group-text"><i class="bx bx-calendar"></i></span>
                        <input type="text" class="form-control dt-date flatpickr-input" id="basicDate" name="basicDate"
                            aria-describedby="basicDate2" placeholder="MM/DD/YYYY" aria-label="MM/DD/YYYY"
                            readonly="readonly">
                    </div>
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                </div>
                <div class="col-sm-12 fv-plugins-icon-container">
                    <label class="form-label" for="basicSalary">Salary</label>
                    <div class="input-group input-group-merge has-validation">
                        <span id="basicSalary2" class="input-group-text"><i class="bx bx-dollar"></i></span>
                        <input type="number" id="basicSalary" name="basicSalary" class="form-control dt-salary"
                            placeholder="12000" aria-label="12000" aria-describedby="basicSalary2">
                    </div>
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                </div>
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-danger data-submit me-sm-3 me-1">Submit</button>
                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Cancel</button>
                </div>
                <input type="hidden">
            </form>
        </div>
    </div>

    {{-- Dropdown Badge --}}
    <div class="dropdown open text-white mt-4">
        <a class="btn btn-danger dropdown-toggle" type="button" id="triggerId" data-bs-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Dropdown Anchor
        </a>
        <div class="dropdown-menu" aria-labelledby="triggerId">
            <a class="dropdown-item" href="/badge/add/request-basic/danger/15">Add Badge</a>
            <a class="dropdown-item" href="/badge/remove/request-basic">Remove Badge</a>
            <a class="dropdown-item" href="/data/152021169">Test Route</a>
        </div>
    </div>
@endsection
