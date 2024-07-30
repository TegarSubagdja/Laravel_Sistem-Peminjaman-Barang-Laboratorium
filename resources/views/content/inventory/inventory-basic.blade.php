@extends('layouts/contentNavbarLayout')

@section('title', 'Inventory - Basic Tables')

@section('content')
    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h4 class="py-3 mb-4">
                <span class="text-muted fw-light">Dashboard / </span>
                <span class="text-danger">Daftar Barang</span>
            </h4>
        </div>
        <button class="dt-button create-new btn btn-danger" tabindex="0" aria-controls="DataTables_Table_0" type="button"
            data-bs-toggle="offcanvas" data-bs-target="#add-new-record">
            <span><i class="bx bx-plus me-sm-1"></i>
                <span class="d-none d-sm-inline-block">Tambah Barang</span>
            </span>
        </button>
    </div>

    {{-- Content --}}
    <div class="row mb-5">
        @for ($i = 1; $i <= 10; $i++)
            <div class="col-md-6 col-lg-4 mb-3">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">Gerinda Tangan</h5>
                        <h6 class="card-subtitle text-muted">Orion w500</h6>
                        <img class="img-fluid d-flex mx-auto my-4 rounded"
                            src="https://down-id.img.susercontent.com/file/88afadb4117b4049ece5c8d3d4f04ce8"
                            alt="Card image cap">
                        @if ($i % 2 == 0)
                            <h6 class="badge bg-label-warning">Multimedia</h6>
                        @elseif ($i % 3 == 0)
                            <h6 class="badge bg-label-danger">Jaringan</h6>
                        @elseif ($i % 5 == 0)
                            <h6 class="badge bg-label-info">ICT</h6>
                        @else
                            <h6 class="badge bg-label-success">Basis Data</h6>
                        @endif
                        <p class="card-text">Bear claw sesame snaps gummies chocolate.</p>
                        <button type="button" class="btn btn-outline-danger">
                            <span class="tf-icons bx bx-pie-chart-alt me-1"></span>Pinjam
                        </button>
                    </div>
                </div>
            </div>
        @endfor
    </div>

    {{-- Modal --}}
    <div class="offcanvas offcanvas-end" id="add-new-record">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="exampleModalLabel">Tambah Barang</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body flex-grow-1">
            <form action="/datas" method="POST"
                class="add-new-record pt-0 row g-2 fv-plugins-bootstrap5 fv-plugins-framework" id="form-add-new-record"
                action="/send-message" method="POST">
                @csrf
                <div class="col-sm-12 fv-plugins-icon-container">
                    <label class="form-label" for="basicFullname">Nama</label>
                    <div class="input-group input-group-merge has-validation">
                        <span id="basicFullname2" class="input-group-text"><i class="bx bx-paperclip"></i></span>
                        <input type="text" id="basicFullname" class="form-control dt-full-name" name="basicFullname"
                            placeholder="Masukan nama barang" required>
                    </div>
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    </div>
                </div>
                <div class="col-sm-12 fv-plugins-icon-container">
                    <label class="form-label" for="basicPost">Jumlah Barang</label>
                    <div class="input-group input-group-merge has-validation">
                        <span id="basicPost2" class="input-group-text"><i class="bx bxs-component"></i></span>
                        <input type="number" id="basicPost" name="basicPost" class="form-control dt-post"
                            placeholder="Masukan jumlah barang" aria-label="Web Developer" aria-describedby="basicPost2"
                            required>
                    </div>
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    </div>
                </div>
                <div class="col-sm-12 fv-plugins-icon-container">
                    <label class="form-label" for="basicEmail">Deskripsi</label>
                    <div class="input-group input-group-merge has-validation">
                        <span class="input-group-text"><i class="bx bx-detail"></i></span>
                        <input type="text" id="basicEmail" name="basicEmail" class="form-control dt-email"
                            placeholder="Masukan deskripsi barang">
                    </div>
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    </div>
                    <div class="form-text">
                        You can use letters, numbers &amp; periods
                    </div>
                </div>
                <div class="col-sm-12 fv-plugins-icon-container">
                    <label class="form-label" for="basicDate">Code Barang</label>
                    <div class="input-group input-group-merge has-validation">
                        <span id="basicDate2" class="input-group-text"><i class="bx bx-barcode"></i></span>
                        <input type="text" class="form-control dt-date flatpickr-input" id="basicDate" name="basicDate"
                            placeholder="Masukan code barang">
                    </div>
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    </div>
                </div>
                <div class="col-sm-12 fv-plugins-icon-container">
                    <label class="form-label" for="basicSalary">Picture</label>
                    <div class="input-group input-group-merge has-validation">
                        {{-- <span id="basicSalary2" class="input-group-text"><i class="bx bx-dollar"></i></span> --}}
                        <input class="form-control" type="file" id="formFileMultiple" multiple="">
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

@endsection
