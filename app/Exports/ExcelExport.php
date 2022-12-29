<?php

namespace App\Exports;

use App\Models\User;
use App\Models\child;
use Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Http\Request;
use DB;

use Maatwebsite\Excel\Concerns\WithHeadings;

class ExcelExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    //use Exportable;

    public function __construct(string $project)
    {
        $this->project = $project;
    }

    public function collection()
    {
        
        
     
        $sponsers_projects = DB::table('sponsors')
         ->join('sponsor_child', 'sponsor_child.sponsor_id', '=', 'sponsors.id')
         ->join('children', 'children.id', '=', 'sponsor_child.child_id')
         ->join('banks', 'children.bank_id', '=', 'banks.id')
         ->join('projects', 'projects.id', '=', 'sponsors.project_id')
             ->select('sponsors.id','children.name','sponsors.name as sname','banks.account_number', )
             ->where('projects.name' , $this->project)
             ->get();

        return $sponsers_projects;
            
            
            
        
    }

    public function headings(): array
    {
        return ["Sponsor No", "first Name", "Last Name","Name of Sponsor","Bank Account Number"];
    }
}
