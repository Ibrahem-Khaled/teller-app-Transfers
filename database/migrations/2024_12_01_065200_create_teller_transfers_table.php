<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('teller_transfers', function (Blueprint $table) {
            $table->id();
            //this is for invoice
            $table->bigInteger('invoice_number')->unique()->required();
            $table->unsignedBigInteger('sender_id')->nullable();
            $table->unsignedBigInteger('receiver_id')->nullable();

            $table->unsignedBigInteger('employee_id')->nullable();

            $table->bigInteger('amount')->default(0);
            $table->string('country')->nullable();

            // this is for type
            $table->enum('type', ['send', 'receive'])->default('send');
            $table->enum('paid', ['cash', 'bank'])->default('cash');
            $table->boolean('status')->default(0);

            // this is for bank info
            $table->string('iban')->nullable();
            $table->string('swift')->nullable();
            $table->string('bank_name')->nullable();

            $table->string('bank_city')->nullable();
            $table->string('ifsc')->nullable();
            $table->string('routeing_number')->nullable();

            $table->timestamps();
            //this is for foreign key
            $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('receiver_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('employee_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teller_transfers');
    }
};
