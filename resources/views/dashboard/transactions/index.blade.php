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
                    {{-- <h3 class="card-title">@lang('dashboard.transactions') <small> "{{$transactions->total()}}"</small></h3> --}}
                      <div class="card-tools ">

                        <form method="get" action="{{route('dashboard.transactions.index')}}">
                            <div class="row">
                                <div class="col-md-6 input-group" style="width: 250px;">
                                    <input type="text" name="search" class="form-control float-right" value="{{request()->search}}" placeholder="Search">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group input-group  ">
                                        <label class="from">@lang('dashboard.category')</label>
                                        <input name="from" type="text" class="pickdate form-control">
                                        {{-- <select name="category_id" class="form-control select2" >
                                            <option value="" >@lang('dashboard.all_categories')</option>
                                            @foreach ($categories as $category)
                                            <option {{(request()->category_id)==$category->id?'selected':''}} value="{{$category->id}}">{{$category->translate(app()->getLocale())->name}}</option>
                                            @endforeach
                                        </select> --}}
                                    </div>
                                </div>
                            </div>

                        </form>
                      </div>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                      <table class="mt-3 table datatable">
                        <thead>
                          <tr>
                            <th style="width: 10px">#</th>
                            <th>@lang('dashboard.name')</th>
                            <th>@lang('dashboard.invoice_number')</th>
                            <th>@lang('dashboard.type')</th>
                            <th>@lang('dashboard.amount')</th>
                            <th>@lang('dashboard.date')</th>

                            <th>@lang('dashboard.action')</th>

                          </tr>
                        </thead>
                        <tbody>


                            @foreach ($transactions as $transaction)

                            @if ($transaction->type == 'income')
                                <tr class="table-success border border-success">

                                <td>{{$transaction->id}}</td>
    
                                <td>{{$transaction->invoice->client->name  }}</td>
                                <td>{{$transaction->invoice->invoice_number  }}</td>
                                <td class="text-success"><i class="fa fa-arrow-up" aria-hidden="true"></i>  income</td>
                                <td class="text-success">{{$transaction->amount}} $</td>

                            @else
                            <tr class="table-danger border border-danger">

                            <td>{{$transaction->id}}</td>

                                <td>{{$transaction->bill->vendor->name  }}</td>
                                <td>{{$transaction->bill->bill_number  }}</td>
                                <td class="text-danger"><i class="fa fa-arrow-down" aria-hidden="true"></i>  expense</td>
                                <td class="text-danger">{{$transaction->amount}} $</td>
    
                            @endif
                            <td>{{$transaction->paid_at}}</td>

                            <td>
                                @if (auth()->user()->hasPermission('update-transactions'))

                                <a class="btn btn-success" href="{{route('dashboard.transactions.edit',$transaction->id)}}">@lang('dashboard.edit')</a>
                                @else
                                <button class="btn btn-success disabled">@lang('dashboard.edit')</button>
                                @endif
                                @if (auth()->user()->hasPermission('delete-transactions'))
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
                                        @lang('dashboard.confirm.content')@lang('dashboard.transaction')
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('dashboard.close')</button>
                                        <form style="display:inline-block" method="POST" action="{{route('dashboard.transactions.destroy',$transaction->id )}}">
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
                      <br>
                      <Table class="table col-md-8 m-auto">
                          <thead>
                          <tr>
                          <th>expense</th>
                          <th>income</th>
                          <th>total</th>
                          </tr>
                          </thead>
                          <tr>
                            <th>{{$sum_expense}} $</th>
                            <th>{{$sum_income}} $</th>
                            <th>{{$sum_income-$sum_expense}} $</th>
                        </tr>
                            

                      </Table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        {{-- {{$transactions->appends()->links()}} --}}
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
