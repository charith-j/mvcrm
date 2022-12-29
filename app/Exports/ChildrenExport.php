<?php

namespace App\Exports;

use App\Models\User;
use App\Models\child;
use Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Http\Request;
use DB;

use Maatwebsite\Excel\Concerns\WithHeadings;

class ChildrenExport implements FromCollection,WithHeadings
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
       
       if (empty($from_date)) {
           $from_date = '2000-06-08';
           
       }
       
       if (empty($to_date)) {
           $to_date = '2080-06-08';
           
       }
  
     
       $child = DB::table('sponsors')
        ->join('sponsor_child', 'sponsor_child.sponsor_id', '=', 'sponsors.id')
        ->join('children', 'children.id', '=', 'sponsor_child.child_id')
        ->join('projects', 'projects.id', '=', 'sponsors.project_id')
            ->select('projects.name as pname','sponsors.name as sname','sponsors.address','children.name','children.dob', 'sponsors.start_date', 'children.resident' )
            ->where('sponsors.start_date', ">=", $from_date)
            ->where('sponsors.start_date', "<=", $to_date)
            ->get();
$mydata  = Collect([]);
             //return $sponsers_projects;
        foreach ($child as $data){
          
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
            [   'Project Name' => $data->pname,
                'Sponsor Name' => $data->sname,
                'Sponsor Address' => $data->address,
                'Name of Child' => $data->name,
                'Age' => $diff->format('%y'),
                'Date of Sponsorship' => $data->start_date,
                'Resident' => $resident,
                
            ]
            );
    }
     
            
   return $mydata;         
            
        
    }

    public function headings(): array
    {
        return ["Project Name", "Sponsor Name", "Sponsor Address","Name of Child","Age", "Date of Sponsorship", "Resident"];
    }
}
