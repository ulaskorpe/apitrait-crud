<?php

namespace App\Observers;

use App\Models\TMP;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserObserver
{
    public function created(User $user){
        $tmp = new TMP();
        $tmp->title = $user->password;
        $tmp->data = Hash::make($user['password']);
        $tmp->save();
        $user->password = Hash::make($user['password']);
        $user->save();

    }
}
