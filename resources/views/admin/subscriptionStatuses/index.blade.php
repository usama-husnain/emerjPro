@extends('layouts.admin')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Subscription Status Management') }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Subscription Status</li>
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
                    @can('user_create')
                        <div style="margin-bottom: 10px;" class="row">
                            <div class="col-lg-12">
                                <a class="btn btn-pro" href="{{  route("admin.subscriptionStatuses.create") }}">
                                    Create Subscription Status
                                </a>
                            </div>
                        </div>
                    @endcan
                    <div class="card">
                        <div class="card-header">
                            Subscription Status List
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class=" table table-bordered table-striped table-hover datatable">
                                    <thead>
                                    <tr>
                                        <th>Sr.#</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($subscriptionStatuses as $key => $subscriptionStatus)
                                        <tr>
                                            <td>{{ $key+1 ?? ''}}</td>
                                            <td>{{ $subscriptionStatus->name ?? ''}}</td>
                                            <td>
                                                <div class="dropdown text-center">
                                                    <a class="link-pro" data-toggle="dropdown" href="#">
                                                        <i class="fas fa-cog"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        @can('role_edit')
                                                            <a class="dropdown-item" href="{{ route('admin.subscriptionStatuses.show', $subscriptionStatus->id) }}">
                                                                View
                                                            </a>
                                                        @endcan
                                                        @can('role_edit')
                                                            <a class="dropdown-item"  href="{{ route('admin.subscriptionStatuses.edit', $subscriptionStatus->id) }}">
                                                                Edit
                                                            </a>
                                                        @endcan
                                                        @can('role_delete')

                                                            <form action="{{ route('admin.subscriptionStatuses.destroy', $subscriptionStatus->id) }}" class="dropdown-item" method="POST" onsubmit="return confirm('{{ "Are you sure? You want to delete this record." }}');" style="display: inline-block;">
                                                                <input type="hidden" name="_method" value="DELETE">
                                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                <input type="submit" class="btn btn-block btn-link text-dark text-left p-0" value="Delete">
                                                            </form>
                                                        @endcan

                                                    </div>
                                                </div>

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
        </div>
    </div>
@endsection
