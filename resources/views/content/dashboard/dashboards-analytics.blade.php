@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard')

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/ui-popover.js') }}"></script>
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
    {{-- End Heading --}}

    {{-- Alert --}}
    @if (session('success'))
        <div class="alert alert-danger alert-dismissible" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
        </div>
    @endif
    {{-- End Alert --}}

    {{-- Content Scan --}}
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
    {{-- End Content Scan --}}

    <!-- Modal Detail -->
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

                    <div class="modal-body pt-0">
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
                                <div class="col mb-2">
                                    <label for="nameWithTitle" class="form-label">Code Barang</label>
                                    <input type="text" id="code" class="form-control" placeholder="Enter Name"
                                        name="code" readonly>
                                </div>
                                <div class="col mb-2">
                                    <label for="nameWithTitle" class="form-label">Nama Barang</label>
                                    <input type="text" id="name" class="form-control" placeholder="Enter Name"
                                        name="item" readonly>
                                </div>
                                <div class="col mb-2">
                                    <label for="nameWithTitle" class="form-label">Jumlah</label>
                                    <input type="number" value="1" id="amount" class="form-control" name="amount"
                                        placeholder="Jumlah barang">
                                </div>
                                <div class="col mb-2">
                                    <label for="nameWithTitle" class="form-label">Tanggal Peminjaman</label>
                                    <input required type="date" id="nameWithTitle" class="form-control"
                                        placeholder="Enter Name" name="date">
                                </div>
                                <div class="col mb-2">
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
    {{-- End Modal Detail --}}

    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#smallModal">
        Small
    </button>

    <!-- Small Modal -->
    <div class="modal fade" id="smallModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel2">Tambahkan Keterangan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-0">
                            <label for="exampleFormControlTextarea1" class="form-label">Masukan Keterangan</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Blade Template -->
    <script>
        var baseUrl = "{{ asset('') }}";
    </script>

@endsection
