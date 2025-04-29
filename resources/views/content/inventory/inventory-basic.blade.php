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
        @if (Auth::user()->isAdmin())
            <button class="dt-button create-new btn btn-danger" tabindex="0" aria-controls="DataTables_Table_0" type="button"
                data-bs-toggle="offcanvas" data-bs-target="#add-new-record">
                <span><i class="bx bx-plus me-sm-1"></i>
                    <span class="d-none d-sm-inline-block">Tambah Barang</span>
                </span>
            </button>
        @endif
    </div>
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
    {{-- Content --}}
    <div class="row mb-5">
        @foreach ($items as $item)
            <div class="col-md-6 col-lg-4 mb-3">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex flex-row align-items-start justify-content-between">
                            <h5 class="card-title">{{ $item->name }}</h5>
                            @if (Auth::user()->isAdmin())
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                    data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                <div class="dropdown-menu">
                                    <button data-bs-toggle="offcanvas" data-bs-target="#add-new-record"
                                        class="dropdown-item edit-item" data-name="{{ $item->name }}"
                                        data-lab="{{ $item->lab_id }}" data-desc="{{ $item->description }}"
                                        data-code="{{ $item->code }}"><i class="bx bx-revision me-1"></i>
                                        Edit</button>
                                    <form action="/delete-item/{{ $item->code }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item"><i class="bx bx-trash me-1"></i>
                                            Delete</button>
                                    </form>
                                </div>
                            @endif
                        </div>
                        @if ($item->lab->name == 'Lab ICT')
                            <h6 class="badge bg-label-warning">{{ $item->lab->name }}</h6>
                        @elseif ($item->lab->name == 'Jaringan Komputer')
                            <h6 class="badge bg-label-danger">{{ $item->lab->name }}</h6>
                        @elseif ($item->lab->name == 'Basis Data')
                            <h6 class="badge bg-label-info">{{ $item->lab->name }}</h6>
                        @else
                            <h6 class="badge bg-label-success">{{ $item->lab->name }}</h6>
                        @endif
                        {{-- <img class="img-fluid d-flex mx-auto mb-4 rounded" src="{{ Storage::url('assets/img/items/' . $item->picture) }}" alt="Card image cap"> --}}
                        <img class="img-fluid d-flex mx-auto mb-4 rounded" src="{{ Storage::url('assets/img/items/' . $item->picture) }}" alt="Card image cap">
                        <h6>Deskripsi</h6>
                        <p class="card-text">{{ $item->description }}</p>
                        <div class="">
                            <ul class="list-group gap-2">
                                <li class=" d-flex justify-content-between align-items-center">
                                    Jumlah :
                                    <span class="badge badge-center bg-danger">{{ $item->quantity }}</span>
                                </li>
                                <li class=" d-flex justify-content-between align-items-center">
                                    Tersedia :
                                    <span
                                        class="badge badge-center bg-danger">{{ $item->quantity - $item->reserved }}</span>
                                </li>
                            </ul>
                        </div>
                        <div class="grid">
                            <button type="button" class="btn w-100 btn-outline-danger rent mt-4" data-toggle="modal"
                                data-target="#myModal" data-code="{{ $item->code }}">
                                <span class="tf-icons bx bx-pie-chart-alt me-1"></span>Pinjam
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{ $items->links() }}

    {{-- Modal --}}
    @if (Auth::user()->isAdmin())
        <div class="offcanvas offcanvas-end" id="add-new-record">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="exampleModalLabel">Tambah Barang</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body flex-grow-1">
                <form action="/add-item" method="POST"
                    class="add-new-record pt-0 row g-2 fv-plugins-bootstrap5 fv-plugins-framework" id="form-add-new-record"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="col-sm-12 fv-plugins-icon-container">
                        <label class="form-label">Nama</label>
                        <div class="input-group input-group-merge has-validation">
                            <span class="input-group-text"><i class="bx bx-paperclip"></i></span>
                            <input type="text" class="form-control dt-full-name" name="name"
                                placeholder="Masukan nama barang" id="name" required>
                        </div>
                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                        </div>
                    </div>
                    <div class="col-sm-12 fv-plugins-icon-container">
                        <label for="lab" class="form-label">Lab</label>
                        <select class="form-select" id="lab" name="lab">
                            @foreach ($labs as $lab)
                                <option value="{{ $lab->id }}">{{ $lab->name }}</option>
                            @endforeach
                        </select>
                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                        </div>
                    </div>
                    <div class="col-sm-12 fv-plugins-icon-container">
                        <label class="form-label">Deskripsi</label>
                        <div class="input-group input-group-merge has-validation">
                            <span class="input-group-text"><i class="bx bx-detail"></i></span>
                            <input type="text" id="desc" name="description" class="form-control dt-email"
                                placeholder="Masukan deskripsi barang">
                        </div>
                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                        </div>
                        <div class="form-text">
                            Silahkan masukan deskripsi tentang item
                        </div>
                    </div>
                    <div class="col-sm-12 fv-plugins-icon-container">
                      <label class="form-label">Jumlah</label>
                      <div class="input-group input-group-merge has-validation">
                          <span class="input-group-text"><i class="bx bx-add-to-queue"></i></span>
                          <input type="text" id="quantity" class="form-control dt-date flatpickr-input"
                              id="basicDate" name="quantity" placeholder="Masukan code barang">
                      </div>
                      <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                      </div>
                  </div>
                    <div class="col-sm-12 fv-plugins-icon-container">
                        <label class="form-label">Code Barang</label>
                        <div class="input-group input-group-merge has-validation">
                            <span class="input-group-text"><i class="bx bx-barcode"></i></span>
                            <input type="text" id="code" class="form-control dt-date flatpickr-input"
                                id="basicDate" name="code" placeholder="Masukan code barang">
                        </div>
                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                        </div>
                    </div>
                    <div class="col-sm-12 fv-plugins-icon-container">
                        <label class="form-label">Picture</label>
                        <div class="input-group input-group-merge has-validation">
                            {{-- <span id="basicSalary2" class="input-group-text"><i class="bx bx-dollar"></i></span> --}}
                            <input class="form-control" type="file" id="formFileMultiple" name="picture">
                        </div>
                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
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
        </div>
    @endif

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
                                    <p id="input-desk" class="card-text">
                                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Adipisci, accusantium!
                                    </p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="col mb-2">
                                    <label for="nameWithTitle" class="form-label">Code Barang</label>
                                    <input type="text" id="input-code" class="form-control" placeholder="Enter Name"
                                        name="code" readonly>
                                </div>
                                <div class="col mb-2">
                                    <label for="nameWithTitle" class="form-label">Nama Barang</label>
                                    <input type="text" id="input-name" class="form-control" placeholder="Enter Name"
                                        name="item" readonly>
                                </div>
                                <div class="col mb-2">
                                    <label for="nameWithTitle" class="form-label">Jumlah</label>
                                    <input type="number" value="0" id="quantity" class="form-control"
                                        name="quantity" placeholder="Jumlah barang" min="1">
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

    <script>
        var baseUrl = "{{ asset('storage/assets/img/items') }}";
    </script>

@endsection
