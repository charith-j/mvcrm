<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChildrenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('children', function (Blueprint $table) {
            $table->id();
            $table->string('ref_number')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('gender');
            $table->date('dob');
            $table->string('ethnicity');
            $table->string('religion');
            $table->foreignId('bank_id')->references('id')->on('banks')->onDelete('cascade');
            $table->integer('grade');
            $table->string('school');
            $table->text('interests');
            $table->integer('no_of_younger_bros');
            $table->integer('no_of_elder_bros');
            $table->integer('no_of_younger_sis');
            $table->integer('no_of_elder_sis');
            $table->string('name_of_father');            
            $table->integer('age_of_father');            
            $table->string('name_of_mother');
            $table->integer('age_of_mother');
            $table->text('details_of_child');
            $table->longtext('picture');
            $table->longtext('picture2');
            $table->boolean('resident');
            $table->boolean('removed');
            $table->boolean('allocated');
            $table->date('allocated_date');
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
        Schema::dropIfExists('children');
    }
}
