<?php namespace App\Actions\BankStatementActions;


use App\Aarks\GeneralLedger\BankStatementImportGeneralLedger;
use App\Aarks\GeneralLedger\InvalidValueException;
use App\Actions\BaseAction;
use App\BankStatementImport;
use App\Client;
use App\ClientAccountCode;
use App\Profession;

class ImportBankStatement extends BaseAction
{
    private $client, $profession, $bank_account;
    private $bankStatementImportGeneralLedger;

    public function __construct(BankStatementImportGeneralLedger $bankStatementGeneralLedger)
    {
        $this->bankStatementImportGeneralLedger = $bankStatementGeneralLedger;
    }

    public function execute()
    {
        $this->validateRequirements();
        try {
            $this->bankStatementImportGeneralLedger
                ->setProfession($this->profession)
                ->setClient($this->client)
                ->setData($this->getUnPostedBankImportsAsArray())
                ->setOppositeAccountCode($this->bank_account)
                ->generateLedger();
            $this->updateBankStatementPostStatus();
        } catch (InvalidValueException $exception) {
            throw new \Exception("Something went wrong");
        }
    }

    private function validateRequirements()
    {
        if (!($this->client instanceof Client)) {
            throw new \Exception("Client Not Set Yet");
        }

        if (!($this->profession instanceof Profession)) {
            throw new \Exception("Profession Not Set Yet");
        }

        if (!($this->bank_account instanceof ClientAccountCode)) {
            throw new \Exception("Bank Account Not Set Yet");
        }
    }

    private function updateBankStatementPostStatus()
    {
        return BankStatementImport::where('is_posted', 0)->where('client_id', $this->client->id)
            ->where('profession_id', $this->profession->id)
            ->update(['is_posted' => 1]);
    }

    private function getUnPostedBankImportsAsArray()
    {
        return BankStatementImport::with('client_account_code')
            ->where('is_posted', 0)->where('client_id', $this->client->id)
            ->where('profession_id', $this->profession->id)
            ->get()
            ->toArray();
    }

    /**
     * @param mixed $client
     * @return ImportBankStatement
     */
    public function setClient(Client $client): ImportBankStatement
    {
        $this->client = $client;
        return $this;
    }

    /**
     * @param mixed $profession
     * @return ImportBankStatement
     */
    public function setProfession(Profession $profession): ImportBankStatement
    {
        $this->profession = $profession;
        return $this;
    }

    /**
     * @param mixed $bank_account
     * @return ImportBankStatement
     */
    public function setBankAccount(ClientAccountCode $bank_account): ImportBankStatement
    {
        $this->bank_account = $bank_account;
        return $this;
    }
}
