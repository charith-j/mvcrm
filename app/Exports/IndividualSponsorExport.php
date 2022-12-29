<?php

namespace App\Exports;

use App\Models\User;
use App\Models\child;
use Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Http\Request;
use DB;

use Maatwebsite\Excel\Concerns\WithHeadings;

class IndividualSponsorExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    //use Exportable;

    public function __construct(string $sponsor)
    {
        $this->sponsor = $sponsor;
    }

    public function collection()
    {
        
        
     
       $sponsors_name = $this->sponsor;
     
            $individual_sponsor = DB::table('sponsors')
             ->join('sponsor_child', 'sponsor_child.sponsor_id', '=', 'sponsors.id')
             ->join('children', 'children.id', '=', 'sponsor_child.child_id')
                 ->select('sponsors.*','children.resident','children.name','children.dob', )
                 ->where('sponsors.name' , $sponsors_name)
                 ->get();
                 
                 $mydata = Collect([]);

          foreach ($individual_sponsor as $data){
          
        $dateOfBirth = $data->dob;
  $today = date("Y-m-d");
  $diff = date_diff(date_create($dateOfBirth), date_create($today));
  
  $resident = 0;
  
  if ($data->resident == 1) {
      $resident = "Yes";
  }
  else {
      $resident = "No"; 
  }
           
        $mydata->push(
            [   'Sponsor Number' => ['Sponsor Number',  $data->sponsor_number],
            ]
            );
            $mydata->push(
            [ 
               'Sponsor Name' => ['Sponsor Name',   $sponsors_name],
               
            ]
            );
            
            $mydata->push(
            [  
               'Sponsor Address' => ['Sponsor Address',  $data->address],
                
            ]
            );
            
             $mydata->push(
            [  
                'Name of Child' =>['Name of Child' , $data->name],
                
            ]
            );
            $mydata->push(
            [  
               'Age'=> ['Age',  $diff->format('%y')],
                
            ]
            );
            $mydata->push(
            [  
              'Date of Sponsorship' => ['Date of Sponsorship', $data->start_date],
                
            ]
            );
            $mydata->push(
            [  
              'Resident'=> ['Resident', $resident],
                
            ]
            );
            
    }
     
        return $mydata;    
            
            
        
    }

    public function headings(): array
    {
        return [];
    }
}
