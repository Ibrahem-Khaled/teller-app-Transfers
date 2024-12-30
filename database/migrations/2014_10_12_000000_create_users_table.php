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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->string('avatar')->nullable();
            $table->string('phone')->nullable()->unique();
            $table->string('address')->nullable();

            $table->enum('role', ['admin', 'employee', 'user'])->default('user');
            $table->boolean('status')->default(0);

            $table->string('api_token', 64)->nullable()->unique();

            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'role' => 'admin',
            'password' => Hash::make('123456'),
            'status' => 1
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
