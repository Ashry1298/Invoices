@extends('layouts.master')
@section('css')
    @include('inc.css')
@endsection
@section('title')
    {{ __('main.editinv') }}
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto"> {{ __('main.inv') }}</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    {{ __('main.editinv') }}</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @include('inc.error')
    <!-- row -->
    <div class="row">

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">

                    <form action="{{ route('invoices.update', $invoice->id) }}" method="POST" autocomplete="off">
                        @method('PATCH')
                        @csrf
                        {{-- 1 --}}
                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label"> {{ __('main.invoiceNum') }}</label>
                                <input type="hidden" name="invoice_id" value="">
                                <input type="text" class="form-control" id="inputName" name="invoice_number"
                                    title="يرجي ادخال رقم الفاتورة" value="{{ $invoice->invoice_number }}" required>
                            </div>

                            <div class="col">
                                <label>{{ __('main.invdate') }}</label>
                                <input class="form-control fc-datepicker" name="invoice_date" placeholder="YYYY-MM-DD"
                                    type="text" value="{{ $invoice->invoice_date }}" required>
                            </div>

                            <div class="col">
                                <label> {{ __('main.duedate') }}</label>
                                <input class="form-control fc-datepicker" name="due_date" placeholder="YYYY-MM-DD"
                                    type="text" value="{{ $invoice->due_date }}" required>
                            </div>

                        </div>

                        {{-- 2 --}}
                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">{{ __('main.section') }}</label>
                                <select name="section_id" class="form-control SlectBox" onclick="console.log($(this).val())"
                                    onchange="console.log('change is firing')">
                                    <option value="{{ $invoice->section_id }}">
                                        {{ $invoice->section->section_name }}</option>
                                    @foreach ($sections as $section)
                                        @if ($section->section_name != $invoice->section->section_name)
                                            <option value="{{ old('section_id') ?? $section->id }}">
                                                {{ $section->section_name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            {{-- <option value="{{ $invoice->product }}">{{ $invoice->product }} </option> --}}
                            <div class="col">
                                <label for="inputName" class="control-label">{{ __('main.product') }}</label>
                                <select id="Product" name="product" class="form-control">
                                    <option selected disabled> {{ __('main.choose') }}</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="inputName" class="control-label"> {{ __('main.collection') }}</label>
                                <input type="text" class="form-control" id="inputName" name="amount_collection"
                                    value="{{ $invoice->amount_collection }}"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                            </div>
                        </div>


                        {{-- 3 --}}

                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label"> {{ __('main.commission') }}</label>
                                <input type="text" class="form-control form-control-lg" id="amount_commission"
                                    name="amount_commission" title="يرجي ادخال مبلغ العمولة "
                                    value="{{ $invoice->amount_commission }}"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    required>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">{{ __('main.discount') }}</label>
                                <input type="text" class="form-control form-control-lg" id="Discount" name="discount"
                                    title="يرجي ادخال مبلغ الخصم "
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    value="{{ $invoice->discount }}" required>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">{{ __('main.taxrate') }}</label>
                                <select name="rate_vat" id="Rate_VAT" class="form-control" onchange="myFunction()">
                                    <!--placeholder-->

                                    <option value="{{ $invoice->rate_vat }}" selected>
                                        {{ $invoice->rate_vat }}
                                    </option>
                                    <option value="10%">10%</option>
                                    <option value="15%">15%</option>
                                    <option value="20%">20%</option>
                                </select>
                            </div>

                        </div>

                        {{-- 4 --}}

                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label"> {{ __('main.taxvat') }}</label>
                                <input type="text" class="form-control" id="Value_VAT" name="value_vate"
                                    value="{{ $invoice->value_vate }}" readonly>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">{{ __('main.tot') }}</label>
                                <input type="text" class="form-control" id="Total" name="total" readonly
                                    value="{{ $invoice->total }}">
                            </div>
                        </div>
                        <div class="col">
                            <label for="inputName" class="control-label">{{ __('main.status') }}</label>
                            <select name="status" class="form-control SlectBox" onclick="console.log($(this).val())"
                                onchange="console.log('change is firing')">
                                <!--placeholder -->
                                @php
                                    $array = [1, 2, 3];
                                @endphp
                                @for ($i = 0; $i < count($array); $i++)
                                    @if ($array[$i] != $invoice->status)
                                        <option value="10%">
                                            @switch($array[$i])
                                                @case(1)
                                                    {{ __('main.paid') }}
                                                @break

                                                @case(2)
                                                    {{ __('main.unpaid') }}
                                                @break

                                                @default
                                                    {{ __('main.partial') }}
                                            @endswitch
                                        </option>
                                    @endif
                                @endfor
                            </select>
                        </div>
                        {{-- 5 --}}
                        <div class="row">
                            <div class="col">
                                <label for="exampleTextarea">{{ __('main.notes') }}</label>
                                <textarea class="form-control" id="exampleTextarea" name="note" rows="3">
                                    {{ $invoice->note }}
                               </textarea>
                            </div>
                        </div><br>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">{{ __('main.save') }}</button>
                        </div>


                    </form>
                </div>
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
    @include('inc.js3')
@endsection
