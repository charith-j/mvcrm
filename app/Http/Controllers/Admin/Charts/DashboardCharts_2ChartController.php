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
class DashboardCharts_2ChartController extends ChartController
{
    public function setup()
    {
    $allocated = DB::table('children')
    ->select('first_name')
    ->where('allocated','=','1')
    ->count();

    $non_allocated = DB::table('children')
    ->select('first_name')
    ->where('allocated','=','0')
    ->count();

  

        $this->chart = new Chart();

        $this->chart->dataset('green', 'pie', [$allocated,$non_allocated])
                    ->backgroundColor([
                        'rgb(222, 222, 222)',
                        'rgb(244, 22, 155)',
                        
                        
                    ]);

        // OPTIONAL
        $this->chart->displayAxes(false);
        $this->chart->displayLegend(true);

        // MANDATORY. Set the labels for the dataset points
        $this->chart->labels(['Allocated', 'Non-allocated']);
        $this->chart->load(backpack_url('charts/dashboard-charts_2'));

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