<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->morphs('paymentable');
            $table->json('type');
            $table->date('due_date');
            $table->integer('payment_method'); // 1 => Cartao de Credito; 2 => Boleto; 3 => Transferencia Bancaria;
            $table->float('value', 10, 2);
            $table->json('payment_info');
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
        Schema::dropIfExists('payments');
    }
}
