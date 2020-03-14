<?php namespace App\Http\Controllers;

use App\Http\Requests\CreateRoleRequest;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use function GuzzleHttp\Promise\all;

class RoleController extends Controller
{
    public function index()
    {
        if ($error = $this->sendPermissionError('admin.role.index')) {
            return $error;
        }

        $roles = Role::all();
        return view('admin.role.index',compact('roles'));
    }

    public function create()
    {
        if ($error = $this->sendPermissionError('admin.role.create')) {
            return $error;
        }
        $permissions = Permission::pluck('id', 'name')->toArray();
        return view('admin.role.create',compact('permissions'));
    }

    public function edit(Role $role)
    {
        if ($error = $this->sendPermissionError('admin.role.edit')) {
            return $error;
        }

        $permissions = Permission::pluck('id', 'name')->toArray();
        $role_permissions = $role->load('permissions')->permissions->pluck('name')->toArray();
        return view('admin.role.edit',compact('role','permissions', 'role_permissions'));
    }

    public function update(Role $role, CreateRoleRequest $request)
    {
        if ($error = $this->sendPermissionError('admin.role.edit')) {
            return $error;
        }

        $data = $this->prepareDataForCreateRole($request);
        DB::beginTransaction();
        try{
            $role->update(Arr::except($data, ['permission']));
            $role->syncPermissions($data['permission']);
            DB::commit();
            Alert::success('Role','Role Updated Successfully');

        }catch (\Exception $exception){
            DB::rollBack();
            Alert::error('Role',$exception->getMessage());
        }

        return redirect()->route('role.index');

    }

    public function store(CreateRoleRequest $request)
    {
        if ($error = $this->sendPermissionError('admin.role.create')) {
            return $error;
        }

        $data = $this->prepareDataForCreateRole($request);
        DB::beginTransaction();
        try{
            $role = Role::create(Arr::except($data, ['permission']));
            $role->syncPermissions($data['permission']);
            DB::commit();
            Alert::success('Role','Role Added Successfully');

        }catch (\Exception $exception){
            DB::rollBack();
            Alert::error('Role',$exception->getMessage());
        }

        return redirect()->route('role.index');

    }

    public function prepareDataForCreateRole($request)
    {
        return [
            'name' => $request->name,
            'permission' => $request->permission,
            'guard_name' => 'admin',
        ];
    }
}
