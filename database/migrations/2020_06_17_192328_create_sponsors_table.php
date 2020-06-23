<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSponsorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sponsors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('project_id');
            $table->longText('avatar')->nullable();
            $table->string('logo')->nullable();
            $table->string('cnpj');
            $table->string('razao_social');
            $table->string('nome_fantasia');
            $table->string('occupation_area');
            $table->json('proxy');
            $table->json('addresses');
            $table->json('social_medias')->nullable();
            $table->json('people_to_contact');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('project_id')->references('id')->on('projects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sponsors');
    }
}
