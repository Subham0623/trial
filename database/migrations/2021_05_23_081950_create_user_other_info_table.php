<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserOtherInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id')->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('can_read_book')->default(0);
            $table->string('contact')->nullable();
            $table->string('age')->nullable();
            $table->string('gender')->nullable();
            $table->string('province')->nullable();
            $table->string('district')->nullable();
            $table->string('muncipality')->nullable();
            $table->string('ward')->nullable();
            $table->string('street_name')->nullable();
            $table->string('teaching_level')->nullable();
            $table->string('subject')->nullable();
            $table->string('institute')->nullable();
            $table->string('institute_contact')->nullable();
            $table->string('institute_province')->nullable();
            $table->string('institute_district')->nullable();
            $table->string('institute_muncipality')->nullable();
            $table->string('institute_ward')->nullable();
            $table->string('institute_street_name')->nullable();
            $table->string('institute_principal')->nullable();
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
        Schema::dropIfExists('user_other_info');
    }
}
