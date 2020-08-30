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
                <form role="form" method="POST" action="{{route('dashboard.products.update',$product->id)}}" enctype="multipart/form-data" >
                    @csrf
                    @method('put')
                    @csrf
                    <div class="card-body">
                    <div class="form-group">
                        <label>@lang('dashboard.category')</label>
                        <select name="category_id" class="form-control select2" >
                            <option ></option>
                            @foreach ($categories as $category)
                            <option {{$product->category_id==$category->id?'selected':''}} value="{{$category->id}}">{{$category->translate(app()->getLocale())->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    @foreach (config('translatable.locales') as $locale)
                        <div class="form-group">
                            <label for="name">@lang("dashboard.$locale.name")</label>
                        <input type="text" class="form-control" name="{{ $locale }}[name]" placeholder="Enter name" value="{{$product->translate($locale)->name}}" >
                        </div>
                        <div class="form-group">
                            <label for="description">@lang("dashboard.$locale.description")</label>
                        <textarea  class="form-control" name="{{ $locale }}[description]" placeholder="Enter description" >{{$product->translate($locale)->description}}</textarea>
                        </div>
                    @endforeach

                    <div class="form-group">
                        <label for="purchase_price">@lang("dashboard.purchase_price")</label>
                        <input type="number" class="form-control" name="purchase_price" placeholder="Enter purchase price" value="{{$product->purchase_price}}" >
                    </div>
                    <div class="form-group">
                        <label for="sale_price">@lang("dashboard.sale_price")</label>
                        <input type="number" class="form-control" name="sale_price" placeholder="Enter sale price" value="{{$product->sale_price}}" >
                    </div>
                    <div class="form-group">
                        <label for="stock">@lang("dashboard.stock")</label>
                        <input type="number" class="form-control" name="stock" placeholder="Enter stock" value="{{$product->stock}}" >
                    </div>

                  </div>

                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div>
            </section>
            <!-- /.content -->

        </div>
@endsection
