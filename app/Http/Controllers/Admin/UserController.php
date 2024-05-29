<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\UserRegisterHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateUserRequest;
use App\Models\SubscriptionType;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('roles')->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all()->pluck('name', 'id');
        $subscriptionTypes = SubscriptionType::all()->pluck('name', 'id');
        return view('admin.users.create', compact('roles','subscriptionTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateUserRequest $request)
    {
        $request['register_ip'] = $request->ip();
        $request['register_device'] = $request->userAgent();
        $request['password'] = bcrypt($request->password);
        $user = UserRegisterHelper::register($request);

        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all()->pluck('name', 'id');
        $subscriptionTypes = SubscriptionType::all()->pluck('name', 'id');
        return view('admin.users.edit', compact('roles','subscriptionTypes', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $user = UserRegisterHelper::updateUser($request, $user);

        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return back();
    }
}
