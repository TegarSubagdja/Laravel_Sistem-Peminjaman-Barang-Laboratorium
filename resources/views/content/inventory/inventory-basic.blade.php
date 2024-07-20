@extends('layouts/contentNavbarLayout')

@section('title', 'Inventory - Basic Tables')

@section('content')
    <div class="card">
        <div class="card-datatable table-responsive">
            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                <div class="card-header flex-column flex-md-row pb-4">
                    <div class="head-label text-center">
                        <h5 class="card-title mb-0">DataTable with Buttons</h5>
                    </div>
                    <div class="dt-action-buttons text-end pt-6 pt-md-0">
                        <div class="dt-buttons flex-wrap">
                            <div class="btn-group" id="">
                                
                        </div>
                    </div>
                </div>
                <table class="datatables-basic table border-top dataTable no-footer dtr-column collapsed"
                    id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" style="width: 1390px;">
                    <thead>
                        <tr>
                            <th>Project</th>
                            <th>Client</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @for ($i = 0; $i < 100; $i++)
                            <tr>
                                <td>
                                    <i class="bx bxl-angular bx-sm text-danger me-3"></i>
                                    <span class="fw-medium">Angular Project</span>
                                </td>
                                <td>Albert Cook as {{ $i }}</td>

                                <td><span class="badge bg-label-danger me-1">Active</span></td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                    class="bx bx-edit-alt me-1"></i>
                                                Edit</a>
                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                    class="bx bx-trash me-1"></i>
                                                Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
                <div style="width: 1%;"></div>
            </div>
        </div>
    </div>

@endsection
