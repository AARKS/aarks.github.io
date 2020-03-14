<?php

use Illuminate\Database\Migrations\Migration;

class BankStatementInputPermission extends Migration
{
    /**
     * Run the data migrations.
     *
     * @return void
     */
    public function up()
    {
        $permission = [
            [ 'name' => 'admin.bs_input.index','guard_name' => 'admin' ],
            [ 'name' => 'admin.bs_input.create','guard_name' => 'admin' ],
            [ 'name' => 'admin.bs_input.edit','guard_name' => 'admin' ],
            [ 'name' => 'admin.bs_input.post','guard_name' => 'admin' ]
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
        \Spatie\Permission\Models\Permission::where('name','like','%admin.bs_input%')->delete();
    }
}
