@extends('layouts.admin')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Update User') }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Users</li>
                        <li class="breadcrumb-item active">Update</li>
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
                            <h5 class="">Update User</h5>
                        </div>
{{--                        <p>{{$errors->errors ?? 'N??A'}}</p>--}}
                        <div class="card-body">
                            <form action="{{ route("admin.users.update", [$user->id]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('first_name') ? 'has-error' : '' }}">
                                            <label for="first_name"> First Name*</label>
                                            <input type="text" id="first_name" name="first_name" class="form-control" value="{{ old('first_name', isset($user) ? $user->first_name : '') }}">
                                            @if($errors->has('first_name'))
                                                <p class="help-block">
                                                    {{ $errors->first('first_name') }}
                                                </p>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('last_name') ? 'has-error' : '' }}">
                                            <label for="last_name"> Last Name*</label>
                                            <input type="text" id="last_name" name="last_name" class="form-control" value="{{ old('last_name', isset($user) ? $user->last_name : '') }}">
                                            @if($errors->has('last_name'))
                                                <p class="help-block">
                                                    {{ $errors->first('last_name') }}
                                                </p>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
                                            <label for="username"> Username*</label>
                                            <input type="text" id="username" name="username" class="form-control" value="{{ old('username', isset($user) ? $user->username : '') }}">
                                            @if($errors->has('username'))
                                                <p class="help-block">
                                                    {{ $errors->first('username') }}
                                                </p>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                            <label for="email">Email*</label>
                                            <input type="email" id="email" name="email" class="form-control" value="{{ old('email', isset($user) ? $user->email : '') }}">
                                            @if($errors->has('email'))
                                                <p class="help-block">
                                                    {{ $errors->first('email') }}
                                                </p>
                                            @endif

                                        </div>
                                    </div>
{{--                                    <div class="col-md-4">--}}
{{--                                        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">--}}
{{--                                            <label for="password">Password*</label>--}}
{{--                                            <input type="password" id="password" name="password" class="form-control">--}}
{{--                                            @if($errors->has('password'))--}}
{{--                                                <p class="help-block">--}}
{{--                                                    {{ $errors->first('password') }}--}}
{{--                                                </p>--}}
{{--                                            @endif--}}

{{--                                        </div>--}}
{{--                                    </div>--}}
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('phone_number') ? 'has-error' : '' }}">
                                            <label for="phone_number"> Phone Number*</label>
                                            <input type="text" id="phone_number" name="phone_number" class="form-control" value="{{ old('phone_number', isset($user) ? $user->phone_number : '') }}">
                                            @if($errors->has('phone_number'))
                                                <p class="help-block">
                                                    {{ $errors->first('phone_number') }}
                                                </p>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('roles') ? 'has-error' : '' }}">
                                            <label for="roles">Role*  </label>
                                            <select name="role_id" id="roles" class="form-control">
                                                @foreach($roles as $id => $roles)
                                                    <option value="{{ $id }}" {{ isset($user) && $user->roles->contains($id) ? 'selected' : '' }}>
                                                        {{ $roles }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('role_id'))
                                                <p class="help-block">
                                                    {{ $errors->first('role_id') }}
                                                </p>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('dob') ? 'has-error' : '' }}">
                                            <label for="dob">Date of Birth*</label>
                                            <input type="date" id="dob" name="dob" class="form-control" value="{{ old('dob', isset($user) ? $user->dob : '') }}">
                                            @if($errors->has('dob'))
                                                <p class="help-block">
                                                    {{ $errors->first('dob') }}
                                                </p>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('notes') ? 'has-error' : '' }}">
                                            <label for="notes"> Notes</label>
                                            <input type="text" id="notes" name="notes" class="form-control" value="{{ old('notes', isset($user) ? $user->notes : '') }}">
                                            @if($errors->has('notes'))
                                                <p class="help-block">
                                                    {{ $errors->first('notes') }}
                                                </p>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('ibi_id') ? 'has-error' : '' }}">
                                            <label for="ibi_id"> IBI ID*</label>
                                            <input type="text" id="ibi_id" name="ibi_id" class="form-control" value="{{ old('ibi_id', isset($user) ? $user->ibi_id : '') }}">
                                            @if($errors->has('ibi_id'))
                                                <p class="help-block">
                                                    {{ $errors->first('ibi_id') }}
                                                </p>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('ibi_name') ? 'has-error' : '' }}">
                                            <label for="ibi_name"> IBI Name*</label>
                                            <input type="text" id="ibi_name" name="ibi_name" class="form-control" value="{{ old('ibi_name', isset($user) ? $user->ibi_name : '') }}">
                                            @if($errors->has('ibi_name'))
                                                <p class="help-block">
                                                    {{ $errors->first('ibi_name') }}
                                                </p>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group {{ $errors->has('profile') ? 'has-error' : '' }}">
                                            <label for="profile"> Profile</label>
                                            <input type="file" id="profile" name="profile" class="form-control" >
                                            @if($errors->has('profile'))
                                                <p class="help-block">
                                                    {{ $errors->first('profile') }}
                                                </p>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <img src="{{ old('profile', isset($user) ? asset($user->profile) : asset('user-profile.png')) }}" class="img-circle" height="80" width="80">
                                    </div>
                                </div>

                                <h5 class="my-3 border-bottom ">Address Details</h5>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('address_line1') ? 'has-error' : '' }}">
                                            <label for="address_line1"> Address Line1*</label>
                                            <input type="text" id="address_line1" name="address_line1" class="form-control" value="{{ old('address_line1', isset($user->address) ? $user->address->address_line1 : '') }}">
                                            @if($errors->has('address_line1'))
                                                <p class="help-block">
                                                    {{ $errors->first('address_line1') }}
                                                </p>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('address_line2') ? 'has-error' : '' }}">
                                            <label for="address_line2"> Address Line2</label>
                                            <input type="text" id="address_line2" name="address_line2" class="form-control" value="{{ old('address_line2', isset($user->address) ? $user->address->address_line2 : '') }}">
                                            @if($errors->has('address_line2'))
                                                <p class="help-block">
                                                    {{ $errors->first('address_line2') }}
                                                </p>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('city') ? 'has-error' : '' }}">
                                            <label for="city"> City*</label>
                                            <input type="text" id="city" name="city" class="form-control" value="{{ old('city', isset($user->address) ? $user->address->city : '') }}">
                                            @if($errors->has('city'))
                                                <p class="help-block">
                                                    {{ $errors->first('city') }}
                                                </p>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('state') ? 'has-error' : '' }}">
                                            <label for="state"> State*</label>
                                            <input type="text" id="state" name="state" class="form-control" value="{{ old('state', isset($user->address) ? $user->address->state : '') }}">
                                            @if($errors->has('state'))
                                                <p class="help-block">
                                                    {{ $errors->first('state') }}
                                                </p>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('country') ? 'has-error' : '' }}">
                                            <label for="country"> Country*</label>
                                            <input type="text" id="country" name="country" class="form-control" value="{{ old('country', isset($user->address) ? $user->address->country : '') }}">
                                            @if($errors->has('country'))
                                                <p class="help-block">
                                                    {{ $errors->first('country') }}
                                                </p>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('region') ? 'has-error' : '' }}">
                                            <label for="region"> Region*</label>
                                            <input type="text" id="region" name="region" class="form-control" value="{{ old('region', isset($user->address) ? $user->address->region : '') }}">
                                            @if($errors->has('region'))
                                                <p class="help-block">
                                                    {{ $errors->first('region') }}
                                                </p>
                                            @endif

                                        </div>
                                    </div>
                                </div>

                                <h5 class="my-3 border-bottom">Subscription Details</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('subscription_type_id') ? 'has-error' : '' }}">
                                            <label for="subscription_type_id">Subscription Type*  </label>
                                            <select name="subscription_type_id" id="subscription_type_id" class="form-control">
                                                @foreach($subscriptionTypes as $id => $subscriptionTypes)
                                                    <option value="{{ $id }}" {{  isset($user->subscription) && $user->subscription->subscriptionType->id == $id ? 'selected' : '' }}>
                                                        {{ $subscriptionTypes }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('subscription_type_id'))
                                                <p class="help-block">
                                                    {{ $errors->first('subscription_type_id') }}
                                                </p>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('currency') ? 'has-error' : '' }}">
                                            <label for="currency"> Currency*</label>
                                            <input type="text" id="currency" name="currency" class="form-control" value="{{ old('currency', isset($user->subscription) ? $user->subscription->currency : '') }}">
                                            @if($errors->has('currency'))
                                                <p class="help-block">
                                                    {{ $errors->first('currency') }}
                                                </p>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
                                            <label for="price"> Price*</label>
                                            <input type="number" min="0" id="price" name="price" class="form-control" value="{{ old('price', isset($user->subscription) ? $user->subscription->price : '') }}">
                                            @if($errors->has('price'))
                                                <p class="help-block">
                                                    {{ $errors->first('price') }}
                                                </p>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('start_date') ? 'has-error' : '' }}">
                                            <label for="start_date"> Start Date*</label>
                                            <input type="date" id="start_date" name="start_date" class="form-control" value="{{ old('start_date', isset($user->subscription) ? $user->subscription->start_date : '') }}">
                                            @if($errors->has('start_date'))
                                                <p class="help-block">
                                                    {{ $errors->first('start_date') }}
                                                </p>
                                            @endif

                                        </div>
                                    </div>
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
