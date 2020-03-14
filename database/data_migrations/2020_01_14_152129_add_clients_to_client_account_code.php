<?php

use App\Actions\AccountCodeActions\CopyClientAccountCode;
use App\ClientAccountCode;
use Illuminate\Database\Migrations\Migration;

class AddClientsToClientAccountCode extends Migration
{



    /**
     * Run the data migrations.
     *
     * @return void
     */



    public function up()
    {
        $existing_clients = \App\ClientAccountCode::pluck('client_id')->toArray();
        $clients_to_copy = \App\Client::with('professions')->whereNotIn('id', $existing_clients)->get();
        $copy_client_account_code = new CopyClientAccountCode(new ClientAccountCode());
        foreach ($clients_to_copy as $client){
          $copy_client_account_code->setData(['profession_id' => $client->professions->pluck('id')->toArray(),'client_id' => $client->id])->execute();
        }

    }

    /**
     * Reverse the data migrations.
     *
     * @return void
     */
    public function down()
    {
        //TO-Do
    }
}
