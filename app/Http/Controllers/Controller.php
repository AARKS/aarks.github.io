<?php

namespace App\Http\Controllers;

use Cassandra\Session;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use RealRashid\SweetAlert\Facades\Alert;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function withSuccessNotification()
    {
        Session::flash('');
    }

    protected function sendPermissionError($permission,
                                           $error_message = 'Don\'t have permission to perform this action',
                                           $error_title = 'Permission Denied')
    {
        if (!auth()->user()->can($permission)) {
            Alert::error($error_title, $error_message);
            return redirect()->back()->withInput();
        }
    }
}
