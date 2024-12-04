<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tbl_sub_menus')->insert([
            [
                'sbmn_id' => 'SBMN00001',
                'sbmn_detail' => 'Dashboard',
                'sbmn_reference' => 'dashboard',
                'sbmn_icon' => 'fa-home',
                'mn_id' => 'MN00002',
            ],
            [
                'sbmn_id' => 'SBMN00002',
                'sbmn_detail' => 'Settings',
                'sbmn_reference' => 'settings',
                'sbmn_icon' => 'fa-cogs',
                'mn_id' => 'MN00002',
            ],
        ]);
    }
}
