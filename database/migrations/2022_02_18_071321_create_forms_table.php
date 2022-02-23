<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forms', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('organization_id')->nullable();
            $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('year')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedInteger('verified_by')->nullable();
            $table->foreign('verified_by')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedInteger('audited_by')->nullable();
            $table->foreign('audited_by')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedInteger('final_verified_by')->nullable();
            $table->foreign('final_verified_by')->references('id')->on('users')->onDelete('cascade');
            $table->date('verified_at')->nullable();
            $table->date('audited_at')->nullable();
            $table->date('final_verified_at')->nullable();
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
        Schema::dropIfExists('forms');
    }
}
