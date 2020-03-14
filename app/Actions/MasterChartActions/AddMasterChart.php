<?php namespace App\Actions\MasterChartActions;

use App\Actions\AccountCodeActions\AddProfessionAccountCode;
use App\Actions\Creatable;
use App\MasterAccountCode;

class AddMasterChart extends AddProfessionAccountCode
{
    use Creatable;

    public function __construct(MasterAccountCode $masterAccountCode)
    {
        $this->setModel($masterAccountCode);
    }

    public function execute()
    {
        $this->create();
    }


}
