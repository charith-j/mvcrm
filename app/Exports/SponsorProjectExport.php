<?php

namespace App\Exports;

use App\Models\User;
use App\Models\child;
use Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Http\Request;
use DB;

use Maatwebsite\Excel\Concerns\WithHeadings;

class SponsorProjectExport implements FromCollection,WithHeadings
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
     
       $sponsers_projects = DB::table('sponsors')
             ->join('sponsor_child', 'sponsor_child.sponsor_id', '=', 'sponsors.id')
             ->join('children', 'children.id', '=', 'sponsor_child.child_id')
             ->join('projects', 'projects.id', '=', 'sponsors.project_id')
                 ->select('sponsors.*', 'sponsors.name as sname', 'children.resident','children.name','children.dob', )
                 ->where('projects.name' , $project_name)
                 ->where('sponsors.start_date', ">=", $from_date)
            ->where('sponsors.start_date', "<=", $to_date)
                 ->get();
            
$mydata  = Collect([]);
             //return $sponsers_projects;
        foreach ($sponsers_projects as $data){
      
           
        $mydata->push(
            [   
                'Sponsor Name' => $data->sname,
                'Sponsor Address' => $data->address,
                'Email' => $data->email,
                'Child Name' => $data->name
                
                
            ]
            );
    }
     
            
   return $mydata;         
            
        
    }

    public function headings(): array
    {
        return ["Sponsor Name", "Sponsor Address", "Email", "Child Name"];
    }
}
