<?php

use Carbon\Carbon;
use Illuminate\Database\Schema\Blueprint;

if (!function_exists('modificationFields')) {

    function modificationFields(Blueprint $table)
    {
        $table->unsignedBigInteger('created_by')->nullable();
        $table->string('created_by_type')->nullable()->comment('1 = Admin, 2 = Client');
        $table->string('created_by_name')->nullable();
        $table->unsignedBigInteger('updated_by')->nullable();
        $table->string('updated_by_type')->nullable()->comment('1 = Admin, 2 = Client');
        $table->string('updated_by_name')->nullable();
    }
}

if (!function_exists('dropModificationFields')) {

    function dropModificationFields($table)
    {
        $table->dropColumn(['created_by', 'created_by_type','created_by_name', 'updated_by', 'updated_by_type', 'updated_by_name']);
    }
}

if (!function_exists('aarks')) {

    function aarks($key, $default = '')
    {
        return config('aarks.' . $key, $default);
    }
}

if (!function_exists('assetVersion')) {

    function assetVersion($filename)
    {
        $aarks_key_name = 'asset_version.'.$filename;
        $default_asset_value = aarks('default_asset_version');
        return aarks($aarks_key_name, $default_asset_value);
    }
}

if (!function_exists('makeBackendCompatibleDate')) {

    function makeBackendCompatibleDate($date)
    {
        return Carbon::createFromFormat(aarks('frontend_date_format'), $date);
    }
}


if (!function_exists('financialYearInArray')) {

    function financialYearInArray($year)
    {
        $first_date = Carbon::create($year - 1, 7, 1);
        $last_date = Carbon::create($year, 6, 30);

        return [
            'first' => $first_date,
            'last' => $last_date
        ];
    }
}

if (!function_exists('makeNineDigitNumber')) {

    function makeNineDigitNumber($id)
    {
        return $id + 100000000;
    }
}

if (!function_exists('getFinancialYearOf')) {

    function getFinancialYearOf($date) {
        if (!($date instanceof Carbon)) {
            $date = Carbon::parse($date);
        }
        $financial_year = financialYearInArray($date->year);

        return $date->isBetween($financial_year['first'], $financial_year['last']) ? $date->year : $date->year + 1;
    }
}

if (!function_exists('withFinancialSign')) {

    function withFinancialSign($value)
    {
        return '$'.' '.$value;
    }
}

