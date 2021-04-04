<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColsToWisdomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('wisdoms', function (Blueprint $table) {
            $table->integer('character_id')->unsigned();
            $table->string('wisdom_photo');
            $table->text('wisdom_tag');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wisdoms', function (Blueprint $table) {
            //
        });
    }
}
