<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOptionIdToFormSujectAreaParameterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('form_subject_area_parameter', function (Blueprint $table) {
            $table->unsignedInteger('option_id')->nullable();
            $table->foreign('option_id')->references('id')->on('options')->onDelete('cascade');
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
