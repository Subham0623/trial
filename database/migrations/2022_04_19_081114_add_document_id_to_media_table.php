<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDocumentIdToMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('media', function (Blueprint $table) {
            if (Schema::hasTable('media')) {
                // The "media" table exists...
                $table->unsignedInteger('document_id')->nullable();
                $table->foreign('document_id')->references('id')->on('documents')->onDelete('set null');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Media', function (Blueprint $table) {
            //
        });
    }
}
