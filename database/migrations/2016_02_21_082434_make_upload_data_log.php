<?php


use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeUploadDataLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        	Schema::create('upload_log', function (Blueprint $table) {
	            $table->increments('id');
	            $table->string('last_record');
	            $table->index(array("last_record"));
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
    	Schema::drop('upload_log');
    }
}
