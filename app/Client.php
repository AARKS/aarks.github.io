<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{

    protected $guarded = ['id'];

    public function professions()
    {
        return $this->belongsToMany(Profession::class,'client_professions');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class);
    }

    public function periods()
    {
        return $this->hasMany(Period::class);
    }
    public function account_codes()
    {
        return $this->hasMany(ClientAccountCode::class);
    }

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
