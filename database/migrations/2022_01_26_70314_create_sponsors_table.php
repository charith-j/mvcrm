<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSponsorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sponsors', function (Blueprint $table) {
            $table->id();
            $table->string('sponsor_nummber');
            $table->string('name')->unique();
            $table->string('membership');
            $table->foreignId('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->text('address');
            $table->string('postal_number');
            $table->text('location');
            $table->string('email');
            $table->text('contact_person');
            $table->dateTime('start_date');
            $table->date("date_of_removal");
            $table->boolean("removed");
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
        Schema::dropIfExists('sponsors');
    }
}
