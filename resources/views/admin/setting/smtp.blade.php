@extends('layouts.admin')

@section('content_admin')
    <div class="main-panel">
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Admin Dashboard</h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Info boxes -->
                    <div class="row">
                        <div class="col-6">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">SMTP Mail Settings</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form role="form" action="{{ route('smtp.setting.update', $smtp->id) }}" method="Post">
                                    @csrf
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Mail Mailer</label>
                                            <input type="hidden" name="types[]" value="MAIL_MAILER">
                                            <input type="text" class="form-control" name="MAIL_MAILER"
                                                value="{{ $smtp->mailer }}" placeholder="Mail Lailer Example: smtp">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Mail Host</label>
                                            <input type="hidden" name="types[]" value="MAIL_HOST">
                                            <input type="text" class="form-control" name="MAIL_HOST"
                                                value="{{ $smtp->host }}" placeholder="Mail Host">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Mail Port</label>
                                            <input type="hidden" name="types[]" value="MAIL_PORT">
                                            <input type="text" class="form-control" name="MAIL_PORT"
                                                value="{{ $smtp->port }}" placeholder="Mail Port Example: 2525">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Mail Username</label>
                                            <input type="hidden" name="types[]" value="MAIL_USERNAME">
                                            <input type="text" class="form-control" name="MAIL_USERNAME"
                                                value="{{ $smtp->user_name }}" placeholder="Mail Username">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Mail Password</label>
                                            <input type="hidden" name="types[]" value="MAIL_PASSWORD">
                                            <input type="text" class="form-control" name="MAIL_PASSWORD"
                                                value="{{ $smtp->password }}" placeholder="Mail Password">
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div><!--/. container-fluid -->
            </section>
            <!-- /.content -->
        </div>
    </div>
    <!-- /.content-wrapper -->
@endsection
