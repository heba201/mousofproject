<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColsToMojjamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mojjams', function (Blueprint $table) {
            $table->integer('author_id');
            $table->integer('mojjamarrangetype_id');
            $table->integer('mojjammethod_id');
            $table->integer('mojjamspecialty_id');
            $table->string('example');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mojjams', function (Blueprint $table) {
            //
        });
    }
}
