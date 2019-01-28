<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('names');
            $table->timestamps();
        });
        DB::table('categories')->insert(
            array(
                array(
                    'names' => 'Vehicles'
                ),
                array(
                    'names' => 'Clothes'
                ),
                array(
                    'names' => 'Multimedia'
                ),
                array(
                    'names' => 'Property'
                ),
                array(
                    'names' => 'Informatic'
                ),
                array(
                    'names' => 'Services'
                ),
                 array(
                    'names' => 'Others'
                )
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
