@extends('layouts.master')
@section('title')
    لوحه التحكم -برنامج الفواتير
@endsection
@section('css')
    @include('inc.css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <div>
                <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">مرحبا بك </h2>
                <p class="mg-b-0">برنامج عرض الفواتير</p>
            </div>
        </div>
        <div class="main-dashboard-header-right">
            <div>
                <label class="tx-13">Customer Ratings</label>
                <div class="main-star">
                    <i class="typcn typcn-star active"></i> <i class="typcn typcn-star active"></i> <i
                        class="typcn typcn-star active"></i> <i class="typcn typcn-star active"></i> <i
                        class="typcn typcn-star"></i> <span>(14,873)</span>
                </div>
            </div>
            <div>
                <label class="tx-13">Online Sales</label>
                <h5>563,275</h5>
            </div>
            <div>
                <label class="tx-13">Offline Sales</label>
                <h5>783,675</h5>
            </div>
        </div>
    </div>
    <!-- /breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    @php
        $invoice = App\Models\Invoice::count();
    @endphp

    <div class="row row-sm">
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-primary-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white"> اجمالى الفواتير</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h3 class="tx-20 font-weight-bold mb-1 text-white">
                                    @if ($invoice != 0)
                                        {{ number_format(App\Models\Invoice::sum('total')) }}
                                </h3>
                                @endif
                                <h6 class="mb-3 tx-12 text-white"> عدد الفواتير : {{ App\Models\Invoice::count() }} </h6>
                            </div>
                            <span class="float-right my-auto mr-auto">
                                <i class="fas fa-arrow-circle-up text-white"></i>
                                <span class="text-white op-7"> 100%</span>
                            </span>
                        </div>
                    </div>
                </div>
                <span id="compositeline" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-success-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h4 class="mb-3 tx-12 text-white">الفواتير المدفوعه </h4>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h3 class="tx-20 font-weight-bold mb-1 text-white">
                                        {{ number_format(App\Models\Invoice::where('id','>',0)->where('status', 1)->sum('total')) }}
                                </h3>
                                <h6 class="mb-3 tx-12 text-white"> عدد الفواتير :
                                    {{ App\Models\Invoice::where('status', 1)->count() }} </h6>
                            </div>
                            <span class="float-right my-auto mr-auto">
                                <i class="fas fa-arrow-circle-down text-white"></i>
                                <span class="text-white op-7">
                                    @if ($invoice != 0)
                                        @php
                                            $all = App\Models\Invoice::where('id','>',0)->count();
                                            $paid = App\Models\Invoice::where('id','>',0)->where('status', 1)->count();
                                            echo round(($paid / $all) * 100, 2) . '%';
                                        @endphp
                                    @endif
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
                <span id="compositeline2" class="pt-1">3,2,4,6,12,14,8,7,14,16,12,7,8,4,3,2,2,5,6,7</span>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-danger-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white"> الفواتير غير المدفوعه</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h3 class="tx-20 font-weight-bold mb-1 text-white">
                                        {{ number_format(App\Models\Invoice::where('id','>',0)->where('status', 2)->sum('total')) }}
                                </h3>
                                <h6 class="mb-3 tx-12 text-white"> عدد الفواتير :
                                        {{ App\Models\Invoice::where('id','>',0)->where('status', 2)->count() }}
                                </h6>
                            </div>
                            <span class="float-right my-auto mr-auto">
                                <i class="fas fa-arrow-circle-up text-white"></i>
                                <span class="text-white op-7">
                                        @php
                                            $unpaid = App\Models\Invoice::where('id','>',0)->where('status', '=', 2)->count();
                                            if($unpaid)
                                            {
                                                echo round(($unpaid / $all) * 100, 2) . '%';
                                            }
                                        @endphp
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
                <span id="compositeline3" class="pt-1">5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-warning-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white"> الفواتير المدفوعه جزئيا</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h3 class="tx-20 font-weight-bold mb-1 text-white">
                                 
                                        {{ number_format(App\Models\Invoice::where('id','>',0)->where('status', 3)->sum('total')) }}
                                </h3>
                               
                                <h6 class="mb-3 tx-12 text-white"> عدد الفواتير :
                                        {{ App\Models\Invoice::where('id','>',0)->where('status', 3)->count() }}
                                </h6>
                            </div>
                            <span class="float-right my-auto mr-auto">
                                <i class="fas fa-arrow-circle-down text-white"></i>

                            </span>
                        </div>
                    </div>
                </div>
                <span id="compositeline4" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
            </div>
        </div>
    </div>

    <!-- row closed -->

    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-md-12 col-lg-12 col-xl-7">
            <div class="card">
                <div class="card-header bg-transparent pd-b-0 pd-t-20 bd-b-0">
                    <div class="d-flex justify-content-between">
                        <h2 class="card-title mb-0">رسم بيانى للعملاء </h2>
                        <div style="width:75%;">
                            @if ($invoice != 0)
                                {!! $chartjs->render() !!}
                            @endif
                        </div>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                </div>
                <div class="card-body">
                    <div style="width:100%;">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-xl-5">
            <div class="card card-dashboard-map-one">
                <label class="main-content-label"> احصائيه الفواتير بالنسبه المئويه</label>
                <div class="">

                    <div style="width:100%;">
                        <div style="width:75%;">
                            @if ($invoice != 0)
                                {!! $chartjs2->render() !!}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->

    <!-- row opened -->

    <!-- row close -->

    <!-- row opened -->

    <!-- /row -->
    </div>
    </div>
    <!-- Container closed -->
@endsection
@section('js')
    @include('inc.js')
@endsection
