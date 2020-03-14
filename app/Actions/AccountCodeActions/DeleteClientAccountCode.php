<?php


namespace App\Actions\AccountCodeActions;


use App\Actions\BaseAction;
use App\ClientAccountCode;

class DeleteClientAccountCode extends BaseAction
{
    private $professions,$client;
    function setData($professions,$client)
    {
        $this->professions = $professions;
        $this->client = $client;
        return $this;
    }

    function execute()
    {
       $account_codes = ClientAccountCode::where('client_id',$this->client)
           ->whereIn('profession_id',$this->professions)->get();

       foreach ($account_codes as $account_code){
            $account_code->delete();
       }
    }
}
