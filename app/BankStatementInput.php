<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class BankStatementInput extends Model
{
    protected $table = 'bank_statement_inputs';
    protected $guarded = ['id'];
    protected $dates = ['date'];

    public function client_account_code()
    {
        return $this->belongsTo(ClientAccountCode::class, 'account_code', 'id');
    }
}
