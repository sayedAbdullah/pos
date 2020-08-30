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
                <form role="form" method="POST" action="{{route('dashboard.users.update',$user->id)}}" enctype="multipart/form-data" >
                    @csrf
                    @method('put')
                  <div class="card-body">
                    <div class="form-group">
                      <label for="first_name">first name</label>
                    <input type="text" class="form-control" name="first_name" placeholder="Enter first name" value="{{$user->first_name}}" >
                    </div>
                    <div class="form-group">
                      <label for="last_name">last name</label>
                    <input type="text" class="form-control" name="last_name" placeholder="Enter last name" value="{{$user->last_name}}" >
                    </div>
                    <div class="form-group">
                      <label for="email">email</label>
                    <input type="email" class="form-control" name="email" placeholder="Enter email" value="{{$user->email}}" >
                    </div>

                    <div class="form-group">
                      <label for="exampleInputFile">File input</label>
                      <div class="input-group">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="exampleInputFile">
                          <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        </div>
                        <div class="input-group-append">
                          <span class="input-group-text" id="">Upload</span>
                        </div>
                      </div>
                    </div>
                    <label class=" mb-2">Permission</label>

                    <div class="row">
                      <div class="col-12">
                        <!-- Custom Tabs -->
                        <div class="card">
                          <div class="card-header d-flex p-0">
                            @php
                            $models =['users','products','categories','clients','orders'];
                            $maps   =['create','read','update','delete'];
                            @endphp
                            {{-- <label class="card-title p-3">Permission</label> --}}
                            <ul class="nav nav-tabs mr-auto ">
                                @foreach ($models as $index=>$model)
                                <li class=""><a class="nav-link {{$index==0? 'active' :'' }}" href="#{{$model}}" data-toggle="tab">@lang("dashboard.$model")</a></li>
                                @endforeach
                            </ul>
                          </div><!-- /.card-header -->
                          <div class="card-body">
                            <div class="tab-content" >
                                @foreach ($models as $index=>$model)
                                <div class="tab-pane {{$index==0? 'active':''}}" id="{{$model}}">

                                    @foreach ($maps as $map)
                                        <label class="mr-3"  for="{{$map.'-'.$model}}"><input type="checkbox" id="{{$map.'-'.$model}}" name="permissions[]" value="{{$map.'-'.$model}}"{{$user->hasPermission($map.'-'.$model)?'checked':''}}>
                                        @lang("dashboard.$map")</label>
                                    @endforeach

                                </div>
                                @endforeach
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                          </div><!-- /.card-body -->
                        </div>
                        <!-- ./card -->
                      </div>
                      <!-- /.col -->
                    </div>
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="exampleCheck1">
                      <label class="form-check-label" for="exampleCheck1">Check me out</label>
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
