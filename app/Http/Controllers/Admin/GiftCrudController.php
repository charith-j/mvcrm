<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\GiftRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class GiftCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class GiftCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Gift::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/gift');
        CRUD::setEntityNameStrings('gift', 'gifts');
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
            'name'=>'fullname',
            'label' => 'Full Name'
        
        ]);  
        CRUD::column('sponsor_id');
        CRUD::column('amount');  
        CRUD::column('payment_type');
        CRUD::column('receipt_from');
        CRUD::column('receipt_to');
        CRUD::column('remarks');
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
        CRUD::setValidation(GiftRequest::class);

        CRUD::field('amount'); 
        $this->crud->addField([  // Select2
            'label'     => "Child",
            'type'      => 'select2',
            'name'      => 'child_id', // the db column for the foreign key
         
            // optional
            'entity'    => 'child', // the method that defines the relationship in your Model
            'model'     => "App\Models\Child", // foreign key model
            'attribute' => 'fullname' // foreign key attribute that is shown to user
           
         
            ],); 
        CRUD::field('sponsor_id'); 
        $this->crud->addField([   // select_from_array
            'name'        => 'payment_type',
            'label'       => "Payment Type",
            'type'        => 'select_from_array',
            'options'     => ['Cash' => 'Cash', 'Bank' => 'Bank'],
            'allows_null' => false,
            'default'     => 'Cash',
            // 'allows_multiple' => true, // OPTIONAL; needs you to cast this to array in your model;
        ]);
        CRUD::field('receipt_from');
        CRUD::field('receipt_to');
        CRUD::field('remarks');
        CRUD::field('updated_at');
        CRUD::field('created_at');
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
}
