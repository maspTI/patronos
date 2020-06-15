<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCopatronsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('copatrons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patron_id');
            $table->string('name');
            $table->string('email');
            $table->date('birthday');
            $table->integer('status')->default(1);
            $table->timestamps();

            $table->foreign('patron_id')->references('id')->on('patrons');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('copatrons');
    }
}
