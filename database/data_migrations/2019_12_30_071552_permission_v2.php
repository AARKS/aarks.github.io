<?php

use Illuminate\Database\Migrations\Migration;

class PermissionV2 extends Migration
{
    /**
     * Run the data migrations.
     *
     * @return void
     */
    public function up()
    {
        $permission = [
            [ 'name' => 'admin.master-chart.additional-category.delete','guard_name' => 'admin' ],
            [ 'name' => 'admin.bs_import.index','guard_name' => 'admin' ],
            [ 'name' => 'admin.bs_import.create','guard_name' => 'admin' ],
            [ 'name' => 'admin.bs_import.edit','guard_name' => 'admin' ],
            [ 'name' => 'admin.bs_import.import','guard_name' => 'admin' ]
        ];
        \Spatie\Permission\Models\Permission::insert($permission);
    }

    /**
     * Reverse the data migrations.
     *
     * @return void
     */
    public function down()
    {
        \Spatie\Permission\Models\Permission::where('name','admin.master-chart.additional-category.delete')->delete();
        \Spatie\Permission\Models\Permission::where('name','like','%admin.bs_import%')->delete();
    }
}
