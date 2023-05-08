@extends('layouts.master')
@section('title')
    الفواتير غير المدفوعه
@stop
@section('css')
    @include('inc.css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الفواتير
                    غير المدفوعة
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
                                    <th class="border-bottom-0">رقم الفاتورة</th>
                                    <th class="border-bottom-0">تاريخ القاتورة</th>
                                    <th class="border-bottom-0">تاريخ الاستحقاق</th>
                                    <th class="border-bottom-0">القسم</th>
                                    <th class="border-bottom-0">المنتج</th>
                                    <th class="border-bottom-0">مبلغ العموله</th>
                                    <th class="border-bottom-0">الخصم</th>
                                    <th class="border-bottom-0">نسبة الضريبة</th>
                                    <th class="border-bottom-0">قيمة الضريبة</th>
                                    <th class="border-bottom-0">الاجمالي</th>
                                    <th class="border-bottom-0">ملاحظات</th>
                                    <th class="border-bottom-0">العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($unPaidInvoices as $x => $invoice)
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
                                                        href="{{ route('invoicesDetails.show', $invoice->id) }}">عرض</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('invoices.edit', $invoice->id) }}">تعديل </a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('invoices.show', $invoice->id) }}">تغيير حاله الدفع </a>
                                                    <form action="{{route('invoices.destroy',$invoice->id)}}"
                                                        method="POST" >
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn btn-sm">حذف
                                                            الفاتوره</button>

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
