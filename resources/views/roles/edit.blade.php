@extends('layouts.master')
@section('css')
    <!--Internal  Font Awesome -->
    <link href="{{ URL::asset('assets/plugins/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <!--Internal  treeview -->
    <link href="{{ URL::asset('assets/plugins/treeview/treeview-rtl.css') }}" rel="stylesheet" type="text/css" />
@section('title')
{{__('main.edit')}} {{__('main.perm')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto"> {{__('main.perm')}}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ 
                {{__('main.edit')}} {{__('main.perm')}}</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>خطا</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<!-- row -->
<div class="row">
    <div class="col-md-12">
        <div class="card mg-b-20">
            <div class="card-body">
                <form action="{{ route('roles.update', $role->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="main-content-label mg-b-5">
                        <div class="form-group">
                            <p>{{__('main.permname')}}</p>
                            <input type="text" class="form-control" id="role_id" name="role_name"
                                value="{{ $role->name }}">
                        </div>
                    </div>
                    <div class="row">
                        <!-- col -->
                        <div class="col-lg-4">
                            <ul id="treeview1">
                                <li><a href="#">{{__('main.perm')}}</a>
                                    <ul>
                                        @foreach ($permissions as $x => $permission)
                                            <li>
                                                {{ $x + 1 }}
                                                @if (in_array($permission->id, $rolePermissions))
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="permission_check" value="{{ $permission->id }}"
                                                            name="permissions[]" checked>
                                                        <label class="form-check-label" for="permission_check">-
                                                            {{ $permission->name }} </label>
                                                    @else
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="permission_check" value="{{ $permission->id }}"
                                                                name="permissions[]">
                                                            <label class="form-check-label" for="permission_check">-
                                                                {{ $permission->name }} </label>
                                                @endif
                                            </li>
                                        @endforeach

                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-main-primary">{{__('main.update')}}</button>
                        </div>
                        <!-- /col -->
                </form>
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
<!-- Internal Treeview js -->
<script src="{{ URL::asset('assets/plugins/treeview/treeview.js') }}"></script>
@endsection
