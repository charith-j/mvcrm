<?php

namespace App\Exports;

use App\Models\User;
use App\Models\child;
use Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Http\Request;
use DB;

use Maatwebsite\Excel\Concerns\WithHeadings;

class ChildrenLeftProject implements FromCollection,WithHeadings
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
       if (empty($from_date)) {
           $from_date = '2000-06-08';
           
       }
       
       if (empty($to_date)) {
           $to_date = '2080-06-08';
           
       }
       
       $children_left_project =DB::table('sponsors')
        ->join('sponsor_child', 'sponsor_child.sponsor_id', '=', 'sponsors.id')
       ->join('children', 'children.id', '=', 'sponsor_child.child_id')
             
             ->join('projects', 'projects.id', '=', 'sponsors.project_id')
             ->select('children.*')
             ->where('children.removed',true)
             ->where('projects.name' , $project_name)
             ->where('children.removed_date', ">=", $from_date)
            ->where('children.removed_date', "<=", $to_date)
             ->get();
       
       
$mydata  = Collect([]);
             //return $sponsers_projects;
        foreach ($children_left_project as $data){
          
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
            
            [   'Name of Child' => $data->name,
            'Age' => $diff,
                 'Grade' => $data->grade,
                'School' => $data->school,
                'Sponsor Address' => $data->address,
                'Details' => $data->details_of_child,
                'Resident' => $resident
                
            ]
            );
    }
     
            
   return $mydata;         
            
        
    }

    public function headings(): array
    {
        return ['Name of Child', 'Age', 'Grade','School', 'Sponsor Address', 'Details', "Resident"];
    }
}
