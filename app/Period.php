<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    protected $guarded = ['id'];

    protected $dates = [
        'start_date', 'end_date'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
