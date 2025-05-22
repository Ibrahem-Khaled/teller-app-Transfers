<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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

            $table->enum('role', ['admin', 'teacher', 'student', 'super_admin', 'website', 'team_work'])->default('student');
            $table->boolean('status')->default(0);

            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert([
            [
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'role'           => 'super_admin',
                'phone'      => null,               // إضافتها هنا
                'address'    => null,               // وإضافتها هنا
                'password'       => Hash::make('123456'),
                'status'         => 1,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'name'           => 'Teacher',
                'email'          => 'teacher@teacher.com',
                'phone'          => '0123456789',
                'address'        => 'Teacher Address',
                'role'           => 'website',
                'password'       => Hash::make('123456'),
                'status'         => 1,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
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
