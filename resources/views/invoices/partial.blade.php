@extends('layouts.master')
@section('title')
    {{ __('main.partial') }}
@stop
@section('css')
    @include('inc.css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ __('main.inv') }}</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    {{ __('main.partial') }}
                </span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')


    <!-- row -->
    <div class="row">
        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50'>
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">{{ __('main.invoiceNum') }} </th>
                                    <th class="border-bottom-0">{{ __('main.invdate') }}</th>
                                    <th class="border-bottom-0">{{ __('main.duedate') }}</th>
                                    <th class="border-bottom-0">{{ __('main.section') }}</th>
                                    <th class="border-bottom-0">{{ __('main.product') }}</th>
                                    <th class="border-bottom-0">{{ __('main.commis') }}</th>
                                    <th class="border-bottom-0">{{ __('main.discount') }}</th>
                                    <th class="border-bottom-0">{{ __('main.taxrate') }}</th>
                                    <th class="border-bottom-0">{{ __('main.taxvat') }}</th>
                                    <th class="border-bottom-0">{{ __('main.tot') }}</th>
                                    <th class="border-bottom-0">{{ __('main.notes') }}</th>
                                    <th class="border-bottom-0">{{ __('main.proc') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($PartialInvoices as $x => $invoice)
                                    <tr>
                                        <td>{{ $x }}</td>
                                        <td>{{ $invoice->invoice_number }}</td>
                                        <td>{{ $invoice->invoice_date }}</td>
                                        <td>{{ $invoice->due_date }}</td>
                                        <td>{{ $invoice->section->section_name }} </td>
                                        <td>{{ $invoice->product }}</td>
                                        <td>{{ $invoice->Amount_Commission }} </td>
                                        <td>{{ $invoice->discount }}</td>
                                        <td>{{ $invoice->rate_vat }}</td>
                                        <td>{{ $invoice->value_vate }}</td>
                                        <td>{{ $invoice->total }}</td>
                                        <td>{{ $invoice->note }}</td>
                                        <td>
                                            <div class="dropdown show">
                                                <a class="btn btn-primary dropdown-toggle" href="#" role="button"
                                                    id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    العمليات
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                    <a class="dropdown-item"
                                                        href="{{ route('invoicesDetails.show', $invoice->id) }}">{{ __('main.show') }}</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('invoices.edit', $invoice->id) }}">{{ __('main.edit') }}
                                                    </a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('invoices.show', $invoice->id) }}">{{ __('main.changstat') }}
                                                    </a>
                                                    <form action="{{ route('invoices.destroy', $invoice->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn btn-sm">
                                                            {{ __('main.die') }}</button>

                                                    </form>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
