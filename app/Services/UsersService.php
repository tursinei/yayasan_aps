<?php

namespace App\Services;

use App\Http\Requests\StoreUsersRequest;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;

class UsersService
{

    public function listUser(){
        $return = Users::select('id','name','email','created_at','peran')->paginate(5);
        $ubah = $return->getCollection()->map(function($item){
            $item['peran'] = ucfirst(Users::getPeran($item['peran']));
            $item['created_at'] = date('d-m-Y',strtotime($item['created_at']));
            return $item;
        });
        $return->setCollection($ubah);
        return $return;
    }

    public function simpan(StoreUsersRequest $request)
    {
        $data = $request->validated();
        if(!empty($data['password'])){
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }
        return Users::updateOrCreate(['id' => $request->input('id')], $data);
    }

    public function changePass(ChangePasswordRequest $request)
    {
        $data = $request->validated();
        $user = User::find($data['id']);
        $user->password = Hash::make($data['password']);
        return $user->save();
    }

}
