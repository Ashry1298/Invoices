@extends('layouts.master')
@section('title')
{{__('main.show')}} {{__('main.inv')}}
@endsection
@section('css')
    @include('inc.css')
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">@lang('main.inv') </h4>
            </div>
        </div>
    </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @include('inc.error-notify')
    <!-- row -->
    <div class="row">
        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    @can('اضافة فاتورة')
                        <a class="btn btn-primary" href="{{ route('invoices.create') }}" role="button">
                            {{ __('main.addInv') }}</a>
                    @endcan
                    @can('تصدير EXCEL')
                        <a class="btn btn-secondary " href="{{ route('invoices.export') }}"
                            role="button">{{ __('main.excel') }} </a>
                    @endcan

                </div>




                <div class="card-body">
                    <div class="table-responsive">
                        @if (isset($invoices))
                            <table id="example1" class="table key-buttons text-md-nowrap"
                                data-page-length='50'style="text-align: center">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0">#</th>
                                        <th class="border-bottom-0">{{ __('main.invoiceNum') }} </th>
                                        <th class="border-bottom-0">{{ __('main.invdate') }}</th>
                                        <th class="border-bottom-0">{{ __('main.duedate') }}</th>
                                        <th class="border-bottom-0">{{ __('main.product') }}</th>
                                        <th class="border-bottom-0">{{ __('main.section') }}</th>
                                        <th class="border-bottom-0">{{ __('main.discount') }}</th>
                                        <th class="border-bottom-0">{{ __('main.taxrate') }}</th>
                                        <th class="border-bottom-0">{{ __('main.taxvat') }}</th>
                                        <th class="border-bottom-0">{{ __('main.tot') }}</th>
                                        <th class="border-bottom-0">{{ __('main.status') }}</th>
                                        <th class="border-bottom-0">{{ __('main.notes') }}</th>
                                        <th class="border-bottom-0">{{ __('main.proc') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($invoices as $i => $invoice)
                                        <tr>
                                            <td>{{ $i++ }} </td>
                                            <td>{{ $invoice->invoice_number }}</td>
                                            <td>{{ $invoice->invoice_date }}</td>
                                            <td>{{ $invoice->due_date }}</td>
                                            <td>{{ $invoice->product }}</td>
                                            <td>{{ $invoice->section->section_name }}</td>
                                            <td>{{ $invoice->discount }}</td>
                                            <td>{{ $invoice->rate_vat }}</td>
                                            <td>{{ $invoice->value_vate }}</td>
                                            <td>{{ $invoice->total }}</td>
                                            <td>
                                                @if ($invoice->status == 1)
                                                    <span class="badge badge-pill badge-success">
                                                        {{ __('main.paid') }}</span>
                                                @elseif($invoice->status == 2)
                                                    <span
                                                        class="badge badge-pill badge-danger">{{ __('main.unpaid') }}</span>
                                                @else
                                                    <span
                                                        class="badge badge-pill badge-info">{{ __('main.partial') }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $invoice->note }}</td>
                                            <td>
                                                <div class="dropdown show">
                                                    <a class="btn btn-primary dropdown-toggle" href="#" role="button"
                                                        id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        {{ __('main.proc') }}
                                                    </a>
                                                         <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">

                                                        <a class="dropdown-item"
                                                            href="{{ route('invoicesDetails.show', $invoice->id) }}">{{ __('main.show') }}</a>
                                                        @can('تعديل الفاتورة')
                                                            <a class="dropdown-item"
                                                                href="{{ route('invoices.edit', $invoice->id) }}">{{ __('main.edit') }} </a>
                                                        @endcan
                                                        @can('طباعةالفاتورة')
                                                            <a class="dropdown-item"
                                                                href="{{ route('invoices.print', $invoice->id) }}">{{ __('main.print') }} </a>
                                                        @endcan
                                                        @can('تغير حالة الدفع')
                                                            <a class="dropdown-item"
                                                                href="{{ route('invoices.show', $invoice->id) }}"> 
                                                                {{ __('main.changstat') }}
                                                            </a>
                                                        @endcan
                                                        @can('حذف الفاتورة')
                                                            <form action="{{ route('invoices.destroy', $invoice->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn btn-sm">
                                                                    {{ __('main.die') }}  </button>
                                                            </form>
                                                        @endcan
                                                        @can('ارشفة الفاتورة')
                                                            <form action="{{ route('invoices.destroy', $invoice->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <input type="hidden" name="archieve_invoice" value="1">
                                                                <button type="submit" class="btn btn btn-sm"> 
                                                                    {{ __('main.arch') }}  </button>
                                                            </form>
                                                        @endcan
                                                    </div>
                                                </div>

                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        @endif

                    </div>
                </div>

            </div>
        </div>
        <!--/div-->
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
