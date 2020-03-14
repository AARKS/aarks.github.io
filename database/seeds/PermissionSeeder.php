<?php

use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [ 'name' => 'admin.user.create' ],
            [ 'name' => 'admin.user.edit' ],
            [ 'name' => 'admin.user.index' ],
            [ 'name' => 'admin.user.reactivate' ],
            [ 'name' => 'admin.user.deactivate' ],

            [ 'name' => 'admin.role.index' ],
            [ 'name' => 'admin.role.create' ],
            [ 'name' => 'admin.role.edit' ],
            [ 'name' => 'admin.role.delete' ],

            [ 'name' => 'admin.client.create' ],
            [ 'name' => 'admin.client.edit' ],
            [ 'name' => 'admin.client.index' ],
            [ 'name' => 'admin.client.delete' ],

            [ 'name' => 'admin.profession.index' ],
            [ 'name' => 'admin.profession.create' ],
            [ 'name' => 'admin.profession.edit' ],
            [ 'name' => 'admin.profession.delete' ],

            [ 'name' => 'admin.account-code.index' ],
            [ 'name' => 'admin.account-code.create' ],
            [ 'name' => 'admin.account-code.edit' ],
            [ 'name' => 'admin.account-code.delete' ],
            [ 'name' => 'admin.account-code.sub-category.create' ],
            [ 'name' => 'admin.account-code.additional-category.create' ],

            [ 'name' => 'admin.master-chart.index' ],
            [ 'name' => 'admin.master-chart.create' ],
            [ 'name' => 'admin.master-chart.edit' ],
            [ 'name' => 'admin.master-chart.delete' ],
            [ 'name' => 'admin.master-chart.sub-category.create' ],
            [ 'name' => 'admin.master-chart.additional-category.create' ],

            [ 'name' => 'admin.service.index' ],
            [ 'name' => 'admin.service.create' ],
            [ 'name' => 'admin.service.edit' ],
            [ 'name' => 'admin.service.delete' ],

            [ 'name' => 'admin.period.index'],
            [ 'name' => 'admin.period.create'],
            [ 'name' => 'admin.period.show'],
            [ 'name' => 'admin.period.delete'],
        ];
        foreach ($permissions as &$permission) {
            $permission['guard_name'] = 'admin';
        }

        \Spatie\Permission\Models\Permission::insert($permissions);
    }
}
