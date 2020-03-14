<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class GeneralLedger extends Model
{
    protected $guarded = ['id'];

    protected $dates = ['date'];

    public function client_account_code()
    {
        return $this->belongsTo(ClientAccountCode::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class,'transaction_id');
    }

    public function getNetAmountAttribute()
    {
        return $this->credit == 0 ? $this->debit : $this->credit;
    }

    public function getIsDebitAttribute()
    {
        return $this->debit ? true : false;
    }
}
