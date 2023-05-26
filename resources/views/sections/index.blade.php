@extends('layouts.master')
@section('css')
    @include('inc.css')
@endsection
@section('title')
  {{__('main.sections')}}
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{__('main.controllPanel')}}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    {{__('main.sections')}}</span>
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
                    @can('اضافة قسم')
                        <div class="d-flex justify-content-between">
                            <a class="btn btn-primary" href="{{ route('sections.create') }}" role="button">  {{__('main.addsection')}}</a>
                        </div>
                    @endcan
                 
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table key-buttons text-md-nowrap">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">{{__('main.sectinname')}} </th>
                                    <th class="border-bottom-0">{{__('main.desc')}}</th>
                                    <th class="border-bottom-0">{{__('main.proc')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sections as $x => $section)
                                    <tr>
                                        <td>{{ $x + 1 }}</td>
                                        <td>{{ $section->section_name }}</td>
                                        <td>
                                            @if ($section->description == null)
                                                {{ 'لا يوجد وصف لهذا القسم' }}
                                            @endif
                                            {{ $section->description }}
                                        </td>
                                        <td>
                                            @can('تعديل قسم')
                                                <a class="btn btn-info" href="{{ route('sections.edit', $section->id) }}"
                                                    role="button">{{__('main.edit')}} </a>
                                            @endcan
                                            @can('حذف قسم')
                                                <x-delete_btn url="{{ route('sections.destroy', $section->id) }}"
                                                    item="{{ $section->id }}"></x-delete_btn>
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
