<?php namespace App\Aarks;

use App\BankStatementImport;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use RealRashid\SweetAlert\Facades\Alert;

class BankStatementImportCollection implements ToCollection,WithHeadingRow
{
    public $data;

    /**
     * @inheritDoc
     */
    public function collection(Collection $collection)
    {
        $this->data = $collection;
        return $this;
    }

    public function tempSolution($client, $profession)
    {
        foreach ($this->data as $row)
        {
            try {
                BankStatementImport::create([
                    'date'    => Carbon::createFromFormat(aarks('frontend_date_format'), $row['transaction_date'])->format(aarks('backend_date_format')),
                    'narration' => $row['narration'],
                    'debit' => empty($row['debit'])?0.00:$row['debit'],
                    'credit' => empty($row['credit'])?0.00:$row['credit'],
                    'client_id' => $client,
                    'profession_id' => $profession,
                ]);
            }catch (\Exception $exception){
                Alert::error('Error','Insertion Error!');
            }
        }
    }

}
