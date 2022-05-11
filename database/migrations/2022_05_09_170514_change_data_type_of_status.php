<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDataTypeOfStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('form_subject_area', function (Blueprint $table) {
            $table->integer('status_verifier')->default(0)->change();
            $table->integer('status_auditor')->default(0)->change();
            $table->integer('status_final_verifier')->default(0)->change();
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
