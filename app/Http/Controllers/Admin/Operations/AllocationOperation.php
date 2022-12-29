<?php

namespace App\Http\Controllers\Admin\Operations;

use Illuminate\Support\Facades\Route;

trait AllocationOperation
{
    /**
     * Define which routes are needed for this operation.
     *
     * @param string $segment    Name of the current entity (singular). Used as first URL segment.
     * @param string $routeName  Prefix of the route name.
     * @param string $controller Name of the current CrudController.
     */
    protected function setupAllocationRoutes($segment, $routeName, $controller)
    {
        Route::get($segment.'/{id}/allocation', [
            'as'        => $routeName.'.allocation',
            'uses'      => $controller.'@allocation',
            'operation' => 'allocation',
        ]);
    }

    /**
     * Add the default settings, buttons, etc that this operation needs.
     */
    protected function setupAllocationDefaults()
    {
        $this->crud->allowAccess('allocation');

        $this->crud->operation('allocation', function () {
            $this->crud->loadDefaultOperationSettingsFromConfig();
        });

        $this->crud->operation('list', function () {
            // $this->crud->addButton('top', 'allocation', 'view', 'crud::buttons.allocation');
            // $this->crud->addButton('line', 'allocation', 'view', 'crud::buttons.allocation');
        });
    }

    /**
     * Show the view for performing the operation.
     *
     * @return Response
     */
    public function allocation()
    {
        $this->crud->hasAccessOrFail('allocation');

        // prepare the fields you need to show
        $this->data['crud'] = $this->crud;
        $this->data['title'] = $this->crud->getTitle() ?? 'allocation '.$this->crud->entity_name;

        // load the view
        return view("crud::operations.allocate_form", $this->data);
    }
}
