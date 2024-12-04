<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        return $this->render('settings');
    }

    private function render(string $page, array $records = [])
    {
        $data = [
            's_menu' => 'sttng',
            's_submenu' => '',
            'records' => $records,
        ];

        return view('pages.'.$page, $data);
    }
}
