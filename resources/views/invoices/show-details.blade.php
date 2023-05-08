@extends('layouts.master')
@section('css')
    @include('inc.css')
@endsection
@section('title')
    تفاصيل فاتورة
@stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">قائمة الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    تفاصيل الفاتورة</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @include('inc.error-notify')

    <!-- row opened -->
    <div class="row row-sm">

        <div class="col-xl-12">
            <!-- div -->
            <div class="card mg-b-20" id="tabs-style2">
                <div class="card-body">
                    <div class="text-wrap">
                        <div class="example">
                            <div class="panel panel-primary tabs-style-3">
                                <div class="tab-menu-heading">
                                    <div class="tabs-menu ">
                                        <!-- Tabs -->
                                        <ul class="nav panel-tabs">
                                            <li><a href="#tab1"class="nav-link active" data-toggle="tab"></i> معلومات
                                                    الدفع </a></li>
                                            <li><a href="#tab2"class="nav-link " data-toggle="tab"></i> حالات الدفع</a>
                                            </li>
                                            <li><a href="#tab3"class="nav-link "data-toggle="tab"></i> المرفقات </a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-body tabs-menu-body main-content-body-right border">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab1">
                                            <div class="table-responsive mt-15">
                                                <table class="table table-striped" style="text-align:center">
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row">رقم الفاتورة</th>
                                                            <td>{{ $invoice->invoice_number }}</td>
                                                            <th scope="row">تاريخ الاصدار</th>
                                                            <td>{{ $invoice->invoice_date }}</td>
                                                            <th scope="row">تاريخ الاستحقاق</th>
                                                            <td>{{ $invoice->due_date }}</td>
                                                            <th scope="row">القسم</th>
                                                            <td>{{ $invoice->section->section_name }}</td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row">المنتج</th>
                                                            <td>{{ $invoice->product }}</td>
                                                            <th scope="row">مبلغ التحصيل</th>
                                                            <td>{{ $invoice->amount_collection }}</td>
                                                            <th scope="row">مبلغ العمولة</th>
                                                            <td>{{ $invoice->amount_commission }}</td>
                                                            <th scope="row">الخصم</th>
                                                            <td>{{ $invoice->discount }}</td>
                                                        </tr>


                                                        <tr>
                                                            <th scope="row">نسبة الضريبة</th>
                                                            <td>{{ $invoice->rate_vat }}</td>
                                                            <th scope="row">قيمة الضريبة</th>
                                                            <td>{{ $invoice->value_vate }}</td>
                                                            <th scope="row">الاجمالي مع الضريبة</th>
                                                            <td>{{ $invoice->total }}</td>
                                                            <th scope="row">الحالة الحالية</th>

                                                            @if ($invoice->status == 1)
                                                                <td> <span class="badge badge-pill badge-success">
                                                                        {{ 'مدفوعه' }}</span>
                                                                </td>
                                                            @elseif($invoice->status == 2)
                                                                <td> <span
                                                                        class="badge badge-pill badge-danger">{{ 'غير مدفوعه' }}</span>
                                                                </td>
                                                            @else
                                                                <td> <span
                                                                        class="badge badge-pill badge-info">{{ ' مدفوعه جزئيا' }}</span>
                                                                </td>
                                                            @endif

                                                        <tr>
                                                            <th scope="row">ملاحظات</th>
                                                            <td>{{ $invoice->note }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>

                                        <div class="tab-pane" id="tab2">
                                            <div class="table-responsive mt-15">
                                                <table class="table center-aligned-table mb-0 table-hover"
                                                    style="text-align:center">
                                                    <thead>


                                                        <tr class="text-dark">
                                                            <th>#</th>
                                                            <th>رقم الفاتورة</th>
                                                            <th>نوع المنتج</th>
                                                            <th>القسم</th>
                                                            <th>حالة الدفع</th>
                                                            <th>تاريخ الدفع </th>
                                                            <th>ملاحظات</th>
                                                            <th>تاريخ الاضافة </th>
                                                            <th>المستخدم</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($invoices_details as $x => $invoice_details)
                                                            <tr>
                                                                <td>{{ $x + 1 }}</td>
                                                                <td>{{ $invoice_details->invoice_number }}</td>
                                                                <td>{{ $invoice_details->product }}</td>
                                                                <td>{{ $invoice->section->section_name }}</td>
                                                                <td>
                                                                    @if ($invoice_details->Status == 1)
                                                                        <span class="badge badge-pill badge-success">
                                                                            {{ 'مدفوعه' }}</span>
                                                                    @elseif($invoice_details->Status == 2)
                                                                        <span
                                                                            class="badge badge-pill badge-danger">{{ 'غير مدفوعه' }}</span>
                                                                    @else
                                                                        <span
                                                                            class="badge badge-pill badge-info">{{ ' مدفوعه جزئيا' }}</span>
                                                                </td>
                                                        @endif
                                                        </td>
                                                        <td>{{ $invoice_details->payment_date }}</td>
                                                        <td>{{ $invoice_details->note }}</td>
                                                        <td>{{ $invoice_details->created_at }}</td>
                                                        <td>{{ $invoice_details->user }}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>


                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab3">
                                            <div class="table-responsive mt-15">
                                                <div class="card card-statistics">
                                                    @can('اضافة مرفق')
                                                        <div class="card-body">
                                                            <p class="text-danger">* صيغة المرفق pdf, jpeg ,.jpg , png </p>
                                                            <h5 class="card-title">اضافة مرفقات</h5>
                                                            <form method="post"
                                                                action="{{ route('invoices.addAttachment', $invoice->id) }}"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PATCH')
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input"
                                                                        id="customFile" name="file" required>
                                                                    <input type="text" class="form-control" id="inputName"
                                                                        name="invoice_number"
                                                                        value="{{ $invoice->invoice_number }}" hidden>
                                                                    <label class="custom-file-label" for="customFile">حدد
                                                                        المرفق</label>
                                                                </div><br><br>
                                                                <button type="submit" class="btn btn-primary btn-sm "
                                                                    name="uploadedFile">تاكيد</button>
                                                            </form>
                                                        </div>
                                                    @endcan
                                                    @if ($invoice_attachments != null)
                                                        <div class="table-responsive mt-15">
                                                            <table class="table center-aligned-table mb-0 table table-hover"
                                                                style="text-align:center">
                                                                <thead>
                                                                    <tr class="text-dark">
                                                                        <th scope="col">م</th>
                                                                        <th scope="col">اسم الملف</th>
                                                                        <th scope="col">قام بالاضافة</th>
                                                                        <th scope="col">تاريخ الاضافة</th>
                                                                        <th scope="col">العمليات</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($invoice_attachments as $x => $invoice_attachment)
                                                                        <tr>

                                                                            <td>{{ $x + 1 }}</td>
                                                                            <td>{{ $invoice_attachment->file_name }}</td>
                                                                            <td>{{ $invoice_attachment->created_by }}</td>
                                                                            <td>{{ $invoice_attachment->created_at }}</td>
                                                                            <td colspan="2">
                                                                                <a class="btn btn-outline-success btn-sm"
                                                                                    href="{{ route('invoice.get_file', [$invoice->id, $invoice->invoice_number]) }}"
                                                                                    role="button"><i
                                                                                        class="fas fa-eye"></i>&nbsp;
                                                                                    عرض</a>

                                                                                <a class="btn btn-outline-info btn-sm"
                                                                                    href="{{ route('invoice.download_file', [$invoice->id, $invoice->invoice_number]) }}"
                                                                                    role="button"><i
                                                                                        class="fas fa-download"></i>&nbsp;
                                                                                    تحميل</a>
                                                                                @can('حذف المرفق')
                                                                                    <form
                                                                                        action="{{ route('invoicesDetails.destroy', $invoice->id) }}"
                                                                                        method="POST">
                                                                                        @csrf
                                                                                        @method('DELETE')
                                                                                        <input type="text"
                                                                                            class="form-control"
                                                                                            id="inputName" name="file_name"
                                                                                            value="{{ $invoice_attachment->file_name }}"
                                                                                            hidden>
                                                                                        <input type="text"
                                                                                            class="form-control"
                                                                                            id="inputName"
                                                                                            name="invoice_number"
                                                                                            value="{{ $invoice->invoice_number }}"
                                                                                            hidden>
                                                                                        <button class="btn btn-danger"
                                                                                            type="submit">حذف</button>

                                                                                    </form>
                                                                                @endcan

                                                                            </td>
                                                                        </tr>
                                                                    @endforeach

                                                                </tbody>
                                                                </tbody>
                                                            </table>

                                                        </div>
                                                    @endif
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- /div -->
                                </div>

                            </div>
                            <!-- /row -->

                            <!-- delete -->

                        </div>
                        <!-- Container closed -->
                    </div>
                    <!-- main-content closed -->
                @endsection
                @section('js')
                    @include('inc.js')
                @endsection
