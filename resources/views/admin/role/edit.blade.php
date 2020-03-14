@extends('admin.layout.master')
@section('title','Update Role')
@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                <ul class="breadcrumb">
                    <li>
                        <i class="ace-icon fa fa-home home-icon"></i>
                        <a href="#">Home</a>
                    </li>
                    <li>
                        <a href="#">Admin</a>
                    </li>
                    <li>
                        <a href="#">Role</a>
                    </li>
                    <li class="active">Update Role</li>
                </ul><!-- /.breadcrumb -->

                <div class="nav-search" id="nav-search">
                    <form class="form-search">
							<span class="input-icon">
								<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
								<i class="ace-icon fa fa-search nav-search-icon"></i>
							</span>
                    </form>
                </div><!-- /.nav-search -->
            </div>

            <div class="page-content">



                <!-- Settings -->
            @include('admin.layout.settings')
            <!-- /Settings -->

                <div class="page-header">
                    <h1>
                       Update Role
                        <small>
                            <i class="ace-icon fa fa-angle-double-right"></i>
                        </small>
                    </h1>
                </div><!-- /.page-header -->
                <br>
                <br>
                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                        <form class="form-horizontal" action="{{route('role.update',$role->id)}}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Role Name:    </label>
                                <div class="col-sm-9">
                                    <input type="text" name="name"  value="{{$role->name}}" placeholder="Enter User Name" class="col-xs-10 col-sm-8" />
                                    @if($errors->has('name'))
                                        <br><br> <span class="text-danger"> {{$errors->first('name')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-sm-3 control-label">Permissions:    </label>
                                    <div class="col-sm-9">
                                        <hr><div class="row">
                                            <div class="col-sm-2 text-center">
                                                User
                                            </div>
                                            {{--                                            <div class="col-sm-2">--}}
                                            {{--                                                <input type="checkbox" name="select_all"> Select All--}}
                                            {{--                                            </div>--}}
                                            <div class="col-sm-8">
                                                <input type="checkbox" value="{{$permissions['admin.user.index']}}" name="permission[]" {{in_array('admin.user.index', $role_permissions) ? 'checked' : ''}}> User List <br>
                                                <input type="checkbox" value="{{$permissions['admin.user.create']}}" name="permission[]" {{in_array('admin.user.create', $role_permissions) ? 'checked' : ''}}> Add User <br>
                                                <input type="checkbox" value="{{$permissions['admin.user.edit']}}" name="permission[]" {{in_array('admin.user.edit', $role_permissions) ? 'checked' : ''}}> Edit User <br>
                                                <input type="checkbox" value="{{$permissions['admin.user.deactivate']}}" name="permission[]" {{in_array('admin.user.deactivate', $role_permissions) ? 'checked' : ''}}> Deactivate User <br>
                                                <input type="checkbox" value="{{$permissions['admin.user.reactivate']}}" name="permission[]" {{in_array('admin.user.reactivate', $role_permissions) ? 'checked' : ''}}> Reactivate User <br>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-2 text-center">
                                                Client
                                            </div>
                                            {{--                                           <div class="col-sm-2">--}}
                                            {{--                                               <input type="checkbox" name="select_all"> Select All--}}
                                            {{--                                           </div>--}}
                                            <div class="col-sm-8">
                                                <input type="checkbox" value="{{$permissions['admin.client.index']}}" name="permission[]" {{in_array('admin.client.index', $role_permissions) ? 'checked' : ''}}> Client List <br>
                                                <input type="checkbox" value="{{$permissions['admin.client.create']}}" name="permission[]" {{in_array('admin.client.create', $role_permissions) ? 'checked' : ''}}> Add Client <br>
                                                <input type="checkbox" value="{{$permissions['admin.client.edit']}}" name="permission[]" {{in_array('admin.client.edit', $role_permissions) ? 'checked' : ''}}> Edit Client <br>
                                                <input type="checkbox" value="{{$permissions['admin.client.delete']}}" name="permission[]" {{in_array('admin.client.delete', $role_permissions) ? 'checked' : ''}}> Delete Client <br>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-2 text-center">
                                                Role
                                            </div>
                                            {{--                                           <div class="col-sm-2">--}}
                                            {{--                                               <input type="checkbox" name="select_all"> Select All--}}
                                            {{--                                           </div>--}}
                                            <div class="col-sm-8">
                                                <input type="checkbox" value="{{$permissions['admin.role.index']}}" name="permission[]" {{in_array('admin.role.index', $role_permissions) ? 'checked' : ''}}> Role List <br>
                                                <input type="checkbox" value="{{$permissions['admin.role.create']}}" name="permission[]" {{in_array('admin.role.create', $role_permissions) ? 'checked' : ''}}> Create Role <br>
                                                <input type="checkbox" value="{{$permissions['admin.role.edit']}}" name="permission[]" {{in_array('admin.role.edit', $role_permissions) ? 'checked' : ''}}> Edit Role <br>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-2 text-center">
                                                Profession
                                            </div>
                                            {{--                                           <div class="col-sm-2">--}}
                                            {{--                                               <input type="checkbox" name="select_all"> Select All--}}
                                            {{--                                           </div>--}}
                                            <div class="col-sm-8">
                                                <input type="checkbox" value="{{$permissions['admin.profession.index']}}" name="permission[]" {{in_array('admin.profession.index', $role_permissions) ? 'checked' : ''}}> Profession List <br>
                                                <input type="checkbox" value="{{$permissions['admin.profession.create']}}" name="permission[]" {{in_array('admin.profession.create', $role_permissions) ? 'checked' : ''}}> Create Profession <br>
                                                <input type="checkbox" value="{{$permissions['admin.profession.edit']}}" name="permission[]" {{in_array('admin.profession.edit', $role_permissions) ? 'checked' : ''}}> Edit Profession <br>
                                                <input type="checkbox" value="{{$permissions['admin.profession.delete']}}" name="permission[]" {{in_array('admin.profession.delete', $role_permissions) ? 'checked' : ''}}> Delete Profession <br>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-2 text-center">
                                                Service
                                            </div>
                                            {{--                                           <div class="col-sm-2">--}}
                                            {{--                                               <input type="checkbox" name="select_all"> Select All--}}
                                            {{--                                           </div>--}}
                                            <div class="col-sm-8">
                                                <input type="checkbox" value="{{$permissions['admin.service.index']}}" name="permission[]" {{in_array('admin.service.index', $role_permissions) ? 'checked' : ''}}> Service List <br>
                                                <input type="checkbox" value="{{$permissions['admin.service.create']}}" name="permission[]" {{in_array('admin.service.create', $role_permissions) ? 'checked' : ''}}> Create Service <br>
                                                <input type="checkbox" value="{{$permissions['admin.service.edit']}}" name="permission[]" {{in_array('admin.service.edit', $role_permissions) ? 'checked' : ''}}> Edit Service <br>
                                                <input type="checkbox" value="{{$permissions['admin.service.delete']}}" name="permission[]" {{in_array('admin.service.delete', $role_permissions) ? 'checked' : ''}}> Delete Service <br>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-2 text-center">
                                                Account Code
                                            </div>
                                            {{--                                           <div class="col-sm-2">--}}
                                            {{--                                               <input type="checkbox" name="select_all"> Select All--}}
                                            {{--                                           </div>--}}
                                            <div class="col-sm-8">
                                                <input type="checkbox" value="{{$permissions['admin.account-code.index']}}" name="permission[]" {{in_array('admin.account-code.index', $role_permissions) ? 'checked' : ''}}> Account Code List <br>
                                                <input type="checkbox" value="{{$permissions['admin.account-code.create']}}" name="permission[]" {{in_array('admin.account-code.create', $role_permissions) ? 'checked' : ''}}> Account Code Create <br>
                                                <input type="checkbox" value="{{$permissions['admin.account-code.edit']}}" name="permission[]" {{in_array('admin.account-code.edit', $role_permissions) ? 'checked' : ''}}> Account Code Edit <br>
                                                <input type="checkbox" value="{{$permissions['admin.account-code.delete']}}" name="permission[]" {{in_array('admin.account-code.delete', $role_permissions) ? 'checked' : ''}}> Account Code Delete <br>
                                                <input type="checkbox" value="{{$permissions['admin.account-code.sub-category.create']}}" name="permission[]" {{in_array('admin.account-code.sub-category.create', $role_permissions) ? 'checked' : ''}}> Sub Group Create <br>
                                                <input type="checkbox" value="{{$permissions['admin.account-code.additional-category.create']}}" name="permission[]" {{in_array('admin.account-code.additional-category.create', $role_permissions) ? 'checked' : ''}}> Sub Sub Group Create <br>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-2 text-center">
                                                Master Chart
                                            </div>
                                            {{--                                           <div class="col-sm-2">--}}
                                            {{--                                               <input type="checkbox" name="select_all"> Select All--}}
                                            {{--                                           </div>--}}
                                            <div class="col-sm-8">
                                                <input type="checkbox" value="{{$permissions['admin.master-chart.index']}}" name="permission[]" {{in_array('admin.master-chart.index', $role_permissions) ? 'checked' : ''}}> Master Chart List <br>
                                                <input type="checkbox" value="{{$permissions['admin.master-chart.create']}}" name="permission[]" {{in_array('admin.master-chart.create', $role_permissions) ? 'checked' : ''}}> Master Chart Create <br>
                                                <input type="checkbox" value="{{$permissions['admin.master-chart.edit']}}" name="permission[]" {{in_array('admin.master-chart.edit', $role_permissions) ? 'checked' : ''}}> Master Chart Edit <br>
                                                <input type="checkbox" value="{{$permissions['admin.master-chart.delete']}}" name="permission[]" {{in_array('admin.master-chart.delete', $role_permissions) ? 'checked' : ''}}> Master Chart Delete <br>
                                                <input type="checkbox" value="{{$permissions['admin.master-chart.sub-category.create']}}" name="permission[]" {{in_array('admin.master-chart.sub-category.create', $role_permissions) ? 'checked' : ''}}> Sub Group Create <br>
                                                <input type="checkbox" value="{{$permissions['admin.master-chart.additional-category.create']}}" name="permission[]" {{in_array('admin.master-chart.additional-category.create', $role_permissions) ? 'checked' : ''}}> Sub Sub Group Create <br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="space-4"></div>

                            <div class="clearfix form-actions ">
                                <div class="text-center">
                                    <button class="btn btn-info" type="submit">
                                        <i class="ace-icon fa fa-check bigger-110"></i>
                                        Submit
                                    </button>
                                    &nbsp; &nbsp; &nbsp;
                                    <a href="{{route('role.index')}}">
                                        <button class="btn btn-danger" type="button">
                                            <i class="ace-icon fa fa-undo bigger-110"></i>
                                            Cancel
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div><!-- PAGE CONTENT ENDS -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->

    </div>
@stop
