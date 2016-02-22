<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeVariables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('variables', function (Blueprint $table) {
	            $table->increments('id');
	            $table->string('name');
	            $table->string('value');
	            $table->index("name");
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
    	Schema::drop('variables');
    }
}
