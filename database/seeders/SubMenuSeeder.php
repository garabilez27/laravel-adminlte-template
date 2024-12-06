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
                'sbmn_detail' => 'Menus',
                'sbmn_reference' => 'mn.index',
                'sbmn_icon' => 'fa-bars',
                'sbmn_create' => 1,
                'sbmn_update' => 1,
                'sbmn_destroy' => 1,
                'sbmn_view' => 1,
                'mn_id' => 'MN00002',
            ],
            [
                'sbmn_id' => 'SBMN00002',
                'sbmn_detail' => 'Sub Menus',
                'sbmn_reference' => 'sbmn.index',
                'sbmn_icon' => 'fa-code-branch',
                'sbmn_create' => 1,
                'sbmn_update' => 1,
                'sbmn_destroy' => 1,
                'sbmn_view' => 1,
                'mn_id' => 'MN00002',
            ],
            [
                'sbmn_id' => 'SBMN00003',
                'sbmn_detail' => 'Roles',
                'sbmn_reference' => 'rl.index',
                'sbmn_icon' => 'fa-user-tag',
                'sbmn_create' => 1,
                'sbmn_update' => 1,
                'sbmn_destroy' => 1,
                'sbmn_view' => 1,
                'mn_id' => 'MN00002',
            ],
        ]);
    }
}
