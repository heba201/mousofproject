<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropWordColumnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('words', function (Blueprint $table) {
            $table->dropColumn('word_gzer');
            $table->dropColumn('word_source');
            $table->dropColumn('word_indication');
            $table->dropColumn('word_status');
            $table->dropColumn('word_plural');
            $table->dropColumn('word_singular');
            $table->dropColumn('word_object');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('words', function (Blueprint $table) {
            //
        });
    }
}
