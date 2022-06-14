<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToFormSubjectAreaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('form_subject_area', function (Blueprint $table) {
            $table->boolean('status_verifier')->default(0);
            $table->boolean('status_auditor')->default(0);
            $table->boolean('status_final_verifier')->default(0);
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
