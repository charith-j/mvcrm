<?php

namespace App\Exports;

use App\Models\User;
use App\Models\child;
use Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Http\Request;
use DB;

use Maatwebsite\Excel\Concerns\WithHeadings;

class SponsorExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    //use Exportable;

    public function __construct($dates)
    {
        $this->dates = $dates;
    }

    public function collection()
    {
      
  
     
       $sponsors = DB::table('sponsors')
        ->join('sponsor_child', 'sponsor_child.sponsor_id', '=', 'sponsors.id')
        ->join('children', 'children.id', '=', 'sponsor_child.child_id')
            ->select('sponsors.*','sponsors.name as sname', 'children.resident','children.name','children.dob', )
            ->get();
            
$mydata  = Collect([]);
             //return $sponsers_projects;
        foreach ($sponsors as $data){
      
           
        $mydata->push(
            [   
                'Sponsor Name' => $data->sname,
                'Sponsor Address' => $data->address,
                'Email' => $data->email,
                
                
            ]
            );
    }
     
            
   return $mydata;         
            
        
    }

    public function headings(): array
    {
        return ["Sponsor Name", "Sponsor Address", "Email"];
    }
}
