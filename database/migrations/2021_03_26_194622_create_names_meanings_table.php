<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNamesMeaningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('names_meanings', function (Blueprint $table) {
            $table->bigincrements('id');
            $table->string('name');
            $table->text('name_meaning');
            $table->integer('nameorigin_id')->unsigned();
            $table->integer('name_type');   // مذكر0    1 مؤنث
            $table->integer('admin_id');
            $table->integer('search_no')->nullable();
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
        Schema::dropIfExists('names_meanings');
    }
}
