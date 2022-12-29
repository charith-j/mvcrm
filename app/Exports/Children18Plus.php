<?php

namespace App\Exports;

use App\Models\User;
use App\Models\child;
use Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Http\Request;
use DB;

use Maatwebsite\Excel\Concerns\WithHeadings;

class Children18Plus implements FromCollection,WithHeadings
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
      
  $from_date = $this->dates[0];
  $to_date = $this->dates[1];
  $project_name = $this->dates[2];
     
       $today = date("Y-m-d");
       $date = strtotime($today.' -18 year');
       $date18 = date('Y-m-d', $date);
                 
                 $children_18_plus = DB::table('sponsors')
        ->join('sponsor_child', 'sponsor_child.sponsor_id', '=', 'sponsors.id')
             ->join('children', 'children.id', '=', 'sponsor_child.child_id')
             ->selectRaw("children.*")
             ->where('sponsors.start_date', ">=", $from_date)
            ->where('sponsors.start_date', "<=", $to_date)
            ->where( 'children.dob', "<=", $date18)
        ->get();

            
$mydata  = Collect([]);
             //return $sponsers_projects;
        foreach ($children_18_plus as $data){
      $dateOfBirth = $data->dob;
  $today = date("Y-m-d");
  $diff = date_diff(date_create($dateOfBirth), date_create($today));
  $age =  $diff->format('%y');
           
        $mydata->push(
            [   
                'Name' => $data->first_name." ".$data->last_name,
                'Gender' => $data->gender,
                'Ethnicity' => $data->ethnicity,
                'Religion' => $data->religion,
                'Date of Birth' => $data->dob,
                'Age'=> $age,
                'Grade' => $data->grade,
                'School' => $data->school
                
                
            ]
            );
    }
     
            
   return $mydata;         
            
        
    }

    public function headings(): array
    {
        return ["Name", 'Gender', 'Ethnicity', 'Religion', 'Date of Birth', 'Age', 'Grade', 'School' ];
    }
}
