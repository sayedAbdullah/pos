<div class='row'>
    <style>
        .delete {
            display: inline-block;
            font-weight: 400;
            color: #212529;
            text-align: center;
            vertical-align: middle;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            background-color: transparent;
            border: 1px solid transparent;
            border-top-color: transparent;
            border-right-color: transparent;
            border-bottom-color: transparent;
            border-left-color: transparent;
            padding: .375rem .75rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: .25rem;
            transition: color .15s ease-in-out, background-color .15s eas e-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;

            color: #fff;
            background-color: #dc3545;
            border-color: #dc3545;
            box-shadow: none;
            /* font-weight: 900;
            font-family: "Font Awesome 5 Free";
            display: inline-block;
            font-style: normal;
            font-variant: normal;
            text-rendering: auto;
            line-height: 1; */
            flex: 0 0 13%;
            max-width: 10%;
            height: 10%;

            margin-right: 2%;
            font-weight: bold;
        }

        .delete:hover {
            color: #fff;
            background-color: #c82333;
            border-color: #bd2130;
        }

        .form-control-custom {
            display: block;
            /* width: 100%; */
            /* height: calc(2.25rem + 2px); */
            /* padding: .375rem .75rem; */
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            /* border: 1px solid #ced4da; */
            border-radius: .25rem;
            box-shadow: inset 0 0 0 transparent;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;

            flex: 0 0 80%;
            max-width: 80%;
        }

    </style>


    <div class='col-md-6'>
        <div class="form-group">
            <label for="client_id">client</label>
            <select id="select-country" name='client_id' class='form-control' id='client_id'
                aria-describedby='client_id_help'>
                @foreach ($clients as $client)
                <option @if(old("client_id")==$client->id) selected='selected' @endif value="{{$client->id}}">
                    {{$client->name}}
                </option>

                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="invoiced_at"> Invoice at </label>
            <input type="text" type="date" class="datepicker form-control" id="invoiced_at" aria-describedby="invoiced_at_help"
                name='invoiced_at' value="{{old("invoiced_at",$invoice->invoiced_at ?? \Carbon\Carbon::now()->format('Y-m-d'))}}">
        </div>

    </div>
    <div class='col-md-6'>
        <div class="form-group">
            <label for="invoice_number">invoice number</label>
            <input type="text" class="form-control" id="invoice_number" aria-describedby="invoice_number_help"
                name='invoice_number' value="{{old("invoice_number",$invoice->get_invoice_number())}}">
        </div>
        <div class="form-group">
            <label for="due_at"> Due Date </label>
            <input type="datetime" class="datepicker form-control" name="due_at" aria-describedby="due_at_help" name='invoiced_at'
                value="{{old("due_at",$invoice->invoiced_at ?? \Carbon\Carbon::now())}}">
        </div>
    </div>
</div>
<div class="card mt-4">

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr class="item-row">
                            <th class="col-5">Item</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr id="hiderow">
                            <td colspan="4">
                                <a id="addRow" href="javascript:;" title="Add a row" class="btn btn-primary">Add a
                                    row</a>
                            </td>
                        </tr>
                        <!-- Here should be the item row -->
                        <!--<tr class="item-row">
                            <td><input class="form-control item" placeholder="Item" type="text"></td>
                            <td><input class="form-control price" placeholder="Price" type="text"></td>
                            <td><input class="form-control qty" placeholder="Quantity" type="text"></td>
                            <td><span class="total">0.00</span></td>
                        </tr>-->

                        <td></td>
                        <td></td>
                        <td class="text-right"><strong>Sub Total</strong></td>
                        <td><span id="subtotal">0.00</span></td>
                        </tr>
                        <tr>
                            <td><strong>Total Quantity: </strong><span id="totalQty"
                                    style="color: red; font-weight: bold">0</span> Units</td>
                            <td></td>
                            <td class="text-right"><strong>Discount</strong></td>
                            <td><input class="form-control" id="discount" value="0" type="text"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td class="text-right"><strong>Shipping</strong></td>
                            <td><input class="form-control" id="shipping" value="0" type="text"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td class="text-right"><strong>Grand Total</strong></td>
                            <td><span id="grandTotal">0</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<div class="col-md-12 form-group">
    <label for="status">@lang('dashboard.payment')</label>
    <select style="width: 50%" id="status" name='status' class='selectize-input d-block ' id='status'
        aria-describedby='status'>
        <option value="unpaid" selected>@lang('dashboard.unpaid')</option>
        <option value="partial">@lang('dashboard.partial')</option>
        <option value="paid">@lang('dashboard.paid')</option>
    </select>
</div>

<div class="hidden  paid-group col-md-12 form-group ">
    <label for="paid">@lang('dashboard.paid')</label>
    <input type="number" name="paid" min="0" max="" class=" form-control" style="width: 50%">
</div>
<div class="col-md-12 form-group">
    <label for="notes">notes</label>
    <textarea style="width: 100%" type="text" class="form-control" id="notes" name='notes'
        value="{{old("notes",$invoice->notes)}}"></textarea>
</div>
<select class="name-input form-control d-none ">
    <option value="">Select a product name</option>

    @foreach ($products as $product)
    <option class="option-input " id="product-{{ $product->id }}" value='{{$product->id }}&{{$product->sale_price }}'>

        <i class="fa fa-plus"></i>
        {{ $product->name }}
        </a>
    </option>
    @endforeach
</select>
<head>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">


<script>
    var options = $('.name-input').html();

</script>
<script src="{{ asset('jquery.invoice.js')}}"></script>
