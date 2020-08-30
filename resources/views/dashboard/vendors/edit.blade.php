@extends('layouts.dashboard.app')

@section('content')
        <!-- Content Wrapper. Contains page content -->
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

            <!-- Main content -->
            <section class="content">
                @include('partials._error')
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Edit</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="POST" action="{{route('dashboard.categories.update',$vendor->id)}}" enctype="multipart/form-data" >
                    @csrf
                    @method('put')
                  <div class="card-body">
                    <div class="form-group">
                        <label>@lang('dashboard.name')</label>
                        <input type="text" name="name" class="form-control" value="{{ $vendor->name }}">
                    </div>

                    @for ($i = 0; $i < 2; $i++)
                        <div class="form-group">
                            <label>@lang('dashboard.phone')</label>
                            <input type="text" name="phone[]" class="form-control" value="{{ $vendor->phone[$i] ?? '' }}">
                        </div>
                    @endfor

                    <div class="form-group">
                        <label>@lang('dashboard.address')</label>
                        <textarea name="address" class="form-control">{{ $vendor->address }}</textarea>
                    </div>



                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div>
            </section>
            <!-- /.content -->

        </div>
@endsection
