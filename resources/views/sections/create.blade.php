@extends('layouts.master')
@section('css')
    @include('inc.css')
@endsection

@section('title')
  {{__('main.addsection')}}
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto"> {{__('main.addsection')}}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    {{__('main.enterdata')}}</span>
            </div>
        </div> 
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @include('inc.error')

    <form method="POST" action="{{ route('sections.store') }}">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1"> {{__('main.sectinname')}}</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" autocomplete="off"
                name="section_name" value="{{old('section_name')}}">
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">{{__('main.desc')}}</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description">{{old('description')}}</textarea>
        </div>
        <div>
            <button type="submit" class="btn btn-primary">{{__('main.submit')}}</button>
        </div>
    </form>
@endsection
@section('js')
    @include('inc.js')
@endsection
