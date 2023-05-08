@extends('layouts.master')
@section('css')
    @include('inc.css')
@endsection
@section('title')
    {{$section->section_name}}  
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الاعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    الاقسام</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @include('inc.error')

    <form method="POST" action="{{ route('sections.update', $section->id) }}">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="exampleInputEmail1">اسم القسم</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                value="{{ $section->section_name }}" name="section_name">
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">الوصف</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description">{{ $section->description }}</textarea>
        </div>
        <div>
            <button type="submit" class="btn btn-primary">تأكيد</button>
        </div>
    </form>
@endsection
@section('js')
    @include('inc.js')
@endsection
