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

        Schema::create('cargos', function (Blueprint $table) {
            $table->id();
            $table->string('nome')->unique();
        });

        Schema::create('visibilidades', function (Blueprint $table) {
            $table->id();
            $table->enum('estado', ['Privado', 'Público', 'Arquivado']);
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cargo_id')->constrained('cargos')->onDelete('cascade');
            $table->foreignId('current_team_id')->nullable();
            $table->foreignId('visibilidade_id')->constrained('visibilidades')->onDelete('cascade');
            $table->string('name');
            $table->string('nickname')->nullable()->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->timestamps();
        });

        Schema::create('followers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('follower_id')
                ->constrained('users')
                ->cascadeOnDelete();
            $table->foreignId('following_id')
                ->constrained('users')
                ->cascadeOnDelete();
            $table->unique(['follower_id', 'following_id']);
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Dropping tables in reverse order (if necessary to manage dependency)
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('followers');
        Schema::dropIfExists('users');
        Schema::dropIfExists('visibilidades');
        Schema::dropIfExists('cargos');
    }
};
