<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormSubjectAreaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_subject_area', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('form_id')->nullable();
            $table->foreign('form_id')->references('id')->on('forms')->onDelete('cascade');
            $table->unsignedInteger('subject_area_id')->nullable();
            $table->foreign('subject_area_id')->references('id')->on('subject_areas')->onDelete('cascade');
            $table->decimal('marks',8,2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('form_subject_area', function (Blueprint $table) {
            //
        });
    }
}
