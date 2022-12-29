<?php

use Illuminate\Support\Facades\Route;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::group(['middleware' => 'can:children'], function () {
        Route::crud('child', 'ChildCrudController');
    });
    Route::group(['middleware' => 'can:banks'], function () {
    Route::crud('bank', 'BankCrudController');
    });
    Route::group(['middleware' => 'can:coordinators'], function () {
    Route::crud('coordinator', 'CoordinatorCrudController');
    });
    Route::group(['middleware' => 'can:projects'], function () {
    Route::crud('project', 'ProjectCrudController');
    });

    Route::group(['middleware' => 'can:sponsors'], function () {
    Route::crud('sponsor', 'SponsorCrudController');
    });

    Route::group(['middleware' => 'can:biodata'], function () {
    Route::crud('bio', 'BioCrudController');
    });
    
    Route::group(['middleware' => 'can:leaving-notices'], function () {
    Route::crud('leaving-notice', 'LeavingNoticeCrudController');
    });

    Route::group(['middleware' => 'can:authentication'], function () {
    Route::crud('user', 'UserCrudController');
    });

    Route::group(['middleware' => 'can:gifts'], function () {
    Route::crud('gift', 'GiftCrudController');
    });
    Route::group(['middleware' => 'can:dashboard'], function () {
    Route::get('charts/dashboard-charts', 'Charts\DashboardChartsChartController@response')->name('charts.dashboard-charts.index');
    Route::get('charts/dashboard-charts_2', 'Charts\DashboardCharts_2ChartController@response')->name('charts.dashboard-charts.index');
    Route::get('charts/dashboard-charts_3', 'Charts\DashboardCharts_3ChartController@response')->name('charts.dashboard-charts.index');
    });
}); // this should be the absolute last line of this file
