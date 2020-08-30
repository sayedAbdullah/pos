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
                  <h3 class="card-title">Create New</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="POST" action="{{route('dashboard.invoices.transactions.store',$invoice->id)}}" enctype="multipart/form-data" >
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="invoiced_at"> invoiced at  </label>
                                <input type="text" class="form-control-plaintext pl-2 "  value="{{$invoice->invoiced_at}}" readonly>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="invoiced_at"> Invoice number  </label>
                                <input type="text" class=" form-control-plaintext pl-2 " readonly  value="{{$invoice->invoice_number}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="due_at"> Paid at  </label>
                            <input type="text" class="form-control"   name='paid_at' value="{{ \Carbon\Carbon::now()}}">
                        </div>
                        <div class="form-group">
                            <label for="amount">@lang("dashboard.remaining")</label>
                            <input  class="form-control-plaintext pl-2 " readonly  placeholder="Enter sale price" value="{{$invoice->remaining()}}" >
                        </div>

                        <div class="form-group">
                            <label for="amount">@lang("dashboard.amount")</label>
                        <input type="number" min="0" max="{{$invoice->remaining()}}" class="form-control" name="amount" placeholder="Enter sale price" value="{{old('name')}}" >
                    </div>

                    <div class="form-group">
                        <input type="hidden" name="document_id" value="{{$invoice->id}}" >
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
        <script>$(document).ready(function() {
            $('.select2').select2();
        });</script>
@endsection
