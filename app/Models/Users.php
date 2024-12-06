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

    public function menus(string $roleID)
    {
        $role_menus = [];
        $menus = RoleMenus::where('rl_id', $roleID)->join('tbl_menus', 'tbl_role_menus.mn_id', 'tbl_menus.mn_id') ->get();
        foreach($menus as $mn)
        {
            $role_sub_menus = [];
            $sub_menus = RoleSubMenus::where('rlmn_id', $mn->rlmn_id)->join('tbl_sub_menus', 'tbl_role_sub_menus.sbmn_id', 'tbl_sub_menus.sbmn_id')->get();
            foreach($sub_menus as $sb)
            {
                $role_sub_menus[$sb->sbmn_reference] = [
                    'detail' => $sb->sbmn_detail,
                    'icon' => $sb->sbmn_icon,
                    'reference' => $sb->sbmn_reference,
                    'menu' => $sb->sbmn_menu,
                    'class' => $sb->sbmn_class,
                    'can' => [
                        'create' => $sb->sbmn_create,
                        'update' => $sb->sbmn_update,
                        'destroy' => $sb->sbmn_destroy,
                        'view' => $sb->sbmn_view,
                    ],
                ];
            }

            $role_menus[$mn->mn_prefix] = [
                'detail' => $mn->mn_detail,
                'icon' => $mn->mn_icon,
                'reference' => $mn->mn_reference,
                'branched' => $mn->mn_branched,
                'sub' => $role_sub_menus,
            ];
        }

        return $role_menus;
    }
}
