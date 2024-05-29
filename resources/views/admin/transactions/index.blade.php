@extends('layouts.admin')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Transactions') }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Transactions</li>
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
                    @can('transaction_create')
                        <div style="margin-bottom: 10px;" class="row">
                            <div class="col-lg-12">
                                <a class="btn btn-pro" href="{{  route("admin.transactions.create") }}">
                                    Create Transaction
                                </a>
                            </div>
                        </div>
                    @endcan
                    <div class="card">
                        <div class="card-header">
                            Role List
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class=" table table-bordered table-striped table-hover datatable">
                                    <thead>
                                    <tr>
                                        <th>Sr.#</th>
                                        <th>User</th>
                                        <th>Transaction Type</th>
                                        <th>Payment Method</th>
                                        <th>Transaction Reference</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                       @can('transaction_create') <th>Action</th>@endcan
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($transactions as $key => $transaction)
                                        <tr>
                                            <td>{{ $key+1 ?? ''}}</td>
                                            <td>{{ $transaction->user->username ?? ''}}</td>
                                            <td>{{ $transaction->transactionType->name ?? ''}}</td>
                                            <td>
                                                {{ $transaction->paymentMethod->name ?? '' }}
                                            </td>
                                            <td>{{ $transaction->transaction_ref ?? ''}}</td>
                                            <td>{{ $transaction->amount ?? ''}} {{ $transaction->currency ?? ''}}</td>
                                            <td>
                                                <span class="badge badge-pro">{{ $transaction->status ? 'True' : 'False'}} </span>
                                            </td>
                                            @can('transaction_create')
                                            <td>
                                                <div class="dropdown text-center">
                                                    <a class="link-pro" data-toggle="dropdown" href="#">
                                                        <i class="fas fa-cog"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item" href="{{ route('admin.transactions.show', $transaction->id) }}">
                                                                View
                                                            </a>
                                                            <a class="dropdown-item"  href="{{ route('admin.transactions.edit', $transaction->id) }}">
                                                                Edit
                                                            </a>

                                                            <form action="{{ route('admin.transactions.destroy', $transaction->id) }}" class="dropdown-item" method="POST" onsubmit="return confirm('{{ "Are you sure? You want to delete this record." }}');" style="display: inline-block;">
                                                                <input type="hidden" name="_method" value="DELETE">
                                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                <input type="submit" class="btn btn-block btn-link text-dark text-left p-0" value="Delete">
                                                            </form>
                                                    </div>
                                                </div>

                                            </td>
                                            @endcan
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
