<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Users extends Model
{
    protected $table = 'tbl_users';
    protected $primaryKey = 'usr_id';
    public $timestamps = false;
    public $incrementing = false;

    protected static function authenticate($credentials = [])
    {
        $user = self::where('usr_email', $credentials['email'])->where('usr_active', 1)->where('usr_deleted', 0)->first();
        if(!$user || !Hash::check($credentials['password'], $user->usr_password))
        {
            return null;
        }

        return $user;
    }
}
