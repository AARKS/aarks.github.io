<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class BankStatementImport extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'date' => 'date',
    ];

    public function client_account_code()
    {
        return $this->belongsTo(ClientAccountCode::class, 'account_code', 'id');
    }
}
