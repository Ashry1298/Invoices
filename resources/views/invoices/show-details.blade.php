@extends('layouts.master')
@section('css')
    @include('inc.css')
@endsection
@section('title')
    {{ __('main.invdet') }}
@stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto"> {{ __('main.inv') }}</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    {{ __('main.invdet') }}</span>
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
                                            <li><a href="#tab1"class="nav-link active" data-toggle="tab"></i>
                                                    {{ __('main.paymentdata') }} </a></li>
                                            <li><a href="#tab2"class="nav-link " data-toggle="tab"></i>
                                                    {{ __('main.paymentdata') }} </a>
                                            </li>
                                            <li><a href="#tab3"class="nav-link "data-toggle="tab"></i>
                                                    {{ __('main.attachment') }} </a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-body tabs-menu-body main-content-body-right border">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab1">
                                            <div class="table-responsive mt-15">
                                                <table class="table table-striped" style="text-align:center">
                                                    <tbody>
                                                        <th class="border-bottom-0">#</th>


                                                        <tr>
                                                            <th scope="row">{{ __('main.invoiceNum') }}</th>
                                                            <td>{{ $invoice->invoice_number }}</td>
                                                            <th scope="row">{{ __('main.invdate') }}</th>
                                                            <td>{{ $invoice->invoice_date }}</td>
                                                            <th scope="row">{{ __('main.duedate') }} </th>
                                                            <td>{{ $invoice->due_date }}</td>
                                                            <th scope="row">{{ __('main.section') }}</th>
                                                            <td>{{ $invoice->section->section_name }}</td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row">{{ __('main.product') }}</th>
                                                            <td>{{ $invoice->product }}</td>
                                                            <th scope="row">{{ __('main.collection') }} </th>
                                                            <td>{{ $invoice->amount_collection }}</td>
                                                            <th scope="row">{{ __('main.commission') }}</th>
                                                            <td>{{ $invoice->amount_commission }}</td>
                                                            <th scope="row">{{ __('main.discount') }}</th>
                                                            <td>{{ $invoice->discount }}</td>
                                                        </tr>


                                                        <tr>
                                                            <th scope="row">{{ __('main.taxrate') }}</th>
                                                            <td>{{ $invoice->rate_vat }}</td>
                                                            <th scope="row">{{ __('main.taxvat') }}</th>
                                                            <td>{{ $invoice->value_vate }}</td>
                                                            <th scope="row">{{ __('main.tot') }}</th>
                                                            <td>{{ $invoice->total }}</td>
                                                            <th scope="row">{{ __('main.status') }}</th>

                                                            @if ($invoice->status == 1)
                                                                <td> <span class="badge badge-pill badge-success">
                                                                        {{ __('main.paid') }}</span>
                                                                </td>
                                                            @elseif($invoice->status == 2)
                                                                <td> <span
                                                                        class="badge badge-pill badge-danger">{{ __('main.unpaid') }}</span>
                                                                </td>
                                                            @else
                                                                <td> <span
                                                                        class="badge badge-pill badge-info">{{ __('main.partial') }}</span>
                                                                </td>
                                                            @endif

                                                        <tr>
                                                            <th scope="row">{{ __('main.notes') }}</th>
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
                                                            <th class="border-bottom-0">{{ __('main.invoiceNum') }} </th>
                                                            <th>{{ __('main.product') }}</th>
                                                            <th class="border-bottom-0">{{ __('main.section') }}</th>
                                                            <th class="border-bottom-0">{{ __('main.status') }}</th>
                                                            <th>{{ __('main.paymentDate') }}</th>
                                                            <th class="border-bottom-0">{{ __('main.notes') }}</th>
                                                            <th> {{ __('main.invdate') }} </th>
                                                            <th>{{ __('main.user') }}</th>
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
                                                                            {{__("main.paid")}}</span>
                                                                    @elseif($invoice_details->Status == 2)
                                                                        <span
                                                                            class="badge badge-pill badge-danger">{{__("main.unpaid")}}</span>
                                                                    @else
                                                                        <span
                                                                            class="badge badge-pill badge-info">{{__("main.partial")}}</span>
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
                                                            <p class="text-danger">* {{__('main.attachformat')}} </p>
                                                            <h5 class="card-title"> {{__('main.addattach')}}</h5>
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
                                                                    <label class="custom-file-label" for="customFile">
                                                                       {{__('main.chooseattach')}} </label>
                                                                </div><br><br>
                                                                <button type="submit" class="btn btn-primary btn-sm "
                                                                    name="uploadedFile">{{__('main.submit')}}</button>
                                                            </form>
                                                        </div>
                                                    @endcan
                                                    @if ($invoice_attachments != null)
                                                        <div class="table-responsive mt-15">
                                                            <table class="table center-aligned-table mb-0 table table-hover"
                                                                style="text-align:center">
                                                                <thead>
                                                                    <tr class="text-dark">
                                                                        <th scope="col">#</th>
                                                                        <th scope="col"> {{__('main.attachname')}}</th>
                                                                        <th scope="col"> {{__('main.user')}}</th>
                                                                        <th scope="col"> {{__('main.invdate')}}</th>
                                                                        <th scope="col">{{__('main.proc')}}</th>
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
                                                                                        {{__('main.show')}}</a>

                                                                                <a class="btn btn-outline-info btn-sm"
                                                                                    href="{{ route('invoice.download_file', [$invoice->id, $invoice->invoice_number]) }}"
                                                                                    role="button"><i
                                                                                        class="fas fa-download"></i>&nbsp;
                                                                                    {{__('main.download')}}</a>
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
                                                                                            type="submit">{{__('main.die')}}</button>

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
