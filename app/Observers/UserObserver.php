<?php

namespace App\Observers;

use App\Events\UserCreated;
use App\Models\TMP;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserObserver
{
    public function created(User $user){

        $user->password = Hash::make($user['password']);
        $user->save();
         event(new UserCreated($user));
//        $tmp = new TMP();
//        $tmp->title = "OBSERVER";
//        $tmp->data =  $user->email.":::".$user->password;
//        $tmp->save();
    }
}
