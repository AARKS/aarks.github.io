<?php namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use HasRoles;

    protected $guard = 'admin';
    protected $guarded = ['id'];
    protected $hidden = ['password', 'remember_token'];

    public function toggleActiveStatus()
    {
        $status = $this->is_active;
        $this->is_active = !$status;
        $this->save();
        return $this;
    }
}
