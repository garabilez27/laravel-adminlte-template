<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubMenus extends Model
{
    protected $table = 'tbl_sub_menus';
    protected $primaryKey = 'sbmn_id';
    public $timestamps = false;
    public $incrementing = false;
}
