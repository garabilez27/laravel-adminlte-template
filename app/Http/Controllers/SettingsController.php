<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    private $prefix = 'sttng';

    public function index()
    {
        return $this->render('display');
    }

    private function render(string $page, array $records = [])
    {
        $data = [
            's_menu' => $this->prefix,
            's_submenu' => '',
            'records' => $records,
        ];

        return view('pages.'.$page, $data);
    }
}
