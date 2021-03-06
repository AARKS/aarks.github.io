<?php namespace App\Http\Controllers;

use App\Admin;
use App\Http\Requests\AddUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    use AuthenticatesUsers;
    private $default_admin_redirect_route = 'admin.dashboard';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($error = $this->sendPermissionError('admin.user.index')) {
            return $error;
        }
        $admins = Admin::all();
        return view('admin.user_management.index',compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if ($error = $this->sendPermissionError('admin.user.create')) {
            return $error;
        }
        $roles = Role::all();
        return view('admin.user_management.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddUserRequest $request)
    {
        if ($error = $this->sendPermissionError('admin.user.create')) {
            return $error;
        }
        $data = $this->prepareDataForAddUser($request);
        $roles = $data['role'];
        DB::beginTransaction();
        try{
            $admin = Admin::create(Arr::except($data, ['role']));
            $admin->syncRoles($roles);
            DB::commit();
            Alert::success('User Management','User Created Successfully');
        }catch (\Exception $exception){
            DB::rollBack();
            Alert::error('User Management',$exception->getMessage());
        }
        return redirect()->route('user.index');
    }

    public function prepareDataForAddUser($request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => bcrypt($request->password),
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $user)
    {
        if ($error = $this->sendPermissionError('admin.user.edit')) {
            return $error;
        }

        $roles = Role::all();
        return view('admin.user_management.edit',compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, Admin $user)
    {
        if ($error = $this->sendPermissionError('admin.user.edit')) {
            return $error;
        }
        $data = $this->prepareDataForAddUser($request);
        DB::beginTransaction();
        try{
            if($request->password == null){
                $user->update(Arr::except($data, ['role','password']));
            }else{
                $user->update(Arr::except($data, ['role']));
            }
            $user->syncRoles($data['role']);
            DB::commit();
            Alert::success('User Management','User Updated Successfully');
        }catch (\Exception $exception){
            DB::rollBack();
            Alert::error('User Management',$exception->getMessage());
        }
        return redirect()->route('user.index');

    }

    public function showLoginForm()
    {
        if (!Auth::guard('admin')->check()) {
            return view('admin.auth.login');
        }
        return redirect()->intended(route($this->default_admin_redirect_route));
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:5'
        ]);

        if ($this->isUserAuthenticated($request)) {
            return redirect()->intended(route($this->default_admin_redirect_route));
        }

        return redirect()->back()->withErrors([
            'unauthenticated' => 'email or password is incorrect'
        ])->withInput();
    }

    private function isUserAuthenticated(Request $request)
    {
        $remember = $request->has('remember_me')?:false;
        return Auth::guard('admin')->attempt([
            'email' => $request->email,
            'password' => $request->password,
            'is_active' => 1
        ], $remember);
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        return redirect()->route('admin.login');
    }

    public function deactivate(Admin $admin)
    {
        if ($error = $this->sendPermissionError('admin.user.deactivate')) {
            return $error;
        }

        $logged_in_user = auth('admin')->user();

        if ($admin->id == $logged_in_user->id) {
            Alert::error('Deactivate User', 'Why do you want to deactivate yourself!');
            return redirect()->route('user.index');
        } elseif ($admin->is_active == false) {
            Alert::error('Deactivate User', 'User is already deactivated');
            return redirect()->route('user.index');
        }

        $admin->toggleActiveStatus();
        Alert::info('Deactivate User', 'User Deactivated Successfully');
        return redirect()->route('user.index');
    }

    public function reactivate(Admin $admin)
    {
        if ($error = $this->sendPermissionError('admin.user.reactivate')) {
            return $error;
        }

        if ($admin->is_active == true) {
            Alert::error('Deactivate User', 'User is already active');
            return redirect()->route('user.index');
        }

        $admin->toggleActiveStatus();
        Alert::info('Deactivate User', 'User Reactivated Successfully');
        return redirect()->route('user.index');
    }
}
