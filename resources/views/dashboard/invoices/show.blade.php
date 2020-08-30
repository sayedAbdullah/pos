@extends('layouts.dashboard.app')

@section('content')

<div class="content-wrapper">

    {{-- <section class="content-header">

            <h1>@lang('dashboard.invoices')
                <small> @lang('dashboard.invoices')</small>
            </h1>

            <ol class="breadcrumb">
                <li><a href="{{ url('dashboard/index') }}"><i class="fa fa-dashboard"></i>
    @lang('dashboard.dashboard')</a></li>
    <li class="active">@lang('dashboard.invoices')</li>
    </ol>
    </section> --}}
    <br>



    <br>
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="timeline">
                    <!-- timeline time label -->
                    <div class="time-label">
                    <span class="bg-red">{{$invoice->invoiced_at->format('d-m-y')}}</span>
                    </div>
                    <!-- /.timeline-label -->

                    <!-- timeline item -->
                    <div>
                        <i class="fas fa-user bg-green"></i>
                        <div class="timeline-item">
                            <span class="time"><i class="fas fa-clock"></i> 5 mins ago</span>
                            <h3 class="timeline-header no-border"><a href="#">{{$invoice->invoice_number}}</a> 
                            @lang('dashboard.created_by') {{$invoice->user->first_name}}</h3>
                        </div>
                    </div>
                    <!-- END timeline item -->

                    <!-- timeline item -->
                    
                    @foreach ($invoice->transactions as $transaction)
                        <?php if ($invoice->invoiced_at->format('d-m-y') == $transaction->paid_at->format('d-m-y')) { ?>
                            <div>
                                <i class="fas fa-envelope bg-blue"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="fas fa-clock"></i> 12:05</span>
                                <h3 class="timeline-header"><a href="#"></a>@lang('dashboard.paid_cash_to') {{$transaction->user->first_name}}</h3>

                                    <div class="timeline-body">
                                        {{$transaction->amount}} جنيه
                                    </div>

                                </div>
                            </div>
                        <!-- END timeline item -->
                        <?php }else{ ?>
                                
                            <!-- timeline time label -->
                            <div class="time-label">
                                <span class="bg-green">{{$transaction->paid_at->format('d-m-y')}}</span>
                            </div>
                            <!-- /.timeline-label -->
                            <!-- timeline item -->
                            <div>
                                <i class="fa fa-camera bg-purple"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="fas fa-clock"></i> 2 days ago</span>
                                    <h3 class="timeline-header"><a href="#"></a> @lang('dashboard.paid_cash_to') {{$transaction->user->first_name}} </h3>
                                     {{ $transaction->amount}} جنيه
                                    <div class="timeline-body">
                                    </div>
                                </div>
                            </div>
                            <!-- END timeline item -->
                        <?php } ?>
                        
                    @endforeach



                    <div>
                        <i class="fas fa-clock bg-gray"></i>
                    </div>
                </div>




                <div class="card">
                    <div class="card-header d-flex">
                        <h2>{{ __('dashboard.invoice', ['invoice_number' => $invoice->invoice_number]) }}</h2>
                        <div class="ml-auto">
                            <a href="{{ route('dashboard.invoices.print',$invoice->id) }}" class="btn btn-success "><i
                                    class="fa fa-print"></i> {{ __('dashboard.print') }}</a>
                            <a href="{{ route('dashboard.invoices.transactions.create',$invoice->id) }}"
                                class="btn btn-warning "><i class="fa fa-credit-card"></i>
                                {{ __('dashboard.cash_payment') }}</a>
                        </div>

                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th>{{ __('dashboard.invoice_number') }}</th>
                                    <td>{{ $invoice->invoice_number }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('dashboard.client_name') }}</th>
                                    <td>{{ $invoice->client->name }}</td>
                                    <th>{{ __('dashboard.phone') }}</th>
                                    <td>{{implode('-', array_filter($invoice->client->phone) )}}</td>

                                </tr>
                                <tr>
                                    {{-- @foreach ($$invoice->client->phone as $item)
                                            <td>{{ $item }}</td>

                                    @endforeach --}}
                                    {{-- <th>{{ __('dashboard.company_name') }}</th>
                                    <td>{{ $invoice->client->name  }}</td> --}}
                                </tr>

                                <tr>
                                    <th>{{ __('dashboard.created_at') }}</th>
                                    <td>{{ $invoice->created_at->format('h:m - Y/m/d') }}</td>
                                    <th>{{ __('dashboard.due_at') }}</th>
                                    <td>{{ $invoice->due_at->format('Y/m/d')  }}</td>

                                </tr>
                            </table>

                            <h3>{{ __('dashboard.invoice_details') }}</h3>

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
                                    {{-- {{$invoice->items}} --}}
                                    @foreach($invoice->items as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        {{-- <td>{{ $item->id }}</td> --}}
                                        {{-- <td><a href="{{route('dashboard.product.show',$invoice->item_id)}}" >
                                        {{ $item->name }} </a></td> --}}
                                        <td><a href="#"> {{ $item->name }} </a></td>
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
                                        <td>{{ $invoice->amount }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"></td>
                                        <th colspan="2"><a
                                                href="#">{{ __('dashboard.paid') }}</a>
                                        </th>
                                        <td class="text-success">{{ $invoice->paid() }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"></td>
                                        <th colspan="2">{{ __('dashboard.remaining') }}</th>
                                        <td class="text-danger">{{ $invoice->remaining()}}</td>
                                    </tr>

                                </tfoot>
                            </table>
                        </div>

                        <div class="row">
                            <div class="col-12 text-center">
                                {{-- <a href="{{ route('invoice.print', $invoice->id) }}" class="btn btn-primary btn-sm
                                ml-auto"><i class="fa fa-print"></i> {{ __('dashboard.print') }}</a>
                                <a href="{{ route('invoice.pdf', $invoice->id) }}"
                                    class="btn btn-secondary btn-sm ml-auto"><i class="fa fa-file-pdf"></i>
                                    {{ __('dashboard.export_pdf') }}</a>
                                <a href="{{ route('invoice.send_to_email', $invoice->id) }}"
                                    class="btn btn-success btn-sm ml-auto"><i class="fa fa-envelope"></i>
                                    {{ __('dashboard.send_to_email') }}</a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- end of content section -->

</div><!-- end of content wrapper -->

@endsection
