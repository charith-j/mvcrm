<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSponsorChildTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sponsor_child', function (Blueprint $table) {
            $table->foreignId('sponsor_id')->references('id')->on('sponsors')->onDelete('cascade');
            $table->foreignId('child_id')->references('id')->on('children')->onDelete('cascade');
            $table->primary(array('sponsor_id', 'child_id'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sponsor_child');
    }
}
