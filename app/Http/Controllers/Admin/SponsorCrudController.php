<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SponsorRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class SponsorCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class SponsorCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Sponsor::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/sponsor');
        CRUD::setEntityNameStrings('sponsor', 'sponsors');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
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
        CRUD::column('id');
        CRUD::column('sponsor_number');
        $this->crud->addColumn([
            'name' => 'sponsorname',
            'type' => 'text',
            'label' => 'Sponsor Name',
            
            ]);
        CRUD::column('membership');
        CRUD::column('project_id');
        CRUD::column('address');
        CRUD::column('postal_number');
        CRUD::column('location');
        CRUD::column('email');
        CRUD::column('contact_person');
        CRUD::column('start_date');
        CRUD::column('date_of_removal');
         $this->crud->addColumn([
            'name'    => 'removed',
            'label'   => 'Removed',
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
        CRUD::column('reason_for_removal');
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
    protected function setupCreateOperation()
    {
        CRUD::setValidation(SponsorRequest::class);
        
        $this->crud->addField([   // select_from_array
                'name'        => 'title',
                'label'       => "Title",
                'type'        => 'select_from_array',
                'options'     => ['Mr.' => 'Mr.', 'Mrs.' => 'Mrs.', 'Ms.' => 'Ms.'],
                'allows_null' => false,
                'default'     => 'Mr.',
                // 'allows_multiple' => true, // OPTIONAL; needs you to cast this to array in your model;
            ]); 
        
        $this->crud->addField([
            'name' => 'sponsor_number', // the db column name (attribute name)
            'label' => "Sponsor Number", // the human-readable label for it          
        ]);
        CRUD::field('name');
        CRUD::field('membership');
        //CRUD::field('project_id');
        
        CRUD::field('address');
        CRUD::field('postal_number');
        $this->crud->addField([   // Address google
            'name'          => 'location',
            'label'         => 'Location',
            'type'          => 'text',
            // optional
            'store_as_json' => true
        ]);

        CRUD::field('email');
        CRUD::field('contact_person');
        CRUD::field('start_date');
        CRUD::field('date_of_removal');
        CRUD::field('removed');
        CRUD::field('reason_for_removal');
        CRUD::field('created_at');
        CRUD::field('updated_at');

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
    }
    protected function fetchProject()
    {
        return $this->fetch([
            'model' => \App\Models\Project::class, // required
            'searchable_attributes' => ['name'],          
            'query' => function($model) {
                return $model;
            } // to filter the results that are returned
        ]);
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
    
    protected function setupShowOperation() {
        $this->setupListOperation();
    }
}
