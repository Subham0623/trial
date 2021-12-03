<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('framework')->nullable();
            $table->string('published_date')->nullable();
            $table->string('software_version')->nullable();
            $table->string('compatible_browsers')->nullable();
            $table->string('slug')->nullable()->unique();
            $table->timestamps();
            $table->softDeletes();
        });

    }
}
