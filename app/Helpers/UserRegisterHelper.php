<?php

namespace App\Helpers;

use App\Models\Address;
use App\Models\Subscription;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class UserRegisterHelper
{
    public static function register(Request $request){
        $inst = new self();
        $request['uuid'] = Str::random(10);
        $attachment = null;
        $register_at = null;
        if ($request->hasFile('profile')) {
            $file = $request->file('profile');
            $destinationPath = 'profile/'.date('Y/m').'/';
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move($destinationPath, $fileName);
            $attachment = $destinationPath.$fileName;

        }
        if(!$request->register_at){
            $register_at = now();
        }
        else{
            $carbonDate = Carbon::parse($request->register_at);
            $register_at = $carbonDate->toDateTimeString();
        }
        $data = $request->all();
        $data['profile'] = $attachment;
        $data['register_at'] = $register_at;
        $user = User::create($data);
        $user->roles()->sync([$request->role_id]);
        $inst->address($request, $user);
        $inst->subscription($request, $user);

        return $user;


    }


    public static function updateUser(Request $request, $user){
        $inst = new self();
        $data = $request->all();

        if ($request->hasFile('profile')) {
            $file = $request->file('profile');
            $destinationPath = 'profile/'.date('Y/m').'/';
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move($destinationPath, $fileName);
            $attachment = $destinationPath.$fileName;
            $data['profile'] = $attachment;
        }

        $user->update($data);
        $user->roles()->sync([$request->role_id]);
        $inst->address($request, $user);
        $inst->subscription($request, $user);

        return $user;


    }



    public function address($request, $user)
    {
       $data = $request->only(['address_line1','address_line2','city','state','country','region']);
        $user->address()->updateOrCreate(
            ['user_id' => $user->id],
            $data
        );
    }

    public function subscription($request, $user){
        $data = $request->only(['subscription_type_id','currency','price','start_date']);
        $data['next_billing_date'] = '';
        if($request->subscription_type_id == 1)
        {
            $data['next_billing_date'] = Carbon::parse($request->start_date)->addMonth()->toDateString();
        }
        elseif ($request->subscription_type_id == 2)
        {
            $data['next_billing_date'] = Carbon::parse($request->start_date)->addYear()->toDateString();
        }
        $data['uuid'] = $user->uuid;
        $data['subscription_status_id'] = 1;
        $user->subscription()->updateOrCreate(
            ['user_id' => $user->id],
            $data
        );
    }
}
