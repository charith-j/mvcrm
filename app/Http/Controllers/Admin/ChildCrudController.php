<?php

namespace App\Http\Controllers\Admin;
use \App\Models\Project;
use App\Http\Requests\ChildRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use URL;
use DB;
/**
 * Class ChildCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ChildCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\FetchOperation;
    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Child::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/child');
          CRUD::setEntityNameStrings('child', 'children');
    }


    public function getLastInsertedIdDB()
{
	$id = DB::table('children')->max('id');
    return $id;
	
}

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $url  = \Request::fullUrl();
        // dropdown filter
        $this->crud->addFilter([
            'name'  => 'removed',
            'type'  => 'dropdown',
            'label' => 'Removed'
        ], [
            0 => 'No',
            1 => 'Yes'
        ], function($value) { // if the filter is active
                //dd($value);
                $this->crud->addClause('where', 'removed', $value);
           
        }
        );

        $this->crud->addFilter([
            'name'  => 'allocated',
            'type'  => 'dropdown',
            'label' => 'Allocated'
        ], [
            0 => 'No',
            1 => 'Yes'
        ], function($value) { // if the filter is active
                //dd($value);
                $this->crud->addClause('where', 'allocated', $value);
           
        }
        );
        CRUD::column('id');
        CRUD::column('ref_number');
        CRUD::column('name');
       
        CRUD::column('gender');
        CRUD::column('dob');
        CRUD::column('ethnicity');
        CRUD::column('religion');
        $this->crud->addColumn([  
            // any type of relationship
            'name'         => 'projects', // name of relationship method in the model
            'type'         => 'relationship',
            'label'        => 'Projects', // Table column heading
            // OPTIONAL
            // 'entity'    => 'tags', // the method that defines the relationship in your Model
            // 'attribute' => 'name', // foreign key attribute that is shown to user
            // 'model'     => App\Models\Category::class, // foreign key model
        ]);
        $this->crud->addColumn([
            'name' => 'bank',
            'type' => 'relationship',
            'label' => 'Bank',
            'attribute' => 'bankbranch'
            ]);
        CRUD::column('grade');
        CRUD::column('school');
        CRUD::column('interests');
        CRUD::column('no_of_younger_bros');
        CRUD::column('no_of_elder_bros');
        CRUD::column('no_of_younger_sis');
        CRUD::column('no_of_elder_sis');
        CRUD::column('name_of_father');
        CRUD::column('age_of_father');
        CRUD::column('name_of_mother');
        CRUD::column('age_of_mother');
        CRUD::column('details_of_child');
        $this->crud->addColumn([
            'name'      => 'picture', // The db column name
            'label'     => 'Photo of Child', // Table column heading
            'type'      => 'image',
            //'prefix' => 'uploads/photos/',
            // image from a different disk (like s3 bucket)
            // 'disk'   => 'disk-name', 
            // optional width/height if 25px is not ok with you
            // 'height' => '30px',
            // 'width'  => '30px',
        ]);
        $this->crud->addColumn([
            'name'      => 'picture2', // The db column name
            'label'     => 'Photo of Child', // Table column heading
            'type'      => 'image',
            //'prefix' => 'uploads/photos/',
            // image from a different disk (like s3 bucket)
            // 'disk'   => 'disk-name', 
            // optional width/height if 25px is not ok with you
            // 'height' => '30px',
            // 'width'  => '30px',
        ]);
     
        $this->crud->addColumn([
            'name'    => 'resident',
            'label'   => 'Resident',
            'type'    => 'boolean',
            'options' => [0 => 'No', 1 => 'Yes'], // optional
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
        $this->crud->removeButton('delete');
        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }
    
    protected function setupShowOperation() {
        $this->setupListOperation();
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
        CRUD::setValidation(ChildRequest::class);
        $this->crud->addField([
            'name' => 'id', // the db column name (attribute name)
            'label' => "Child ID", // the human-readable label for it
            'default' => ($id + 1),
            'attributes' => ['readonly' => 'readonly'],
            'tab'             => 'Personal',         
        ]);
        $this->crud->addField([
            'name' => 'ref_number', // the db column name (attribute name)
            'label' => "Reference Number", // the human-readable label for it
            'default' => 'REF/CHILD/'.($id + 1),
            'attributes' => ['readonly' => 'readonly'],
            'tab'             => 'Personal',         
        ]);
        $this->crud->addField([
            'name'            => 'name',
            'label'           => "Name of Child",
            'tab'             => 'Personal',  
            
        ]);
        $this->crud->addField([
            'name'            => 'common_name',
            'label'           => "Common Name",
            'tab'             => 'Personal',  
            
        ]);
      
      
        $this->crud->addField([   // select_from_array
            'name'        => 'gender',
            'label'       => "Gender",
            'type'        => 'select_from_array',
            'options'     => ['Male' => 'Male', 'Female' => 'Female', 
                              'Other' => 'Other'],
            'allows_null' => true,
            'tab'             => 'Personal', 
            
            // 'allows_multiple' => true, // OPTIONAL; needs you to cast this to array in your model;
        ]); 
        $this->crud->addField([
            'name' => 'dob', // the db column name (attribute name)
            'label' => "Date of Birth", // the human-readable label for it
            'type' => 'date', // the kind of column to show
            'tab'             => 'Personal', 
        ]);
        $this->crud->addField([   // select_from_array
            'name'        => 'ethnicity',
            'label'       => "Ethnicity",
            'type'        => 'select_from_array',
            'options'     => ['Sinhalese' => 'Sinhalese', 'Tamil' => 'Tamil', 
                              'Burgher' => 'Burgher', 'Muslim' => 'Muslim', 'Thai' => 'Thai', 'Burmese'=>'Burmese', 'Indian'=> 'Indian', 'Other'=> 'Other'],
            'allows_null' => false,
            'default'     => 'Sinhalese',
            'tab'             => 'Personal', 
            // 'allows_multiple' => true, // OPTIONAL; needs you to cast this to array in your model;
        ]);    

        $this->crud->addField([   // select_from_array
            'name'        => 'religion',
            'label'       => "Religion",
            'type'        => 'select_from_array',
            'options'     => ['Buddhist' => 'Buddhist', 'Roman_catholic' => 'Roman Catholic', 
                              'Hindu' => 'Hindu', 'Islam' => 'Islam'],
            'allows_null' => false,
            'default'     => 'Buddhist',
            'tab'             => 'Personal', 
            // 'allows_multiple' => true, // OPTIONAL; needs you to cast this to array in your model;
        ]);
        
         $this->crud->addField([
            'name' => 'no_of_younger_bros', // the db column name (attribute name)
            'label' => "Number of Younger Brothers", // the human-readable label for it
            'type' => 'number', // the kind of column to show
            "attributes" => ["min"=>"0", "max"=>"20"],
            "default" => 0,
            'tab'             => 'Family',  
        ]);
        $this->crud->addField([
            'name' => 'no_of_elder_bros', // the db column name (attribute name)
            'label' => "Number of Elder Brothers", // the human-readable label for it
            'type' => 'number', // the kind of column to show
            "attributes" => ["min"=>"0", "max"=>"20"],
             "default" => 0,
             'tab'             => 'Family',  
            ]);
        $this->crud->addField([
            'name' => 'no_of_younger_sis', // the db column name (attribute name)
            'label' => "Number of Younger Sisters", // the human-readable label for it
            'type' => 'number', // the kind of column to show
            "attributes" => ["min"=>"0", "max"=>"20"],
             "default" => 0,
             'tab'             => 'Family',  
        ]);
        $this->crud->addField([
            'name' => 'no_of_elder_sis', // the db column name (attribute name)
            'label' => "Number of Elder Sisters", // the human-readable label for it
            'type' => 'number', // the kind of column to show
            "attributes" => ["min"=>"0", "max"=>"20"],
             "default" => 0,
             'tab'             => 'Family',  
        ]);
        
        $this->crud->addField([
            'name' => 'name_of_father', // the db column name (attribute name)
            'label' => "Name of Father", // the human-readable label for it
            "attributes" => ["min"=>"0", "max"=>"200"],
            'tab'             => 'Family',  
        ]);
        
      
        $this->crud->addField([
            'name' => 'age_of_father', // the db column name (attribute name)
            'label' => "Age of Father", // the human-readable label for it
            'type' => 'number', // the kind of column to show
            "attributes" => ["min"=>"0", "max"=>"200"],
            'tab'             => 'Family',  
        ]);
        
        $this->crud->addField([
            'name' => 'name_of_mother', // the db column name (attribute name)
            'label' => "Name of Mother", // the human-readable label for it
            "attributes" => ["min"=>"0", "max"=>"200"],
            'tab'             => 'Family',  
        ]);
        
        
        $this->crud->addField([
            'name' => 'age_of_mother', // the db column name (attribute name)
            'label' => "Age of Mother", // the human-readable label for it
            'type' => 'number', // the kind of column to show
            "attributes" => ["min"=>"0", "max"=>"200"],
            'tab'             => 'Family',  
        ]);

        $this->crud->addField([
            'type' => "relationship",
            'name' => 'projects', // the method on your model that defines the relationship
            'ajax' => true,
            'multiple' => true,
            'inline_create' => [ 'entity' => 'project', 'data_source'=> '/admin/project/'], // specify the entity in singular
            'tab'             => 'Project', 
            // that way the assumed URL will be "/admin/tag/inline/create"
        ]);
       
        $this->crud->addField([  // Select2
            'label'     => "Bank",
            'type'      => 'relationship',
            'name' => 'bank',
            'ajax' => true,           
            'inline_create' => [ 'entity' => 'bank', 'data_source'=> '/admin/bank/'], // specify the entity in singular
             'attribute' => 'fullname',
             'tab'             => 'Project', 
            ]); 
        
     
        $this->crud->addField([
            'name'            => 'school',
            'label'           => "School",
            'tab'             => 'Education',  
            
        ]);
       
        $this->crud->addField([
            'name'            => 'grade',
            'label'           => "Grade",
            'tab'             => 'Education',  
            
        ]);

        $this->crud->addField([
            'name'            => 'gpa',
            'label'           => "GPA",
            'tab'             => 'Education',  
            
        ]);

        $this->crud->addField([
            'name'            => 'education',
            'label'           => "Educational Background",
            'type' => 'ckeditor',
            'escaped' => false,
            'tab'             => 'Education',  
            
        ]);
        
        $this->crud->addField([
            'name'            => 'interests',
            'label'           => "Interests",
            'tab'             => 'Other',  
            
        ]);
       
        $this->crud->addField([
            'name'            => 'details_of_child',
            'label'           => "Details of Child",
            'tab'             => 'Other',
            'type' => 'ckeditor',
            'escaped' => false
            
        ]);

        $this->crud->addField([ // image
            'label' => "Photo of Child <span class='badge badge-primary'>Bust</span>",
            'name' => "picture",
            'type' => 'image',
            'upload' => true,
            'disk' => 'public',
            'crop' => true, // set to true to allow cropping, false to disable
            'aspect_ratio' => 1, // omit or set to 0 to allow any aspect ratio
            'prefix'    => 'photos',
            'tab'             => 'Personal', 
            ],'both');
            

        $this->crud->addField([ // image
            'label' => "Photo of Child <span class='badge badge-primary'>Full</span>",
            'name' => "picture2",
            'type' => 'image',
            'upload' => true,
            'disk' => 'public',
            'crop' => true, // set to true to allow cropping, false to disable
            'aspect_ratio' => 1, // omit or set to 0 to allow any aspect ratio
            'prefix'    => 'photos',
            'tab'             => 'Personal', 
        ],'both');
        
        
        $this->crud->addField([
            'name'            => 'resident',
            'label'           => "Resident",
            'tab'             => 'Personal',  
            
        ]);
     
         $this->crud->addField([
            'name'            => 'created_at',
            'label'           => "created_at",
            'tab'             => 'Other',  
            
        ]);
        
        $this->crud->addField([
            'name'            => 'updated_at',
            'label'           => "updated_at",
            'tab'             => 'Other',  
            
        ]);
        $this->crud->addField([
            'name'            => 'removed',
            'label'           => "Removed",
            'tab'             => 'Other',  
            
        ]);
        
        $this->crud->addField([
            'name'            => 'removed_date',
            'label'           => "Removed Date",
            'tab'             => 'Other',  
            
        ]);

        $this->crud->addField([
            'name'            => 'bank_balance',
            'label'           => "Bank Balance",
            'tab'             => 'Other',  
            
        ]);

        $this->crud->addField([
            'name'            => 'comments',
            'label'           => "Comments",
            'type' => 'ckeditor',
            'escaped' => false,
            'tab'             => 'Other',  
            
        ]);

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
     
    protected function fetchProjects()
    {
        return $this->fetch([
            'model' => \App\Models\Project::class, // required
            'searchable_attributes' => ['name'],          
            'query' => function($model) {
                return $model;
            } // to filter the results that are returned
        ]);
    }

    protected function fetchBank()
    {
        return $this->fetch([
            'model' => \App\Models\Bank::class, // required                     
            'query' => function($model) {
                return $model;
            }, // to filter the results that are returned
            'searchable_attributes' => ['fullname']
        ]);
    }

   

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
