<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private $prefix = 'dshbrd';

    public function index()
    {
        return $this->render('index');
    }

    private function render(string $page, array $records = [])
    {
        $data = [
            's_menu' => $this->prefix,
            's_submenu' => $page == 'index' ? '' : $this->prefix.'.'.$page,
            'records' => $records,
        ];

        return view('pages.'.$page, $data);
    }
}
