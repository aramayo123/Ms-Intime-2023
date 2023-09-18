<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->id();
            $table->bigInteger('id_mercadopago');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('status')->nullable();
            $table->string('status_detail')->nullable();
            $table->string('status_product')->nullable();
            $table->string('statement_descriptor')->nullable();
            $table->bigInteger('transaction_amount');
            $table->bigInteger('transaction_amount_refunded');
            $table->bigInteger('transaction_amount_recibido')->nullable();
            $table->bigInteger('coupon_amount');
            $table->string('date_created')->nullable();
            $table->string('date_aproved')->nullable();
            $table->string('date_of_expiration')->nullable();
            $table->string('date_entregado')->nullable();
            $table->string('date_entrega_aprox')->nullable();
            $table->string('differential_pricing_id')->nullable();
            $table->string('deduction_schema')->nullable();
            $table->string('money_release_date')->nullable();
            $table->string('money_release_schema')->nullable();
            $table->string('payment_method_id')->nullable();
            $table->string('payment_type_id')->nullable();
            $table->string('payment_description')->nullable();
            $table->string('payment_operation_type')->nullable();
            $table->string('payment_authorization_code')->nullable();
            $table->string('payment_currency_id')->nullable();
            $table->string('payment_method_captured')->nullable();
            $table->string('payment_installments_cuotas')->nullable();
            $table->string('payment_payer_first_name')->nullable();
            $table->string('payment_payer_email')->nullable();
            $table->string('payment_payer_dni')->nullable();
            $table->string('payment_payer_phone_area')->nullable();
            $table->string('payment_payer_phone_number')->nullable();
            // datos de los productos solicitados
            $table->string('id_productos')->nullable();
            $table->string('amount_productos')->nullable();
            $table->string('colors_productos')->nullable();
            $table->string('talles_productos')->nullable();
            $table->bigInteger('contact');
            $table->string('direction')->nullable();
            $table->bigInteger('price');
            $table->string('detalles')->nullable();
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
        Schema::dropIfExists('tickets');
    }
};
