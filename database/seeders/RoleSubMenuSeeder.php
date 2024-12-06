<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSubMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tbl_role_sub_menus')->insert([
            [
                'rlmn_id' => '2',
                'sbmn_id' => 'SBMN00001',
            ],
            [
                'rlmn_id' => '2',
                'sbmn_id' => 'SBMN00002',
            ],
            [
                'rlmn_id' => '2',
                'sbmn_id' => 'SBMN00003',
            ],
        ]);
    }
}
