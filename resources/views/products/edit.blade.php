@extends('layouts.master')
@section('css')
    @include('inc.css')
@endsection
@section('title')
    تعديل منتج
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الاعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    المنتجات</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @include('inc.error')

    <form method="POST" action="{{route('products.update',$product->id)}}">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="exampleInputEmail1">اسم المنتج</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                value="{{ $product->product_name }}" name="product_name">
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect1">اسم القسم </label>
            <select class="form-control" id="exampleFormControlSelect1" name="section_id">
                <option value="{{ $product->section_id }}">{{ $product->section['section_name'] }}</option>
                @foreach ($sections as $section)
                    @if ($section->id != $product->section_id)
                        <option value="{{ $section->id }}">{{ $section->section_name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">الوصف</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description">{{ $product->description }}</textarea>
        </div>
        <div>
            <button type="submit" class="btn btn-primary">تأكيد</button>
        </div>
    </form>
@endsection
@section('js')
    @include('inc.js')
@endsection
