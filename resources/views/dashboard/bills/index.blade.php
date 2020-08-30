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

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@lang('dashboard.bills') <small> "{{$bills->total()}}"</small></h3>
                <div class="card-tools ">

                    {{-- <form method="get" action="{{route('dashboard.bills.index')}}">
                    <div class="row">
                        <div class="col-md-6 input-group" style="width: 250px;">
                            <input type="text" name="search" class="form-control float-right"
                                value="{{request()->search}}" placeholder="Search">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group input-group  ">
                                <label class="mx-1">@lang('dashboard.category')</label>
                                <select name="category_id" class="form-control select2">
                                    <option value="">@lang('dashboard.all_categories')</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    </form> --}}
                </div>

            </div>
            <!-- /.card-header -->
            <div class="card-body">
                {{-- <a  href="{{route('dashboard.bills.create')}}" style="font-size:" class="py-2 btn-lg btn-info ">
                <span>
                    <i class="fas fa-plus "></i>
                    <i class="fas fa-box-open "></i>
                </span>
                <span class="ml-1"> @lang('dashboard.add')<span>
                        </a> --}}
                        <div class="box-body table-responsive">

                            <table id="datatable" class="datatable table table-hover">
                                <thead>
                                    <tr>
                                        <th>@lang('dashboard.bill_number')</th>
                                        <th>@lang('dashboard.vendor_name')</th>
                                        <th>@lang('dashboard.amount')</th>
                                        <th>@lang('dashboard.paid')</th>
                                        <th>@lang('dashboard.remaining')</th>
                                        <th>@lang('dashboard.count_of_transaction')</th>
                                        <th>@lang('dashboard.status')</th>
                                        <th>@lang('dashboard.created_at')</th>
                                        <th>@lang('dashboard.action')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bills as $bill)
                                    <tr>
                                        <td>{{ $bill->bill_number }}</td>
                                        <td>{{ $bill->vendor->name }}</td>
                                        <td>{{ number_format($bill->amount, 2) }}</td>
                                        <td>{{ number_format($bill->paid(), 2) }}</td>
                                        <td>{{ number_format($bill->remaining(), 2) }}</td>
                                        <td>{{ $bill->count()}}</td>
                                        <td>{{ $bill->status }}</td>

                                        {{--<td>--}}
                                        {{--<button--}}
                                        {{--data-status="@lang('dashboard.' . $bill->status)"--}}
                                        {{--data-url="{{ route('dashboard.bills.update_status', $bill->id) }}"--}}
                                        {{--data-method="put"--}}
                                        {{--data-available-status='["@lang('dashboard.processing')", "@lang('dashboard.finished') "]'--}}
                                        {{--class="bill-status-btn btn {{ $bill->status == 'processing' ? 'btn-warning' : 'btn-success disabled' }}
                                        btn-sm"--}}
                                        {{-->--}}
                                        {{--@lang('dashboard.' . $bill->status)--}}
                                        {{--</button>--}}
                                        {{--</td>--}}
                                        <td>{{ $bill->created_at->toFormattedDateString() }}</td>
                                        <td class="d-inline-flex" >
                                            {{-- <button class="btn btn-primary btn-sm bill-bills"
                                                data-url="{{ route('dashboard.bills.show', $bill->id) }}"
                                            data-method="get"
                                            > --}}
                                            <a class="btn btn-primary btn-sm"
                                                href="{{ route('dashboard.bills.show', $bill->id) }}">
                                                <i class="fa fa-list"></i>
                                                @lang('dashboard.show')</a>
                                            <a class="btn btn-success btn-sm"
                                                href="{{ route('dashboard.bills.show', $bill->id) }}">
                                                <i class="fa fa-print"></i>
                                                @lang('dashboard.print')</a>
                                            {{-- </button> --}}
                                            @if (auth()->user()->hasPermission('update-bills'))
                                            <a href="{{ route('dashboard.vendors.bills.edit', ['vendor' => $bill->vendor->id, 'bill' => $bill->id]) }}"
                                                class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i>
                                                @lang('dashboard.edit')</a>
                                            @else
                                            <a href="#" disabled class="btn btn-warning btn-sm"><i
                                                    class="fa fa-edit"></i> @lang('dashboard.edit')</a>
                                            @endif

                                            @if (auth()->user()->hasPermission('delete-bills'))
                                            <form action="{{ route('dashboard.bills.destroy', $bill->id) }}"
                                                method="post" style="display: inline-block;">
                                                {{ csrf_field() }}
                                                {{ method_field('delete') }}
                                                <button type="submit" class="btn btn-danger btn-sm delete"><i
                                                        class="fa fa-trash"></i> @lang('dashboard.delete')</button>
                                            </form>

                                            @else
                                            <a href="#" class="btn btn-danger btn-sm" disabled><i
                                                    class="fa fa-trash"></i> @lang('dashboard.delete')</a>
                                            @endif

                                        </td>

                                    </tr>

                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>@lang('dashboard.bill_number')</th>
                                        <th>@lang('dashboard.vendor_name')</th>
                                        <th>@lang('dashboard.amount')</th>
                                        <th>@lang('dashboard.paid')</th>
                                        <th>@lang('dashboard.remaining')</th>
                                        <th>@lang('dashboard.count_of_transaction')</th>
                                        <th>@lang('dashboard.status')</th>
                                        <th>@lang('dashboard.created_at')</th>
                                        <th>@lang('dashboard.action')</th>
                                    </tr>
                                </tfoot>


                            </table><!-- end of table -->
                        </div>

                        {{-- {{ $bills->appends(request()->query())->links() }} --}}

            </div>
            <!-- /.card-body -->

        </div>
        <!-- /.card -->
    </section>

</div><!-- end of content wrapper -->

@endsection
