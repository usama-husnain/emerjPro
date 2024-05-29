@extends('layouts.admin')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Create Role') }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Roles</li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-header">
                            Create Role
                        </div>

                        <div class="card-body">
                            <form action="{{ route("admin.roles.store") }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                    <label for="title">Name*</label>
                                    <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($role) ? $role->name : '') }}">
                                    @if($errors->has('name'))
                                        <p class="help-block">
                                            {{ $errors->first('name') }}
                                        </p>
                                    @endif

                                </div>
                                <div class="form-group {{ $errors->has('permissions') ? 'has-error' : '' }}">
                                    <label for="permissions">Permissions*
                                        <span class="btn btn-pro btn-xs select-all">Select all</span>
                                        <span class="btn btn-pro btn-xs deselect-all">Deselect all</span>
                                    </label>
                                    <select name="permissions[]" id="permissions" class="form-control select2" multiple="multiple">
                                        @foreach($permissions as $id => $permissions)
                                            <option value="{{ $id }}" {{ (in_array($id, old('permissions', [])) || isset($role) && $role->permissions->contains($id)) ? 'selected' : '' }}>
                                                {{ $permissions }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('permissions'))
                                        <p class="help-block">
                                            {{ $errors->first('permissions') }}
                                        </p>
                                    @endif

                                </div>
                                <div>
                                    <input class="btn btn-pro" type="submit" value="Save">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
