<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHasgazercolToMojjams extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mojjams', function (Blueprint $table) {
            $table->tinyInteger('hasgazer');  //0 no gazer - 1 has gazer
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
