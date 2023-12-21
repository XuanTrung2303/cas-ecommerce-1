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
                            <h1>Child Category</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="float-sm-right">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">
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
                                    <h1 class="card-title">All child-categories list</h1>
                                </div>
                                <!-- /.card-header -->
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="ytable" class="table table-bordered table-striped table-sm ytable">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>ChildCategory Name</th>
                                                <th>Category Slug</th>
                                                <th>SubCategory Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- @foreach ($data as $key => $row)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $row->subcategory_name }}</td>
                                                    <td>{{ $row->subcategory_slug }}</td>
                                                    <td>{{ $row->category->category_name }}</td>
                                                    <td>
                                                        <a href="#" class="btn btn-info btn-sm edit"
                                                            data-id="{{ $row->id }}" data-toggle="modal"
                                                            data-target="#editModal">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a href="{{ route('subcategory.delete', $row->id) }}"
                                                            class="btn btn-danger btn-sm" id="delete">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach --}}
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
        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Add New Child Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('childcategory.store') }}" method="post" id="add-form">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="category_name">Category/SubCategory Name</label>
                                <select class="form-control" name="subcategory_id" required>
                                    @foreach ($category as $row)
                                        @php
                                            $subcate = DB::table('subcategories')
                                                ->where('category_id', $row->id)
                                                ->get();
                                        @endphp
                                        <option disabled style="color:blue;">{{ $row->category_name }}</option>
                                        @foreach ($subcate as $row)
                                            <option value="{{ $row->id }}"> ---- {{ $row->subcategory_name }}</option>
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="subcategory_name">Child Category Name</label>
                                <input type="text" class="form-control" id="childcategory_name" name="childcategory_name"
                                    required>
                                <small id="subCategoryName" class="form-text text-muted">This is your
                                    child category.</small>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary"><span class="d-none"> loading... </span>
                                Submit</button>
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
                        <h5 class="modal-title" id="editModalLabel">Edit Child Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div id="modal_body">

                    </div>
                </div>
            </div>
        </div>

        <!-- footer -->
        @include('inc.admin.footer')
        <!-- footer end -->
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript">
        $(function childcategory() {
            var table = $('#ytable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('childcategory.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'childcategory_name',
                        name: 'childcategory_name'
                    },
                    {
                        data: 'category_name',
                        name: 'category_name'
                    },
                    {
                        data: 'subcategory_name',
                        name: 'subcategory_name'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ]
            })
        });
    </script>

    <script type="text/javascript">
        $('body').on('click', '.edit', function() {
            let id = $(this).data('id');
            $.get("childcategory/edit/" + id, function(data) {
                $("#modal_body").html(data);
            });
        });
    </script>

    <!-- end main-panel -->
@endsection
