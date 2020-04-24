<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExampleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::create('example_tables', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 300);
            $table->json('values');
            $table->string('slug', 300)->unique();
            $table->timestamps();
            $table->softDeletes();
            $table->index('slug');
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::drop('example_tables');
    }
}
