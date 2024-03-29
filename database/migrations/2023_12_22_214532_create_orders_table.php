<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('order_number' , 10)->unique();
            $table->float('sub_total')->default(0);
            $table->float('total_amount')->default(0);
            $table->float('coupon')->default(0);
            $table->string('payment_method')->default('cod');
            $table->enum('payment_status' , ['paid' , 'unpaid'])->default('unpaid');
            $table->enum('condition' , ['pending' , 'processing' , 'delivered' , 'cancelled'])->default('pending');
            $table->float('delivery_charge')->default(0)->nullable();
   
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone');
            $table->string('country')->nullable();
            $table->string('address');
            $table->string('city');
            $table->string('state')->nullable();
            $table->string('postcode')->nullable();
            $table->mediumText('note')->nullable();

            $table->string('sfirst_name');
            $table->string('slast_name');
            $table->string('semail');
            $table->string('sphone');
            $table->string('scountry')->nullable();
            $table->string('saddress');
            $table->string('scity');
            $table->string('spostcode')->nullable();
            $table->string('sstate')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
