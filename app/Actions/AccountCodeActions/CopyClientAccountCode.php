<?php


namespace App\Actions\AccountCodeActions;


use App\Actions\BaseAction;
use App\Actions\Creatable;
use App\ClientAccountCode;
use App\ProfessionAccountCode;
use Illuminate\Support\Arr;

class CopyClientAccountCode extends BaseAction
{
    use Creatable;
    public function __construct(ClientAccountCode $client_account_code)
    {
        $this->setModel($client_account_code);
    }

    function execute()
    {
        $profession_account_codes = $this->getProfessionAccountCodes($this->data['profession_id']);
        foreach ($profession_account_codes->toArray() as $profession_account_code){
            array_push($profession_account_code, $profession_account_code['client_id'] = $this->data['client_id']);
            $this->setData(Arr::except($profession_account_code, ['deleted_at', 'is_universal']));
            $this->create();
        }

    }

    function getProfessionAccountCodes($profession_id)
    {
        return ProfessionAccountCode::whereIn('profession_id',$profession_id)->get();
    }
}
