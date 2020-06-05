<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatronsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patrons', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('avatar');
            $table->date('birthday');
            $table->string('cpf', 11)->unique()->index();
            $table->string('marital_status');
            $table->json('emails')->nullable();
            $table->string('occupation')->nullable();
            $table->string('company')->nullable();
            $table->json('phones')->nullable();
            $table->json('secretaries')->nullable();
            $table->json('dependents')->nullable();
            $table->json('social_medias')->nullable();
            $table->string('pointed_by')->nullable();
            $table->longText('bio')->nullable();
            $table->integer('status')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('patrons');
    }
}
