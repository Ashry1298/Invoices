@extends('layouts.master')
@section('css')
    @include('inc.css')
@endsection

@section('title')
    اضافه منتج
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">اضافه منتج</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    يرجى ادخال البيانات</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @include('inc.error')
    <form method="POST" action="{{ route('products.store') }}">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">اسم المنتج</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
            autocomplete="off" value="{{old('product_name')}}"  name="product_name"> 
        </div>
    
        <div class="form-group">
            <label for="exampleFormControlSelect1">اسم القسم </label>
            <select class="form-control" id="exampleFormControlSelect1" name="section_id">
                <option selected disabled>{{'حدد قسم'}}</option>
                @foreach ($sections as $section)
                    <option value="{{ $section->id }}">{{ $section->section_name }}</option>
                @endforeach
            </select>
        </div>
    
        <div class="form-group">
            <label for="exampleFormControlTextarea1">الوصف</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description">{{old('description')}}</textarea>
        </div>
        <div>
            <button type="submit" class="btn btn-primary">تأكيد</button>
        </div>
    </form>
@endsection
@section('js')
    @include('inc.js')
@endsection
