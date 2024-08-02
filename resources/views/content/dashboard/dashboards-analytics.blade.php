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
                    <button id="startScan" class="btn btn-sm btn-outline-danger">Mulai Scan</button>
                </div>
            </div>
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
            <a class="dropdown-item" href="/test">Test Route</a>
            <a class="dropdown-item" href="/isAdmin">Text Fungsi di model</a>
        </div>
    </div>

    <form action="/test" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Text Scan</label>
            <input type="text" class="form-control" name="decodeText" id="" aria-describedby="emailHelpId"
                placeholder="abc@mail.com" value="102030" readonly />
            <small id="emailHelpId" class="form-text text-muted">Help text</small>
            <button type="submit" class="btn btn-outline-danger">Submit</button>
        </div>
    </form>

    <!-- Modal -->
    <form action="/rent" method="POST">
        @csrf
        <div class="modal fade" id="myModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-between align-items-start">
                        <div class="col">
                            <h5 class="modal-title text-uppercase" id="modalCenterTitle">Detail Barang</h5>
                            <h6 id="lab" class="badge bg-label-success"></h6>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <label for="nameWithTitle" class="form-label">Foto Barang</label>
                                <img id="pic" class="img-fluid" src="" alt="Card image cap">
                                <div class="col mt-3">
                                    <label class="form-label">Deskripsi Barang</label>
                                    <p id="desk" class="card-text">
                                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Adipisci, accusantium!
                                    </p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="col mb-3">
                                    <label for="nameWithTitle" class="form-label">Code Barang</label>
                                    <input type="text" id="code" class="form-control" placeholder="Enter Name"
                                        name="code" readonly>
                                </div>
                                <div class="col mb-3">
                                    <label for="nameWithTitle" class="form-label">Nama Barang</label>
                                    <input type="text" id="name" class="form-control" placeholder="Enter Name"
                                        name="item" readonly>
                                </div>
                                <div class="col mb-3">
                                    <label for="nameWithTitle" class="form-label">Jumlah</label>
                                    <input type="number" value="1" id="amount" class="form-control" name="amount"
                                        placeholder="Jumlah barang">
                                </div>
                                <div class="col mb-3">
                                    <label for="nameWithTitle" class="form-label">Tanggal Peminjaman</label>
                                    <input required type="date" id="nameWithTitle" class="form-control"
                                        placeholder="Enter Name" name="date">
                                </div>
                                <div class="col mb-3">
                                    <label for="nameWithTitle" class="form-label">Tanggal Pengembalian</label>
                                    <input required type="date" id="nameWithTitle" class="form-control"
                                        placeholder="Enter Name" name="due">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Pinjam</button>
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Blade Template -->
    <script>
        var baseUrl = "{{ asset('') }}";
    </script>

@endsection
