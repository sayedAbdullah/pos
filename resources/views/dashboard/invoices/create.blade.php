@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">@lang('dashboard.dashboard')</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v1</li>
                        </ol>
                    </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->


        <section class="content">

            <div class="row">

                <div class="col-md-11 m-auto">

                    <div class="box box-primary">

                        <div class="box-header">

                            <h3 class="box-title" style="margin-bottom: 10px">@lang('dashboard.invoices')</h3>
                            @include('partials._error')

                            <form method='post' action='{{route("dashboard.invoices.store")}}'  enctype="multipart/form-data" >

                                @csrf
                                @include("dashboard.invoices.form", ['invoice' => new App\invoice])

                                <input type='submit' class='btn btn-primary' value='Add new invoice' >

                            </form>

                        </div><!-- end of box header -->


                    </div><!-- end of box -->

                </div><!-- end of col -->

            </div><!-- end of row -->

        </section><!-- end of content section -->

    </div><!-- end of content wrapper -->

@endsection


