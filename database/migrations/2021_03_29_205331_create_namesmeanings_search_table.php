<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNamesmeaningsSearchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('namesmeanings_search', function (Blueprint $table) {
            $table->bigincrements('id');
            $table->string('name');
            $table->integer('namemeaning_id')->unsigned();
            $table->integer('search_no')->default(0);
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
        Schema::dropIfExists('namesmeanings_search');
    }
}
