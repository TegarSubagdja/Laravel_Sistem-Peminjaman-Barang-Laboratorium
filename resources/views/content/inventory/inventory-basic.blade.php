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
        @foreach ($items as $item)
            <div class="col-md-6 col-lg-4 mb-3">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->name }}</h5>
                        @if ($item->lab->name == 'Lab ICT')
                            <h6 class="badge bg-label-warning">{{ $item->lab->name }}</h6>
                        @elseif ($item->lab->name == 'Jaringan Komputer')
                            <h6 class="badge bg-label-danger">{{ $item->lab->name }}</h6>
                        @elseif ($item->lab->name == 'Basis Data')
                            <h6 class="badge bg-label-info">{{ $item->lab->name }}</h6>
                        @else
                            <h6 class="badge bg-label-success">{{ $item->lab->name }}</h6>
                        @endif
                        <img class="img-fluid d-flex mx-auto mb-4 rounded"
                            src="{{ Storage::url('assets/img/items/' . $item->picture) }}" alt="Card image cap">
                        <h6>Deskripsi</h6>
                        <p class="card-text">{{ $item->description }}</p>
                        <button type="button" class="btn btn-outline-danger">
                            <span class="tf-icons bx bx-pie-chart-alt me-1"></span>Pinjam
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{ $items->links() }}

    {{-- Modal --}}
    <div class="offcanvas offcanvas-end" id="add-new-record">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="exampleModalLabel">Tambah Barang</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body flex-grow-1">
            <form action="/add-item" method="POST"
                class="add-new-record pt-0 row g-2 fv-plugins-bootstrap5 fv-plugins-framework" id="form-add-new-record"
                action="/send-message" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="col-sm-12 fv-plugins-icon-container">
                    <label class="form-label" for="basicFullname">Nama</label>
                    <div class="input-group input-group-merge has-validation">
                        <span id="basicFullname2" class="input-group-text"><i class="bx bx-paperclip"></i></span>
                        <input type="text" class="form-control dt-full-name" name="name"
                            placeholder="Masukan nama barang" required>
                    </div>
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    </div>
                </div>
                <div class="col-sm-12 fv-plugins-icon-container">
                    <label for="defaultSelect" class="form-label">Lab</label>
                    <select id="defaultSelect" class="form-select" name="lab">
                        @foreach ($labs as $lab)
                            <option value="{{ $lab->id }}">{{ $lab->name }}</option>
                        @endforeach
                        {{-- <option value="2">Jaringan Komputer</option>
                        <option value="3">Basis Data</option>
                        <option value="4">Multimedia</option> --}}
                    </select>
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    </div>
                </div>
                <div class="col-sm-12 fv-plugins-icon-container">
                    <label class="form-label" for="basicEmail">Deskripsi</label>
                    <div class="input-group input-group-merge has-validation">
                        <span class="input-group-text"><i class="bx bx-detail"></i></span>
                        <input type="text" name="description" class="form-control dt-email"
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
                        <input type="text" class="form-control dt-date flatpickr-input" id="basicDate" name="code"
                            placeholder="Masukan code barang">
                    </div>
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    </div>
                </div>
                <div class="col-sm-12 fv-plugins-icon-container">
                    <label class="form-label" for="basicSalary">Picture</label>
                    <div class="input-group input-group-merge has-validation">
                        {{-- <span id="basicSalary2" class="input-group-text"><i class="bx bx-dollar"></i></span> --}}
                        <input class="form-control" type="file" id="formFileMultiple" name="picture">
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
