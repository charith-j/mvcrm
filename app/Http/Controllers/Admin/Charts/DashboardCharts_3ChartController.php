<?php

namespace App\Http\Controllers\Admin\Charts;

use Backpack\CRUD\app\Http\Controllers\ChartController;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use DB;

/**
 * Class DashboardChartsChartController
 * @package App\Http\Controllers\Admin\Charts
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class DashboardCharts_3ChartController extends ChartController
{
    public function setup()
    {
    $removed = DB::table('children')
    ->select('first_name')
    ->where('removed','=','1')
    ->count();

    $nun_removed = DB::table('children')
    ->select('first_name')
    ->where('removed','=','0')
    ->count();

  

        $this->chart = new Chart();

        $this->chart->dataset('green', 'pie', [$removed,$nun_removed])
                    ->backgroundColor([
                        'rgb(205,92,92)',
                        'rgb(0,128,0)',
                        
                        
                    ]);

        // OPTIONAL
        $this->chart->displayAxes(false);
        $this->chart->displayLegend(true);

        // MANDATORY. Set the labels for the dataset points
        $this->chart->labels(['Removed', 'Non-removed']);
        $this->chart->load(backpack_url('charts/dashboard-charts_3'));

        // OPTIONAL
        // $this->chart->minimalist(false);
        // $this->chart->displayLegend(true);
    }

    /**
     * Respond to AJAX calls with all the chart data points.
     *
     * @return json
     */
     public function data()
     {
    //     $users_created_today = \App\User::whereDate('created_at', today())->count();
    

             

    

    //$sponsors = DB::table('sponsors')
    //->select('name')
    //->get();

    //return view(backpack_view('reports'), ['project' => $project,'sponsors' => $sponsors]);
     }
}