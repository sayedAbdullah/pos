@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('dashboard.bills')
                <small> @lang('dashboard.bills')</small>
            </h1>

            <ol class="breadcrumb">
                <li><a href="{{ url('dashboard/index') }}"><i class="fa fa-dashboard"></i> @lang('dashboard.dashboard')</a></li>
                <li class="active">@lang('dashboard.bills')</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex">
                            <h2>{{ __('dashboard.bill', ['bill_number' => $bill->bill_number]) }}</h2>
                            <a href="{{ route('dashboard.bills.index') }}" class="btn btn-primary ml-auto"><i class="fa fa-home"></i> {{ __('dashboard.back') }}</a>
                        </div>
        
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th>{{ __('dashboard.bill_number') }}</th>
                                        <td>{{ $bill->bill_number }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('dashboard.vendor_name') }}</th>
                                        <td>{{ $bill->vendor->name }}</td>
                                        <th>{{ __('dashboard.phone') }}</th>
                                        <td>{{implode('-', array_filter($bill->vendor->phone) )}}</td>

                                    </tr>
                                    <tr>
                                        {{-- @foreach ($$bill->vendor->phone as $item)
                                            <td>{{ $item }}</td>

                                        @endforeach --}}
                                        {{-- <th>{{ __('dashboard.company_name') }}</th>
                                        <td>{{ $bill->vendor->name  }}</td> --}}
                                    </tr>

                                    <tr>
                                        <th>{{ __('dashboard.created_at') }}</th>
                                        <td>{{ $bill->created_at->format('h:m - Y/m/d') }}</td>
                                        <th>{{ __('dashboard.due_at') }}</th>
                                        <td>{{ $bill->due_at->format('Y/m/d')  }}</td>

                                    </tr>
                                </table>
        
                                <h3>{{ __('dashboard.bill_details') }}</h3>
        
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('dashboard.product') }}</th>
                                        <th>{{ __('dashboard.price') }}</th>
                                        <th>{{ __('dashboard.quantity') }}</th>
                                        <th>{{ __('dashboard.total') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        {{-- {{$bill->items}} --}}
                                    @foreach($bill->items as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        {{-- <td>{{ $item->id }}</td> --}}
                                        {{-- <td><a href="{{route('dashboard.product.show',$bill->item_id)}}" > {{ $item->name }} </a></td> --}}
                                        <td><a href="#" > {{ $item->name }} </a></td>
                                        <td>{{ $item->price }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ $item->total }}</td>
                                        <td>{{ $item->amount }}</td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td colspan="3"></td>
                                        <th colspan="2">{{ __('dashboard.amount') }}</th>
                                        <td>{{ $bill->amount }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"></td>
                                    <th colspan="2" ><a href="{{route('dashboard.bills.transactions.show',$bill->id)}}">{{ __('dashboard.paid') }}</a></th>
                                        <td class="text-success">{{ $bill->paid() }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"></td>
                                        <th colspan="2">{{ __('dashboard.remaining') }}</th>
                                        <td class="text-danger">{{ $bill->remaining()}}</td>
                                    </tr>
        
                                    </tfoot>
                                </table>
                            </div>
        
                            <div class="row">
                                <div class="col-12 text-center">
                                    {{-- <a href="{{ route('bill.print', $bill->id) }}" class="btn btn-primary btn-sm ml-auto"><i class="fa fa-print"></i> {{ __('dashboard.print') }}</a>
                                    <a href="{{ route('bill.pdf', $bill->id) }}" class="btn btn-secondary btn-sm ml-auto"><i class="fa fa-file-pdf"></i> {{ __('dashboard.export_pdf') }}</a>
                                    <a href="{{ route('bill.send_to_email', $bill->id) }}" class="btn btn-success btn-sm ml-auto"><i class="fa fa-envelope"></i> {{ __('dashboard.send_to_email') }}</a> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </section><!-- end of content section -->

    </div><!-- end of content wrapper -->

@endsection


