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
                <div class="card">
                    <div class="card-header">
                    <h3 class="card-title">@lang('dashboard.admins') <small> "{{$users->total()}}"</small></h3>
                      <div class="card-tools">

                        <form method="get" action="{{route('dashboard.users.index')}}">
                        <div class="input-group input-group-sm" style="width: 250px;">
                        <input type="text" name="search" class="form-control float-right" value="{{request()->search}}" placeholder="Search">
                                <div class="input-group-append">
                                  <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                </div>
                        </div>
                        </form>
                      </div>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <a  href="{{route('dashboard.users.create')}}" class=" btn-lg btn-info "><i class="fas fa-user-plus"></i> @lang('dashboard.add')</a>
                      <table class="mt-3 table table-bordered">
                        <thead>
                          <tr>
                            <th style="width: 10px">#</th>
                            <th>@lang('dashboard.first_name')</th>
                            <th>@lang('dashboard.last_name')</th>
                            <th>@lang('dashboard.email')</th>
                            <th>@lang('dashboard.action')</th>

                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                            <td>{{$user->id}}</td>
                                <td>{{$user->first_name}}</td>
                                <td>{{$user->last_name}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    @if (auth()->user()->hasPermission('update-users'))

                                    <a class="btn btn-success" href="{{route('dashboard.users.edit',$user->id)}}">@lang('dashboard.edit')</a>
                                    @else
                                    <button class="btn btn-success disabled">@lang('dashboard.edit')</button>
                                    @endif
                                    @if (auth()->user()->hasPermission('delete-users'))
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
                                        @lang('dashboard.delete')
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">@lang('dashboard.confirm.title')</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                            @lang('dashboard.confirm.content')@lang('dashboard.admin')
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('dashboard.close')</button>
                                            <form style="display:inline-block" method="POST" action="{{route('dashboard.users.destroy',$user->id )}}">
                                                @csrf @method('delete')
                                                <input type="submit" class="btn btn-danger" value="@lang('dashboard.confirm.deletions')" >
                                            </form>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    @else
                                    <button class="btn btn-danger disabled">@lang('dashboard.delete')</button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                      </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        {{$users->appends(request()->query())->links()}}
                    </div>
                  </div>
                  <!-- /.card -->
            </section>
            <!-- /.content -->
        </div>
@endsection
