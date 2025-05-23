<?php

use Illuminate\Support\Facades\Session;
use App\Models\Pengguna;

class Controller
{

    protected function currentUser()
    {
        $userId = Session::get('user_id');
        if ($userId) {
            return Pengguna::find($userId);
        }
        return null;
    }
}
