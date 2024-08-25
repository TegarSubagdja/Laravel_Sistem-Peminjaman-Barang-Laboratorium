@extends('layouts/contentNavbarLayout')

@section('title', 'Account settings - Account')

@section('page-script')
    <script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>
@endsection

@section('content')
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Account Detail /</span>
        <span class="text-danger">Account</span>
    </h4>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Profile Details</h5>
                <!-- Account -->
                {{-- <div class="card-body">
                    <div class="d-flex align-items-start align-items-sm-center gap-4">
                        <img src="{{ asset('assets/img/avatars/1.png') }}" alt="user-avatar" class="d-block rounded"
                            height="100" width="100" id="uploadedAvatar" />
                    </div>
                </div> --}}
                <hr class="my-0">
                <div class="card-body">
                    <form id="formAccountSettings" method="POST" onsubmit="return false">
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="firstName" class="form-label">NRP</label>
                                <input readonly class="form-control" type="text" id="firstName" name="firstName"
                                    value="{{ Auth::user()->nrp }}" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="lastName" class="form-label">Nama</label>
                                <input readonly class="form-control" type="text" name="lastName" id="lastName"
                                    value="{{ Auth::user()->name }}" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">E-mail</label>
                                <input readonly class="form-control" type="text" id="email" name="email"
                                    value="{{ Auth::user()->email }}" placeholder="john.doe@example.com" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="organization" class="form-label">Nomer Telepon</label>
                                <input readonly type="text" class="form-control" id="organization" name="organization"
                                    value="-" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="organization" class="form-label">IPK</label>
                                <input readonly type="text" class="form-control" id="organization" name="organization"
                                    value="-" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="address" class="form-label">Alamat</label>
                                <input readonly type="text" class="form-control" id="address" name="address"
                                    placeholder="-" value="-" />
                            </div>
                        </div>
                        {{-- <div class="mt-2">
                            <button type="submit" class="btn btn-danger me-2">Save changes</button>
                            <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                        </div> --}}
                    </form>
                </div>
                <!-- /Account -->
            </div>
        </div>
    </div>
@endsection
