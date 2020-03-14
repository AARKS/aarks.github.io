<?php namespace App\Actions\ClientActions;

use App\Actions\BaseAction;
use Illuminate\Support\Facades\DB;

class DeleteClient extends BaseAction
{
    private $client;

    function setClient($client)
    {
        $this->client = $client;
        return $this;
    }

    function execute()
    {
        $this->client->services()->delete();
        $this->client->periods()->delete();
        $this->client->account_codes()->delete();
        //DB::table('account_code_profession')->where('profession_id', $profession->id)->delete();
        $this->client->delete();
    }
}
