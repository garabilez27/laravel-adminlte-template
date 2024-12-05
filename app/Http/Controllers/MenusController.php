<?php

namespace App\Http\Controllers;

use App\Models\Menus;
use Illuminate\Http\Request;

class MenusController extends Controller
{
    private $prefix = 'sttng';

    public function index()
    {
        $menus = Menus::where('mn_deleted', 0)->where('mn_active', 1)->get();
        return $this->render('index', $menus);
    }

    public function add()
    {
        return $this->render('add');
    }

    private function render($page, $records = [])
    {
        $data = [
            's_menu' => $this->prefix,
            's_submenu' => $this->getSubMenu($this->prefix, $page, 'mn'),
            'records' => $records,
        ];

        return view('pages.menus.'.$page, $data);
    }
}
