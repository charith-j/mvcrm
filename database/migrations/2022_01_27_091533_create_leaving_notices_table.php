<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeavingNoticesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leaving_notices', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->date('date_of_removal');
            $table->string('ref_no');
            $table->text('pdf');
            $table->text('reason');
            $table->foreignId('child_id')->references('id')->on('children')->onDelete('cascade');
            //$table->foreignId('project_id')->references('id')->on('projects')->onDelete('cascade');
            //$table->foreignId('sponsor_id')->references('id')->on('sponsors')->onDelete('cascade');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('copy_to');
            $table->text('message_to');
            $table->integer('status');
            $table->string('status_textd');
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
        Schema::dropIfExists('leaving_notices');
    }
}
