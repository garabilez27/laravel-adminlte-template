<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenusController extends Controller
{
    private $prefix = 'sttng';

    public function index()
    {
        return $this->render('index');
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
