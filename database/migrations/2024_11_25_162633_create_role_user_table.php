<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('role_user', function (Blueprint $table) {
            $table->foreignId('role_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->primary(['role_id', 'user_id']);
            $table->timestamps();
        });

        DB::table('users')->insert([
            'id' => 1,
            'name' => "Administrator",
            'email' => "admin@gmail.com",
            'password' => Hash::make('ADMIN_PASSWORD'),
        ]);

        DB::table('role_user')->insert([
            'role_id' => 1,
            'user_id' => 1,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_user');
    }
};
