<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('words', function (Blueprint $table) {
            $table->bigincrements('id');
            $table->text('word');
            $table->integer('word_type');// 0->name   1-verb
            $table->string('word_gzer');
            $table->string('gzer_type');
            $table->string('gzer_weight');
            $table->string('word_status');
            $table->string('word_source');
            $table->string('word_indication');
            $table->text('word_plural');
            $table->string('word_singular');
            $table->text('word_derivatives');
            $table->string('word_object');
            $table->integer('search_no')->nullable();
            $table->integer('admin_id');
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
        Schema::dropIfExists('words');
    }
}
