@extends('layouts.admin')

@section('content_admin')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" />
    <!-- main-panel -->
    <div class="main-panel">
        <div class="content-wrapper">
            <!-- /.content -->
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Brands</h1>
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
                                    <h1 class="card-title">All brands list</h1>
                                </div>
                                <!-- /.card-header -->
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="ytable" class="table table-bordered table-striped table-sm ytable">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Brand Name</th>
                                                <th>Brand Slug</th>
                                                <th>Brand Logo</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
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
                        <h5 class="modal-title" id="addModalLabel">Add New Brand</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('brand.store') }}" method="post" enctype="multipart/form-data" id="add-form">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="brand_name">Brand Name</label>
                                <input type="text" class="form-control" name="brand_name" required>
                                <small id="brandName" class="form-text text-muted">
                                    This is your brand.
                                </small>
                            </div>
                            <div class="form-group">
                                <label for="brand_name">Brand Logo</label>
                                <input type="file" class="dropify" data-height="140" id="input-file-now"
                                    name="brand_logo" required>
                                <small id="brandLogo" class="form-text text-muted">
                                    This is your brand logo.
                                </small>
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
                        <h5 class="modal-title" id="editModalLabel">Edit Brand</h5>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>

    <script type="text/javascript">
        $('.dropify').dropify();
    </script>
    <script type="text/javascript">
        $(function brand() {
            var table = $('#ytable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('brand.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'brand_name',
                        name: 'brand_name'
                    },
                    {
                        data: 'brand_slug',
                        name: 'brand_slug'
                    },
                    {
                        //
                        data: 'brand_logo',
                        name: 'brand_logo',
                        render: function(data, type, full, meta) {
                            return "<img src=\"" + data + "\" height=\"30\" />";
                        }
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
            $.get("brand/edit/" + id, function(data) {
                $("#modal_body").html(data);
            });
        });
    </script>

    <!-- end main-panel -->
@endsection
