@extends('layouts.master')
@section('css')
@endsection
@section('title')
    {{ __('main.changstat') }}
@stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto"> {{ __('main.inv') }}</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    {{ __('main.changstat') }}</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('invoices.statusUpdate', $invoice->id) }}" method="post" autocomplete="off">
                        @csrf

                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label"> {{ __('main.invoiceNum') }} </label>
                                <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">
                                <input type="text" class="form-control" id="inputName" name="invoice_number"
                                    title="يرجي ادخال رقم الفاتورة" value="{{ $invoice->invoice_number }}" required
                                    readonly>
                            </div>

                            <div class="col">
                                <label>{{ __('main.invdate') }}</label>
                                <input class="form-control fc-datepicker" name="invoice_date" placeholder="YYYY-MM-DD"
                                    type="text" value="{{ $invoice->invoice_date }}" required readonly>
                            </div>

                            <div class="col">
                                <label>{{ __('main.duedate') }}</label>
                                <input class="form-control fc-datepicker" name="due_date" placeholder="YYYY-MM-DD"
                                    type="text" value="{{ $invoice->due_date }}" required readonly>
                            </div>

                        </div>

                        {{-- 2 --}}
                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">{{ __('main.section') }}</label>
                                <select class="form-control" id="section" name="section_id" required>
                                    <option value="{{ $invoice->section_id }}">{{ $invoice->section->section_name }}
                                    </option>
                                </select>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">{{ __('main.product') }}</label>
                                <select id="product" name="product" class="form-control" readonly>
                                    <option value="{{ $invoice->product }}"> {{ $invoice->product }}</option>
                                </select>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label"> {{ __('main.collection') }}</label>
                                <input type="text" class="form-control" id="inputName" name="Amount_collection"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    value="{{ $invoice->Amount_collection }}" readonly>
                            </div>
                        </div>


                        {{-- 3 --}}

                        <div class="row">

                            <div class="col">
                                <label for="inputName" class="control-label"> {{ __('main.commission') }} </label>
                                <input type="text" class="form-control form-control-lg" id="Amount_Commission"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    value="{{ $invoice->Amount_Commission }}" required readonly>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">{{ __('main.discount') }}</label>
                                <input type="text" class="form-control form-control-lg" id="Discount" name="Discount"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    value="{{ $invoice->discount }}" required readonly>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label"> {{ __('main.taxrate') }}</label>
                                <select name="Rate_VAT" id="Rate_VAT" class="form-control" onchange="myFunction()"
                                    readonly>
                                    <!--placeholder-->
                                    <option value=" {{ $invoice->rate_vat }}">
                                        {{ $invoice->rate_vat }}
                                </select>
                            </div>

                        </div>

                        {{-- 4 --}}

                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">{{ __('main.taxvat') }}</label>
                                <input type="text" class="form-control" id="Value_VAT" name="Value_VAT"
                                    value="{{ $invoice->value_vate }}" readonly>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">{{ __('main.tot') }} </label>
                                <input type="text" class="form-control" id="Total" name="Total" readonly
                                    value="{{ $invoice->total }}">
                            </div>
                        </div>

                        {{-- 5 --}}
                        <div class="row">
                            <div class="col">
                                <label for="exampleTextarea">{{ __('main.notes') }}</label>
                                <textarea class="form-control" id="exampleTextarea" name="note" rows="3" readonly>
                                {{ $invoice->note }}</textarea>
                            </div>
                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label for="exampleTextarea">{{ __('main.status') }}</label>
                                <select class="form-control" id="Status" name="status" required>
                                    <option value="1" {{ $invoice->status == 1 ? 'selected' : '' }}>
                                        {{__('main.paid') }}
                                    </option>
                                    <option value="2"{{ $invoice->status == 2 ? 'selected' : '' }}>
                                        {{__('main.unpaid') }}
                                    </option>
                                    <option value="3"{{ $invoice->status == 3 ? 'selected' : '' }}>
                                        {{__('main.partial') }}
                                    </option>
                                </select>
                            </div>

                            <div class="col">
                                <label>{{ __('main.paymentDate') }} </label>
                                <input class="form-control fc-datepicker" name="Payment_Date" placeholder="YYYY-MM-DD"
                                    type="text" required>
                            </div>


                        </div><br>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary"> {{ __('main.updatestatus') }}</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal  Form-elements js-->
    <script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
    <script src="{{ URL::asset('assets/js/select2.js') }}"></script>
    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <!-- Internal form-elements js -->
    <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>

    <script>
        var date = $('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd'
        }).val();
    </script>
@endsection
