<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParametersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parameters', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('title')->nullable();
            $table->integer('sort')->nullable();
            $table->string('slug')->nullable()->unique();
            $table->longText('description')->nullable();
            $table->unsignedInteger('subject_area_id')->nullable();
            $table->foreign('subject_area_id')->references('id')->on('subject_areas')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parameters');
    }
}
