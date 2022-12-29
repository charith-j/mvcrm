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
class DashboardChartsChartController extends ChartController
{
    public function setup()
    {
    $country_1 = DB::table('projects')
    ->select('country')
    ->where('country','=','Sri Lanka')
    ->count();

    $country_2 = DB::table('projects')
    ->select('country')
    ->where('country','=','India')
    ->count();

    $country_3 = DB::table('projects')
    ->select('country')
    ->where('country','=','Thailand')
    ->count();

        $this->chart = new Chart();

        $this->chart->dataset('green', 'pie', [$country_1, $country_2, $country_3])
                    ->backgroundColor([
                        'rgb(70, 127, 208)',
                        'rgb(77, 189, 116)',
                        'rgb(96, 92, 168)',
                        
                    ]);

        // OPTIONAL
        $this->chart->displayAxes(false);
        $this->chart->displayLegend(true);

        // MANDATORY. Set the labels for the dataset points
        $this->chart->labels(['Sri Lanka', 'India', 'Thailand']);
        $this->chart->load(backpack_url('charts/dashboard-charts'));

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