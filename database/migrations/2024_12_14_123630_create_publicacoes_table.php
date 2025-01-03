<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Criar tabela 'midias'
        Schema::create('midias', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo', ['video', 'imagem']);
            $table->string('media_path');
            $table->timestamps();
        });

        // Criar tabela 'publicacoes' depois de users
        Schema::create('publicacoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('midia_id')->nullable()->constrained('midias')->onDelete('set null');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('visibilidade_id')->constrained('visibilidades')->onDelete('cascade');
            $table->string('titulo');
            $table->text('conteudo');
            $table->boolean('ativo')->default(true);
            $table->timestamps();
        });

        // Criar tabela 'comentarios'
        Schema::create('comentarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('publicacao_id')->constrained('publicacoes')->onDelete('cascade');
            $table->foreignId('comentario_pai_id')->nullable()->constrained('comentarios')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->text('conteudo');
            $table->boolean('ativo')->default(true);
            $table->timestamps();
        });

        // Criar tabela 'reacoes'
        Schema::create('reacoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('publicacao_id')->nullable()->constrained('publicacoes')->onDelete('cascade');
            $table->foreignId('comentario_id')->nullable()->constrained('comentarios')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->boolean('like')->default(true);
            $table->timestamps();
        });

        // Criar tabela 'publicacao_visualizacoes'
        Schema::create('publicacao_visualizacoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('publicacao_id')->constrained('publicacoes')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reacoes');
        Schema::dropIfExists('publicacao_visualizacoes');
        Schema::dropIfExists('comentarios');
        Schema::dropIfExists('publicacoes');
        Schema::dropIfExists('midias');
    }
};
