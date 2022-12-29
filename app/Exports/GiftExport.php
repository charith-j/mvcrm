<?php

namespace App\Exports;

use App\Models\User;
use App\Models\child;
use Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use DateTime;

use Maatwebsite\Excel\Concerns\WithHeadings;

class GiftExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    //use Exportable;

    public function __construct(string $child_id)
    {
        $this->child_id = $child_id;
    }

    public function collection()
    {
        
        
     
        
             $sponsors_new = DB::table('gifts')
             ->leftjoin('sponsors', 'sponsors.id', '=', 'gifts.sponsor_id')
             ->rightjoin('children', 'children.id', '=', 'gifts.child_id')
             ->leftjoin('banks', 'banks.id', '=', 'children.bank_id')
             //->rightjoin('projects', 'projects.id', '=', 'sponsors.project_id')
        
                 ->select('gifts.*','sponsors.address','sponsors.id','sponsors.name as sname','banks.account_number','children.resident','children.allocated_date','children.allocated','children.name','children.dob', )
                 ->where('children.id' , $this->child_id)
                 ->get();
     

        //return $sponsers_projects;
        foreach ($sponsors_new as $data){
          
        
           
        return collect([
            [   'Quarter Received' => $data->receipt_from,
                'Sponsor No' => $data->id,
                'Name of Child' => $data->name,
                'Name of Sponsor and address' => $data->sname.' '.$data->address,
                'Amount in NOK' => $data->amount,
                'Cash/ Bank' => $data->payment_type,
                'Bank A/c No' => $data->account_number,
                'Remarks' => $data->remarks,
                
            ]
        ]);
    }
            
            
            
        
    }

    public function headings(): array
    {
        return ["Quarter Received", "Sponsor No", "Name of Child","Name of Sponsor and address","Amount in NOK","Cash/Bank","Bank A/c No.","Remark"];
    }
}
