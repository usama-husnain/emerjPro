@extends('layouts.admin')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('User View') }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Users</li>
                        <li class="breadcrumb-item active">View</li>
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
                            User View
                        </div>

                        <div class="card-body">
                            <div class="card mb-3" >
                                <div class="row no-gutters">
                                    <div class="col-md-2">
                                        <img src="{{asset($user->profile ?? 'user-profile.png')}}" class="card-img h-100" alt="{{$user->username ?? ''}}">
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card-body">
                                            <h4 class="font-weight-bold m-0">
                                                {{$user->first_name ?? ''}} {{$user->last_name ?? ''}}
                                                <small class="text-sm">({{$user->uuid ?? 'N/A'}})</small>
                                            </h4>
                                            <p class="card-text text-right m-0"><small class="text-muted">Last Login: {{$user->last_login ?? 'N/A'}}</small></p>
                                            <p class="card-text m-0">
                                            <span class="fas fa-envelope pr-2"></span>
                                                {{$user->email ?? ''}}
                                            </p>
                                            @if($user->address)
                                            <p class="card-text m-0">
                                                <span class="fas fa-map-marker-alt pr-2"></span>
                                                {{$user->address->address_line1 ? $user->address->address_line1.',' : ''}}
                                                {{$user->address->address_line2 ? $user->address->address_line2.',' : ''}}
                                                {{$user->address->city ? $user->address->city.',' : ''}}
                                                {{$user->address->state ? $user->address->state.',' : ''}}
                                                {{$user->address->country ? $user->address->country.',' : ''}}
                                                {{$user->address->region ? $user->address->region : ''}}
                                            </p>
                                            @endif
                                            <p class="card-text m-0">
                                                <span class="fas fa-calendar-alt pr-2"></span>
                                                {{$user->dob ?? 'N/A'}}
                                            </p>
                                            <p class="card-text m-0">
                                                <span class="fas fa-phone-alt pr-2"></span>
                                                {{$user->phone_number ?? 'N/A'}}
                                            </p>
                                            <hr>
                                            <h5 class="font-weight-bold"> IBI Information </h5>
                                            <p class="card-text m-0">
                                                <span class="fas fa-info-circle pr-2"></span>
                                                {{$user->ibi_name ?? ''}} <small class="text-sm">  ({{$user->ibi_id ?? 'N/A'}})</small>
                                            </p>


                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        @if($user->subscription)
                                        <div class="card-body">
                                            <h5 class="font-weight-bold"> Subscription
                                                <small class="text-sm">{{$user->subscription->subscriptionStatus->name ? '(' .$user->subscription->subscriptionStatus->name. ')' : '' }}</small>
                                            </h5>
                                            <p class="card-text mt-3 mb-0">
                                                <span class="font-weight-bold pr-2">Type:</span>
                                                {{$user->subscription->subscriptionType->name ?? ''}}
                                            </p>
                                            <p class="card-text m-0">
                                                <span class="font-weight-bold pr-2">Price:</span>
                                                {{$user->subscription->price ?? ''}} {{$user->subscription->currency ?? ''}}
                                            </p>
                                            <p class="card-text m-0">
                                                <span class="font-weight-bold pr-2">Start Date:</span>
                                                {{$user->subscription->start_date ?? ''}}
                                            </p>
                                            <p class="card-text m-0">
                                                <span class="font-weight-bold pr-2">Next Billing Date:</span>
                                                {{$user->subscription->next_billing_date ?? ''}}
                                            </p>

                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
