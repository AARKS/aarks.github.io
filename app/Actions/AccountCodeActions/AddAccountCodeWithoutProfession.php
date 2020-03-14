<?php namespace App\Actions\AccountCodeActions;

use App\AccountCode;
use App\Actions\BaseAction;
use App\Actions\Creatable;
use App\Actions\CreateAccountCode;
use App\Actions\MasterChartActions\AddMasterChart;
use App\Actions\SharedActions\AssignIndustryCategory;
use App\Actions\SharedActions\AssignProfession;
use App\MasterAccountCode;
use App\ProfessionAccountCode;
use Illuminate\Support\Arr;

class AddAccountCodeWithoutProfession extends BaseAction
{
    use Creatable;
    use CreateAccountCode;

    private $assign_industry_category;
    public function __construct(AssignIndustryCategory $assignIndustryCategory, MasterAccountCode $masterAccountCode)
    {
        $this->setModel($masterAccountCode);
        $this->assign_industry_category = $assignIndustryCategory;

    }

    public function execute()
    {
        $account_code = $this->create();

        $this->assign_industry_category
            ->setInstance($account_code)
            ->setIndustryCategory($this->data['industry_category'])
            ->execute();

        return $account_code;
    }

    protected function data()
    {
        $data = Arr::except($this->data, ['industry_category']);
        $data['code'] = $this->generateAccountCode();
        $this->checkAccountCodeDuplication($data['code']);
        return $data;
    }

    private function checkAccountCodeDuplication($account_code)
    {
        $existing_account_code = $this->getModel()
            ->where('code', $account_code)
            ->count();

        if ($existing_account_code) {
            throw new \Exception("Account Code Already Exist");
        }
    }
}
