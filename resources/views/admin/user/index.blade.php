@extends('admin.layouts.app')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ $menu }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">{{ $menu }}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>


     <!-- Main content -->
     <section class="content">
        @include ('admin.common.error')
        <div class="row">
            <div class="col-12">
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Manage {{$menu}}</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{ route('agents.create') }}" class="btn btn-sm btn-info float-right"><i class="fa fa-plus pr-1"></i> Add New</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <input type="hidden" id="route_name" value="{{ route('agents.index')}}">
                        <table id="userTable" class="table table-bordered table-striped datatable-dynamic">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Full Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Date Created</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('jquery')
<script>
    $(document).ready(function() {
        $('#userTable').DataTable({
        processing: true,
        serverSide: true,
        pageLength: 100,
        lengthMenu: [ 100, 200, 300, 400, 500 ],
        ajax: $("#route_name").val(),
        columns: [
            {
                data: 'id', width: '10%', name: 'id',
                render: function(data, type, row) {
                    return '#' + data; // Prepend '#' to the 'id' data
                }
            },
            {data: 'full_name', name: 'full_name'},
            {data: 'phone',  name: 'phone'},
            {data: 'email',  name: 'email'},
            {data: 'status', "width": "12%",  name: 'status', orderable: true},
            {data: 'created_at', "width": "20%", name: 'created_at'},
            {data: 'action', "width": "12%",  name: 'action', orderable: false},
        ],
        "order": [[0, "DESC"]]
    });
    });
</script>
@endsection
