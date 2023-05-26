@extends('layouts.master')
@section('css')
    @include('inc.css')
@endsection
@section('title')
{{__('main.addInvoice')}}
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{__('main.inv')}}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                     {{__('main.addInvoice')}}</span>
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
                    <form action="{{ route('invoices.store') }}" method="post" enctype="multipart/form-data"
                        autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label"> {{__('main.invoiceNum')}}</label>
                                <input type="text" class="form-control" id="inputName" name="invoice_number"
                                    title="يرجي ادخال رقم الفاتورة" value="{{ old('invoice_number') }}" required>
                            </div>
                            <div class="col">
                                <label>{{ __('main.invdate') }}</label>
                                <input class="form-control fc-datepicker" name="invoice_date" placeholder="YYYY-MM-DD"
                                    type="text" value="{{ date('Y-m-d') }}" required>
                            </div>
                         
                  
                        
                            <div class="col">
                                <label>{{ __('main.duedate') }}</label>
                                <input class="form-control fc-datepicker" name="due_date" placeholder="YYYY-MM-DD"
                                    type="text" value="{{ old('due_date') }}"required>
                            </div>
                        </div>
                        {{-- 2 --}}
                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">{{ __('main.section') }}</label>
                                <select name="section_id" class="form-control SlectBox" onclick="console.log($(this).val())"
                                    onchange="console.log('change is firing')">
                                    <!--placeholder-->
                                    <option selected disabled
                                    >{{ __('main.choosesection') }}

                                </option>
                                    @foreach ($sections as $section)
                                        <option value="{{ old('section_id') ?? $section->id }}">
                                            {{ $section->section_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label for="inputName" class="control-label">{{ __('main.product') }}</label>
                                <select id="Product" name="product" class="form-control">
                                    <option selected disabled> {{ __('main.choose') }} {{__('main.product')}}</option>
                                </select>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label"> {{ __('main.collection') }}</label>
                                <input type="text" class="form-control" id="inputName" name="amount_collection"
                                    value="{{ old('amount_collection') }}"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                            </div>
                        </div>


                        {{-- 3 --}}

                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">{{ __('main.commission') }}</label>
                                <input type="text" class="form-control form-control-lg" id="amount_commission"
                                    name="amount_commission" title="يرجي ادخال مبلغ العمولة "
                                    value="{{ old('amount_commission') }}"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    required>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">{{ __('main.discount') }}</label>
                                <input type="text" class="form-control form-control-lg" id="discount" name="discount"
                                    title="يرجي ادخال مبلغ الخصم " value="{{ old('discount') ?? 0 }}"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    required>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">{{ __('main.taxrate') }}</label>
                                <select name="rate_vat" id="rate_vat" class="form-control" onchange="myFunction()">
                                    <!--placeholder-->
                                    <option value="" selected disabled>{{ __('main.choose') }} {{__('main.taxrate')}}</option>
                                    <option value="5%"  {{ old('rate_vat') == '5%' ? 'selected' : '' }}>5% </option>
                                    <option value="10%" {{ old('rate_vat') == '10%' ? 'selected' : '' }}>10% </option>
                                    <option value="15%" {{ old('rate_vat') == '15%' ? 'selected' : '' }}>15% </option>
                                    <option value="20%" {{ old('rate_vat') == '20%' ? 'selected' : '' }}>20% </option>

                                </select>
                            </div>

                        </div>

                        {{-- 4 --}}

                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">{{ __('main.taxvat') }}</label>
                                <input type="text" class="form-control" id="value_vate" name="value_vate"
                                    value="{{ old('value_vate') }}" readonly>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">{{ __('main.tot') }}</label>
                                <input type="text" class="form-control" id="total" name="total"
                                    value="{{ old('total') }}" readonly>
                            </div>
                        </div>
                        <div class="col">
                            <label for="inputName" class="control-label">{{ __('main.status') }}</label>
                            <select name="status" class="form-control SlectBox" onclick="console.log($(this).val())"
                                onchange="console.log('change is firing')">
                                <!--placeholder  --> 
                                <option value="" selected disabled>{{__('main.choosestat')}} </option>
                                <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>{{__('main.paid')}} </option>
                                <option value="2" {{ old('status') == 2 ? 'selected' : '' }}> {{__('main.unpaid')}} </option>
                                <option value="3" {{ old('status') == 3 ? 'selected' : '' }}> {{__('main.partial')}} </option>
                            </select>
                        </div>
                        {{-- 5 --}}
                        <div class="row">
                            <div class="col">
                                <label for="exampleTextarea">{{ __('main.notes') }}</label>
                                <textarea class="form-control" id="exampleTextarea" name="note" rows="3"> {{ old('note') }}</textarea>
                            </div>
                        </div><br>

                        <p class="text-danger">*{{__('main.attachformat')}}</p>
                        <h5 class="card-title">{{__('main.attachment')}}</h5>

                        <div class="col-sm-12 col-md-12">
                            <input type="file" name="file" class="dropify"
                                accept=".pdf,.jpg, .png, image/jpeg, image/png" data-height="70" />
                        </div><br>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">{{__('main.save')}}</button>
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
    @include('inc.js')
@endsection
