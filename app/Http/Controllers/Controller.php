<?php

namespace App\Http\Controllers;

abstract class Controller
{
    protected function getSubMenu($prefix, $page, string $root = '')
    {
        $user = session()->get('user');

        // Menu have no branch
        if(!$user->menus[$prefix]['branched'])
        {
            return '';
        }

        // Existing in sidebar
        if(isset($user->menus[$prefix]['sub'][$root.'.'.$page]))
        {
            return $root.'.'.$page;
        }

        return $root.'.index';
    }
}
