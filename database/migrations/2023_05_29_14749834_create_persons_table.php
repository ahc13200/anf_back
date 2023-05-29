<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 */
class CreatePersonsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $connection = Schema::connection('database');
        $exist_table = $connection->hasTable('person');
        if (!$exist_table)

          Schema::create('person', function (Blueprint $table) {
                $table->increments('id');
                $table->string('first_name');
                $table->string('last_name');
                $table->string('sex');
                $table->integer('age');
                $table->string('email');
                $table->timestamps();


        });

    }

   public function down()
    {
        Schema::dropIfExists('person');


        return false;
    }
}
