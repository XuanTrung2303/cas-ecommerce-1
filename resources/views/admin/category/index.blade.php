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
                            <h1>Category</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="float-sm-right">
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#categoryModal">
                                    + Add New
                                </button>
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
                                    <h1 class="card-title">All categories list</h1>
                                </div>
                                <!-- /.card-header -->
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Category Name</th>
                                                <th>Category Slug</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $key => $row)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $row->category_name }}</td>
                                                    <td>{{ $row->category_slug }}</td>
                                                    <td>
                                                        <a href="#" class="btn btn-info btn-sm edit"
                                                            data-id="{{ $row->id }}" data-toggle="modal"
                                                            data-target="#editModal">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a href="{{ route('category.delete', $row->id) }}"
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

        {{-- category isert modal --}}
        <div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="categoryModalLabel">Add New Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('category.store') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="category_name">Category Name</label>
                                <input type="text" class="form-control" id="category_name" name="category_name" required>
                                <small id="categoryName" class="form-text text-muted">This is your main category.</small>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- category edit modal --}}
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('category.update') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="category_name">Category Name</label>
                                <input type="text" class="form-control" id="edit_category_name" name="category_name"
                                    required>
                                <input type="hidden" class="form-control" id="edit_category_id" name="id">
                                <small id="categoryName" class="form-text text-muted">This is your main category.</small>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- footer -->
        @include('inc.admin.footer')
        <!-- footer end -->
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript">
        $('body').on('click', '.edit', function() {
            let cate_id = $(this).data('id');
            $.get("category/edit/" + cate_id, function(data) {
                $('#edit_category_name').val(data.category_name);
                $('#edit_category_id').val(data.id)
            });
        });
    </script>

    <!-- end main-panel -->
@endsection
