<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CoordinatorRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CoordinatorCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CoordinatorCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\InlineCreateOperation;
    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Coordinator::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/coordinator');
        CRUD::setEntityNameStrings('coordinator', 'coordinators');
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
        $this->crud->addColumn([
            'name' => 'coordinator',
            'type' => 'text',
            'label' => 'Coordinator Name',
         
            ]);
        $this->crud->addColumn([
            'name' => 'Project.address',
            'type' => 'text',
            'label' => 'Address',
            
            ]);
            $this->crud->addColumn([
            'name' => 'Project.email',
            'type' => 'text',
            'label' => 'Email',
           
            ]);
        
        CRUD::column('phone_number_1');
        CRUD::column('phone_number_2');
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
        CRUD::setValidation(CoordinatorRequest::class);

       $this->crud->addField([   // select_from_array
                'name'        => 'title',
                'label'       => "Title",
                'type'        => 'select_from_array',
                'options'     => ['Rev. Sr.' => 'Rev. Sr.', 'Rev. Br.' => 'Rev. Br.', 'Ven.' => 'Ven.',
                                  'Mr.' => 'Mr.', 'Mrs.' => 'Mrs.', 'Ms.' => 'Ms.'],
                'allows_null' => false,
                'default'     => 'Rev. Sr.',
                // 'allows_multiple' => true, // OPTIONAL; needs you to cast this to array in your model;
            ]); 
        CRUD::field('name');
        CRUD::field('address');
        CRUD::field('email');
        CRUD::field('phone_number_1');
        CRUD::field('phone_number_2');
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
    protected function setupShowOperation()
    {
        $this->setupListOperation();
    }

    protected function setupInlineCreateOperation()
    {
        CRUD::setValidation(CoordinatorRequest::class);       
        CRUD::field('name');
        CRUD::field('address');
        CRUD::field('email');
        CRUD::field('phone_number_1');
        CRUD::field('phone_number_2');
        CRUD::field('created_at');
        CRUD::field('updated_at');

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
    }
}
