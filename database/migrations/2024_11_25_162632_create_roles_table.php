<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->json('permissions')->nullable();
            $table->timestamps();
        });

        DB::table('roles')->insert([
            [
                'id' => 1,
                'title' => "Super Administrator",
                'permissions'=> json_encode(config('permissions.permissions')),
                'created_at' => now()->toDateTimeString(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
