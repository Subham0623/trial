<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormSubjectAreaParameterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_subject_area_parameter', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('form_subject_area_id')->nullable();
            $table->foreign('form_subject_area_id')->references('id')->on('form_subject_area')->onDelete('cascade');
            $table->unsignedInteger('parameter_id')->nullable();
            $table->foreign('parameter_id')->references('id')->on('parameters')->onDelete('cascade');
            $table->decimal('marks',8,2)->nullable();
            $table->longText('remarks')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('form_subject_area_parameter', function (Blueprint $table) {
            //
        });
    }
}
