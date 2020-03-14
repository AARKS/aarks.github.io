<?php

namespace App\Http\Controllers;

use App\AccountCodeCategory;
use Illuminate\Http\Request;

class AccountCodeValidationController extends Controller
{
    public function checkSubCategoryCode(Request $request)
    {
        return AccountCodeCategory::where('type',2)->where('code',$request->account_code)->where('parent_id',$request->parent_id)->first();

    }
    public function checkAdditionalCategoryCode(Request $request)
    {
//        return "Hello From Additional Category";
    }
}
