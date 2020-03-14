<?php namespace App\Actions;

use Illuminate\Database\Eloquent\Model;

interface ActionContract
{
    function execute();
}
