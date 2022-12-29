<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\LeavingNoticeRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use DB;
use PDF;
use Storage;
use URL;
use App\Models\Child;
use App\Models\LeavingNotice;
use App\Models\Project;
use App\Models\Sponsor;
use App\Models\User;

/**
 * Class LeavingNoticeCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class LeavingNoticeCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation { store as traitStore; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function store() {
        $this->crud->addField(['type' => 'hidden', 'name' => 'pdf']);
        $this->crud->addField(['type' => 'hidden', 'name' => 'status_text']);
        $id = $this->getLastInsertedIdDB();
        $request  = $this->crud->getRequest()->request;
        $request->add(['pdf'=>'REF_LEAVINGNOTICE_'.($id + 1).'.pdf']);
        $request->add(['status_text' => 'No']);
        
        $response = $this->traitStore();
        $in = [];
        $in['date'] = $request->get('date');
        $in['reason'] = $request->get('reason');

        
        $date=date_create($request->get('date_of_removal'));
        $date = date_format($date,"d F Y");
        $in['date_of_removal'] = $date;
        $in['copy_to'] = $request->get('copy_to');
        $this->generatePDF($id + 1, $in);
        // do something after save
        return $response;
    }
    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\LeavingNotice::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/leaving-notice');
        CRUD::setEntityNameStrings('leaving notice', 'leaving notices');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->removeButton('delete');
        CRUD::column('id');
        CRUD::column('ref_no');
        $this->crud->addColumn([
            'name'=>'fullname',
            'label' => 'Full Name'
        
        ]);   
          CRUD::column('date_of_removal');    
         $this->crud->addColumn([
            // Select
            'label'     => 'Leaving Notice',  
            'name' => 'pdf',
           
  'wrapper'   => [
      // 'element' => 'a', // the element will default to "a" so you can skip it here
      'href' => function ($crud, $column, $entry, $related_key) {
          return URL::asset('pdfs/'.$column['text']);
      },
      'target' => '_blank'
    ]]);
        
        $this->crud->addColumn([
            'name'    => 'status_text',
            'label'   => 'Approved',        
            'wrapper' => [
                'element' => 'span',
                'class' => function ($crud, $column, $entry, $related_key) {
                    if ($column['text'] == 'Yes') {
                        return 'badge badge-success';
                    }
        
                    return 'badge badge-default';
                },
            ],
        ]);
        
       
  

    
        

        CRUD::column('created_at');
        CRUD::column('updated_at');

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    public function getLastInsertedIdDB()
    {
        $id = DB::table('leaving_notices')->max('id');
        return $id;
        
    }
    protected function setupCreateOperation()
    {
        $id = $this->getLastInsertedIdDB();
        CRUD::setValidation(LeavingNoticeRequest::class);
        $this->crud->addField([   // Date
            'name' => 'ref_no',
            'label' => 'Reference Number',         
            'default' => 'REF/LEAVINGNOTICE/'.($id + 1),
            'attributes' => ['readonly' => 'readonly']
        ]); 
        $this->crud->addField([  // Select2
            'label'     => "Child",
            'type'      => 'select2',
            'name'      => 'child_id', // the db column for the foreign key
         
            // optional
            'entity'    => 'child', // the method that defines the relationship in your Model
            'model'     => "App\Models\Child", // foreign key model
            'attribute' => 'fullname' // foreign key attribute that is shown to user
           
         
            ],);       
        //CRUD::field('project_id');
        
        CRUD::field('date');
        CRUD::field('date_of_removal');
        CRUD::field('reason'); 
        $this->crud->addField([  // Select2
            'label'     => "Copy to",            
            'name'      => 'copy_to', // the db column for the foreign key
         
         ]);  
         $this->crud->addField([  // Select2
            'label'     => "Informed by",
            'type'      => 'select2',
            'name'      => 'user_id', // the db column for the foreign key
         
            // optional
            'entity'    => 'user', // the method that defines the relationship in your Model
            'model'     => "App\Models\User", // foreign key model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'default'   => 2, // set the default value of the select2); 
         ]);

         $this->crud->addField([  // Select2
            'label'     => "Message to",
            'name'      => 'message_to', // the db column for the foreign key  
         ]);           
        //CRUD::field('sponsor_id');
        CRUD::field('created_at');
        CRUD::field('updated_at');
        
        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    public function generatePDF($id, $in)
    {
        //$biodata = Bio::find($id);
        //$child =  Child::find($biodata->child_id);
        //$dob = $child->dob;
        //$result = Project::with('children')->get();
        $leaving = LeavingNotice::find($id);
        if ($leaving == null) {
            return;
        }
        

        $child1 = Child::find($leaving->child_id);

        $child = DB::table('sponsor_child')
        ->join('sponsors', 'sponsor_child.sponsor_id', '=', 'sponsors.id')
        ->join('children', 'children.id', '=', 'sponsor_child.child_id')
        ->join('projects', 'projects.id', '=', 'sponsors.project_id')        
            ->select('sponsors.name as s_name', 'sponsors.address as s_address', 'sponsors.sponsor_number', 'projects.name as p_name', 'projects.project_number', 'children.allocated','children.resident','children.name as ch_name','children.dob', )
            ->where('children.allocated' , 1)
            ->where('sponsor_child.child_id', $leaving->child_id)
            ->get();

        
        $project1 = [];
        $project_number = [];
        $sponsor1 = [];
        $sponsor_address = [];
        $sponsor_number = [];
       // dd($child->projects);



        foreach ($child as $ch) {
            $project1[] = $ch->p_name;
            $project_number[] = $ch->project_number;
            $sponsor1[] = $ch->s_name;
            $sponsor_address[] = $ch->s_address;
            $sponsor_number[] = $ch->sponsor_number;
        }
        
        
        $informed_by = LeavingNotice::find($id);
        $user =  User::find($informed_by->user_id);
        //dd($informed_by);
        $data = [
            'reference_number' => 'REF/LEAVINGNOTICE/'.$id,
            'bio_data' => 'REF_BIODATA_'.$id,
            'date' => $in['date'],
            'logo' => base_path('storage/photos/mv_logo.png'),
            'name' => $child1->name,
            'dob' => $child1->dob,
            'project' => implode(', ', $project1),
            'project_number' => implode(', ', $project_number), 
            'sponsor' => implode(', ', $sponsor1),
            'sponsor_address' => implode('• ', $sponsor_address),
            'sponsor_number' => implode(', ', $sponsor_number),
             'reason' => $in['reason'],
             'date_of_removal' => $in['date_of_removal'],
            'informed_by' => $user->name,
            'copy_to' => $in['copy_to']


        ];

        //dd($data);
       

        // Make sure you've got the Page model
        if($child1) {
            $child1->removed = true;
            $child1->save();
        }
                
        $pdf = PDF::loadView('lNotice', $data);
        $content = $pdf->download()->getOriginalContent();
          $disk = Storage::build([
    'driver' => 'local',
    'root' => 'pdfs',
]);
    
        $disk->put('REF_LEAVINGNOTICE_'.$id.'.pdf',$content);
    
        
    }
}
