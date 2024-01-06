<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Connect Plus</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('/backend/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/backend/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/backend/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('/backend/vendors/font-awesome/css/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('/backend/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->

    <!-- summernote -->
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/backend/vendors/summernote/summernote-bs4.css') }}">

    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('/backend/css/style.css') }}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('/backend/images/favicon.png') }}" />
    <!-- Sweetalert & toastr -->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/vendors/toastr/toastr.css') }}">
    <!-- End sweetalert & toastr -->
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('/backend/vendors/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('/backend/vendors/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/backend/vendors/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/backend/vendors/fontawesome-free/css/all.min.css') }}">
</head>

<body>
    <div class="container-scroller">
        <div class="row p-0 m-0 proBanner" id="proBanner">
            <div class="col-md-12 p-0 m-0">
                <div class="card-body card-body-padding d-flex align-items-center justify-content-between">
                    <div class="ps-lg-1">
                        <div class="d-flex align-items-center justify-content-between">
                            <p class="mb-0 font-weight-medium me-3 buy-now-text">Free 24/7 customer support, updates,
                                and more with this template!</p>
                            <a href="https://www.bootstrapdash.com/product/connect-plus-bootstrap-admin-template/?utm_source=organic&utm_medium=banner&utm_campaign=buynow_demo"
                                target="_blank" class="btn me-2 buy-now-btn border-0">Get Pro</a>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <a href="https://www.bootstrapdash.com/product/connect-plus-bootstrap-admin-template/"><i
                                class="mdi mdi-home me-3 text-white"></i></a>
                        <button id="bannerClose" class="btn border-0 p-0">
                            <i class="mdi mdi-close text-white me-0"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @guest
        @else
            <!-- navigation -->
            @include('inc.admin.nav')
            <!-- navigation end -->

            <!-- aside -->
            @include('inc.admin.aside')
            <!-- aside end -->
        @endguest

        @yield('login_admin')

    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('/backend/vendors/js/vendor.bundle.base.js') }}" type="text/javascript"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('/backend/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('/backend/vendors/jquery-circle-progress/js/circle-progress.min.js') }}"></script>
    <script src="{{ asset('/backend/js/jquery.cookie.js') }}" type="text/javascript"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('/backend/js/off-canvas.js') }}"></script>
    <script src="{{ asset('/backend/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('/backend/js/misc.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="{{ asset('/backend/js/dashboard.js') }}"></script>
    <!-- End custom js for this page -->
    <!-- Sweetalert & toastr -->
    <script src="{{ asset('/backend/vendors/sweetalert/sweetalert.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/backend/vendors/toastr/toastr.min.js') }}"></script>
    <script>
        $(document).on("click", "#delete", function(e) {
            e.preventDefault();
            var link = $(this).attr("href");
            swal({
                title: "Are you Want to delete?",
                text: "Once Delete, this will be Permanently Delete!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    window.location.href = link;
                } else {
                    swal("Safe Data!");
                }
            });
        });
    </script>
    {{-- before logout showing alert message --}}
    <script>
        $(document).on("click", "#logout", function(e) {
            e.preventDefault();
            var link = $(this).attr("href");
            swal({
                title: "Are you Want to logout?",
                text: "",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    window.location.href = link;
                } else {
                    swal("Not Logout!");
                }
            });
        });
    </script>
    <script>
        @if (Session::has('messege'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
                case 'info':
                    toastr.info("{{ Session::get('messege') }}");
                    break;
                case 'success':
                    toastr.success("{{ Session::get('messege') }}");
                    break;
                case 'warning':
                    toastr.warning("{{ Session::get('messege') }}");
                    break;
                case 'error':
                    toastr.error("{{ Session::get('messege') }}");
                    break;
            }
        @endif
    </script>
    <!-- End sweetalert & toastr -->
    <!-- DataTables  & Plugins -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" />
    <script src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="{{ asset('/backend/vendors/datatables/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/backend/vendors/datatables-bs4/js/dataTables.bootstrap4.min.js') }}">
    </script>
    <script type="text/javascript"
        src="{{ asset('/backend/vendors/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('/backend/vendors/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/backend/vendors/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('/backend/vendors/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/backend/vendors/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('/backend/vendors/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('/backend/vendors/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('/backend/vendors/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('/backend/vendors/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('/backend/vendors/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    {{-- Summernote --}}
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js"></script>
    <script src="{{ asset('/backend/vendors/summernote/summernote-bs4.min.js') }}"></script>
    <script type="text/javascript">
        $.getScript('https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js', function() {
            $('#textarea').summernote()
        })
    </script>
    <script>
        $(function() {
            $.noConflict();
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
    <!-- jQuery -->
    <script src="{{ asset('/backend/vendors/jquery/jquery.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>

</body>

</html>
