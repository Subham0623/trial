<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMarksByVerifierToFormSubjectAreaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('form_subject_area', function (Blueprint $table) {
            $table->decimal('marksByVerifier',8,2)->nullable();
            $table->decimal('marksByAuditor',8,2)->nullable();
            $table->decimal('marksByFinalVerifier',8,2)->nullable();
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
