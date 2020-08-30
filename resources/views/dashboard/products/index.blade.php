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
                    <h3 class="card-title">@lang('dashboard.products') <small> "{{$products->total()}}"</small></h3>
                      <div class="card-tools ">

                        <form method="get" action="{{route('dashboard.products.index')}}">
                            <div class="row">
                                <div class="col-md-6 input-group" style="width: 250px;">
                                    <input type="text" name="search" class="form-control float-right" value="{{request()->search}}" placeholder="Search">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group input-group  ">
                                        <label class="mx-1">@lang('dashboard.category')</label>
                                        <select name="category_id" class="form-control select2" >
                                            <option value="" >@lang('dashboard.all_categories')</option>
                                            @foreach ($categories as $category)
                                            <option {{(request()->category_id)==$category->id?'selected':''}} value="{{$category->id}}">{{$category->translate(app()->getLocale())->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </form>
                      </div>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <a  href="{{route('dashboard.products.create')}}" style="font-size:" class="py-2 btn-lg btn-info ">
                            <span >
                                <i  class="fas fa-plus "></i>
                                <i class="fas fa-box-open " ></i>
                            </span>
                             <span class="ml-1"> @lang('dashboard.add')<span>
                        </a>
                      <table class="mt-3 table table-bordered">
                        <thead>
                          <tr>
                            <th style="width: 10px">#</th>
                            <th>@lang('dashboard.name')</th>
                            <th>@lang('dashboard.description')</th>
                            <th>@lang('dashboard.image')</th>
                            <th>@lang('dashboard.purchase_price')</th>
                            <th>@lang('dashboard.sale_price')</th>
                            <th>@lang('dashboard.profit_percent')</th>
                            <th>@lang('dashboard.stock')</th>
                            <th>@lang('dashboard.action')</th>

                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                            <tr>
                            <td>{{$product->id}}</td>
                                <td>{{$product->name}}</td>
                                <td>{{$product->description}}</td>
                                <td><img  class="img-thumbnail" style="width:100px" src="{{$product->image_path()}}" alt="" ></td>
                                <td>{{$product->purchase_price}}</td>
                                <td>{{$product->sale_price}}</td>
                                <td>{{$product->profit_percent}}%</td>
                                <td>{{$product->stock}}</td>
                                <td>
                                    @if (auth()->user()->hasPermission('update-products'))

                                    <a class="btn btn-success" href="{{route('dashboard.products.edit',$product->id)}}">@lang('dashboard.edit')</a>
                                    @else
                                    <button class="btn btn-success disabled">@lang('dashboard.edit')</button>
                                    @endif
                                    @if (auth()->user()->hasPermission('delete-products'))
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
                                            @lang('dashboard.confirm.content')@lang('dashboard.product')
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('dashboard.close')</button>
                                            <form style="display:inline-block" method="POST" action="{{route('dashboard.products.destroy',$product->id )}}">
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
                        {{$products->appends(request()->query())->links()}}
                    </div>
                  </div>
                  <!-- /.card -->
            </section>
            <!-- /.content -->
        </div>
        <script>$(document).ready(function() {
            $('.select2').select2();
        });</script>
@endsection
