<?php

namespace App\Http\Controllers\Admin;
use App\Mail\Mailer;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\BioRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use DB;
use PDF;
use Storage;
use URL;
use App\Models\Child;
use App\Models\Bio;
use App\Models\Project;
/**
 * Class BioCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class BioCrudController extends CrudController
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
        $request->add(['pdf'=>'REF_BIODATA_'.($id + 1).'.pdf']);
        $request->add(['status_text' => "No"]);

        
        
        $response = $this->traitStore();
        $this->generatePDF($id + 1, $request->get('date'));
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
        CRUD::setModel(\App\Models\Bio::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/bio');
        CRUD::setEntityNameStrings('bio data', 'bio data');
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
        $this->crud->addColumn([
            'name'=>'fullname',
            'label' => 'Full Name'
        
        ]);        
        CRUD::column('date');        
        CRUD::column('ref_no');
        $this->crud->addColumn([
            // Select
            'label'     => 'Bio Data',  
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

    public function getLastInsertedIdDB()
{
	$id = DB::table('bios')->max('id');
    return $id;
	
}

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        $id = $this->getLastInsertedIdDB();
        
        CRUD::setValidation(BioRequest::class);

        $this->crud->addField([  // Select2
            'label'     => "Child",
            'type'      => 'select2',
            'name'      => 'child_id', // the db column for the foreign key
         
            // optional
            'entity'    => 'child', // the method that defines the relationship in your Model
            'model'     => "App\Models\Child", // foreign key model
            'attribute' => 'name' // foreign key attribute that is shown to user
           
         
            ],);       
        CRUD::field('date');    
        $this->crud->addField([   // Date
            'name' => 'ref_no',
            'label' => 'Reference Number',         
            'default' => 'REF/BIODATA/'.($id + 1),
            'attributes' => ['readonly' => 'readonly']
        ]);
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

    public function sendEmail($name, $type) {
        $details = [
            'name' => $name,
            'type' => $type,
            'verb' => 'added',
            'subject' => 'BIO DATA'
        ];

        $email =  DB::table('emails')
        ->select(array('id', 'e_one', 'e_two'))
        ->where('id', 1)
        ->get();

        $emails = null;

        foreach($email as $e) {
        $emails['one']= $e->e_one;
        $emails['two'] = $e->e_two;
        }

        Mail::to($emails['two'])->send(new Mailer($details));
        return "Email Sent";
    }

    public function generatePDF($id, $date)
    {
        $biodata = Bio::find($id);
        if ($biodata == null) {
            return;
        }
        
        
        $child =  Child::find($biodata->child_id);
        $dob = $child->dob;
        $result = Project::with('children')->get();
        //dd($result);
        $today = date("Y-m-d");
        $diff = date_diff(date_create($dob), date_create($today));
        $age = $diff->format('%y');
        $project1 = [];
        foreach ($child->projects as $project) {
            $project1[] = $project->name;
        }

        $project_number = [];
        foreach ($child->projects as $project) {
            $project_number[] = $project->project_number;
        }

        $coordinator =[];
        foreach ($child->projects as $project) {
            $coordinator[] = $project->coordinator->title." ".$project->coordinator->name;
        }
        
        //dd(base_path('public/photos/'.$child->picture));
        $data = [
            'reference_number' => 'REF/BIODATA/'.$id,
            'bio_data' => 'REF_BIODATA_'.$id,
            'date' => $date,
            'name' => $child->name,
            'common_name' => $child->common_name,
            'image1' => base_path('public/'.$child->picture),
            'image2' => base_path('public/'.$child->picture2),
            'logo' => base_path('storage/photos/mv_logo.png'),
            'gender' => $child->gender,
            'dob' => $child->dob,
            'age' => $age." Years",
            'ethnicity' => $child->ethnicity,
            'religion' => $child->religion,
            'grade' => $child->grade,
            'school' => $child->school,
            'interests' => $child->interests,
            'name_of_father' => $child->name_of_father,
            'name_of_mother' => $child->name_of_mother,
            'age_of_father' => $child->age_of_father,
            'age_of_mother' => $child->age_of_mother,
            'no_of_younger_bros' => $child->no_of_younger_bros,
            'no_of_elder_bros' => $child->no_of_elder_bros,
            'no_of_younger_sis' => $child->no_of_younger_sis,
            'no_of_elder_sis' => $child->no_of_elder_sis,
            'details_of_child' => $child->details_of_child,
            'project' => implode(",", $project1),
            'project_number' => implode(",",$project_number),
            'coordinator' => implode(",",$coordinator)
        ];

        //dd($data);
          
        $pdf = PDF::loadView('myPDF', $data);
        $content = $pdf->download()->getOriginalContent();
        
         $disk = Storage::build([
    'driver' => 'local',
    'root' => 'pdfs',
]);
        $disk->put('REF_BIODATA_'.$id.'.pdf',$content);
        $this->sendEmail($child->name, "BIO DATA");
        
    }
}
