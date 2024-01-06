@extends('layouts.admin')

@section('content_admin')
    <!-- main-panel -->
    <div class="main-panel">
        <div class="content-wrapper">
            <!-- /.content -->
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>All Pages</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="float-sm-right">
                                <a href="{{ route('page.create') }}" class="btn btn-primary">
                                    + Add New
                                </a>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">

                            <div class="card">
                                <div class="card-header">
                                    <h1 class="card-title">All pages list</h1>
                                </div>
                                <!-- /.card-header -->
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Page Name</th>
                                                <th>Page Title</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($page as $key => $row)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $row->page_name }}</td>
                                                    <td>{{ $row->page_title }}</td>
                                                    <td>
                                                        <a href="{{ route('page.edit', $row->id) }}"
                                                            class="btn btn-info btn-sm edit">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a href="{{ route('page.delete', $row->id) }}"
                                                            class="btn btn-danger btn-sm" id="delete">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>

        <!-- footer -->
        @include('inc.admin.footer')
        <!-- footer end -->
    </div>

    <!-- end main-panel -->
@endsection
