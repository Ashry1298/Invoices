@extends('layouts.master')
@section('css')
    @include('inc.css')
@endsection
@section('title')
   {{__('main.products')}}
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto"> {{__('main.controllPanel')}}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    {{__('main.products')}}</span>
            </div>
        </div> 
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @include('inc.error')

    <!-- row -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    @can('اضافة منتج')
                        <div class="d-flex justify-content-between">
                            <a class="btn btn-primary" href="{{ route('products.create') }}" role="button"> {{__('main.addproduct')}}</a>
                        </div>
                    @endcan
                </div>
               
                <div class="card-body">
                  
                    <div class="table-responsive">
                        <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50'>
                            <thead>

                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">{{__('main.productname')}}</th>
                                    <th class="border-bottom-0">{{__('main.sectinname')}}</th>
                                    <th class="border-bottom-0">{{__('main.desc')}}</th>
                                    <th class="border-bottom-0">{{__('main.proc')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $x => $product)
                                    <tr>
                                        <td> {{ $x + 1 }} </td>
                                        <td> {{ $product->product_name }}</td>
                                        <td> {{ $product->section->section_name }}</td>
                                        <td> {{ $product->description }}</td>
                                        <td>
                                            @can('تعديل منتج')
                                                <a class="btn btn-info" href="{{ route('products.edit', $product->id) }}"
                                                    role="button">{{__('main.edit')}} </a>
                                            @endcan
                                            @can('حذف منتج')
                                                <x-delete_btn url="{{ route('products.destroy', $product->id) }}"
                                                    item="{{ $product->id }}"></x-delete_btn>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @section('js')
        @include('inc.js')
    @endsection
