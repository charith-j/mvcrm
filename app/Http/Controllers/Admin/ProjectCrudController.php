<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProjectRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ProjectCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ProjectCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\InlineCreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\FetchOperation;
    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Project::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/project');
        CRUD::setEntityNameStrings('project', 'projects');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('id');
        CRUD::column('name');
        CRUD::column('project_number');
        $this->crud->addColumn([
            'name' => 'coordinator',
            'type' => 'relationship',
            'label' => 'Coordinator',
            'attribute' => 'coordinator'
            ]);
        CRUD::column('address');
        CRUD::column('phone_number');
        CRUD::column('email');
        CRUD::column('user_id');
        $this->crud->addColumn([
            'name' => 'bank',
            'type' => 'relationship',
            'label' => 'Bank',
            'attribute' => 'bankbranch'
            ]);
        CRUD::column('country');
        CRUD::column('created_at');
        CRUD::column('updated_at');

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }

    protected function setupShowOperation(){
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
        CRUD::setValidation(ProjectRequest::class);

        CRUD::field('name');
        CRUD::field('project_number');
        $this->crud->addField([
            'type' => "relationship",
            'name' => 'coordinator', // the method on your model that defines the relationship
            'ajax' => true,           
            'inline_create' => [ 'entity' => 'coordinator', 'data_source'=> '/admin/project/'], // specify the entity in singular
           
            // that way the assumed URL will be "/admin/tag/inline/create"
        ]);
        CRUD::field('address');
        CRUD::field('phone_number');
        CRUD::field('email');
        CRUD::field('user_id');
        
        $this->crud->addField([  // Select2
            'label'     => "Bank",
            'type'      => 'relationship',
            'name' => 'bank',
            'ajax' => true,           
            'inline_create' => [ 'entity' => 'bank', 'data_source'=> '/admin/project/'], // specify the entity in singular
             'attribute' => 'fullname'
            ]); 

            $this->crud->addField([   // select_from_array
                'name'        => 'country',
                'label'       => "Country",
                'type'        => 'select_from_array',
                'options'     => ['Sri Lanka' => 'Sri Lanka', 'India' => 'India', 
                                  'Thailand' => 'Thailand'],
                'allows_null' => false,
                'default'     => 'Sri Lanka',
                // 'allows_multiple' => true, // OPTIONAL; needs you to cast this to array in your model;
            ]); 

        CRUD::field('created_at');
        CRUD::field('updated_at');

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
    }

    protected function setupInlineCreateOperation()
    {
        CRUD::setValidation(ProjectRequest::class);

        $this->setupCreateOperation();

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

    protected function fetchCoordinator()
    {
        return $this->fetch([
            'model' => \App\Models\Coordinator::class, // required
            'searchable_attributes' => ['name'],          
            'query' => function($model) {
                return $model;
            } // to filter the results that are returned
        ]);
    }

}
