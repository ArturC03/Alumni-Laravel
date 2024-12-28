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
        // Criar tabela 'midias'
        Schema::create('midias', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo', ['video', 'imagem']);
            $table->string('media_path');
            $table->timestamps();
        });

        // Criar tabela 'publicacoes'
        Schema::create('publicacoes', function (Blueprint $table) {
            $table->id(); // Chave primária
            $table->foreignId('midia_id')->nullable()->constrained('midias')->onDelete('set null'); // Relacionamento com a tabela de mídias
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Relacionamento com os utilizadores
            $table->foreignId('visibilidade_id')->constrained('visibilidades')->onDelete('cascade'); // Relacionamento com a tabela de visibilidades
            $table->string('titulo'); // Título da publicação
            $table->text('conteudo'); // Conteúdo principal da publicação
            $table->boolean('ativo')->default(true); // Indica se a publicação está ativa
            $table->timestamps(); // Campos de created_at e updated_at
        });

        // Criar tabela 'comentarios'
        Schema::create('comentarios', function (Blueprint $table) {
            $table->id(); // Chave primária
            $table->foreignId('publicacao_id')->constrained('publicacoes')->onDelete('cascade'); // Relacionamento com a publicação principal
            $table->foreignId('comentario_pai_id')->nullable()->constrained('comentarios')->onDelete('cascade'); // Relacionamento com o comentário pai (para comentários aninhados)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Relacionamento com o autor do comentário
            $table->text('conteudo'); // Conteúdo do comentário
            $table->boolean('ativo')->default(true); // Indica se o comentário está ativo
            $table->timestamps(); // Campos de created_at e updated_at
        });

        // Criar tabela 'reacoes'
        Schema::create('reacoes', function (Blueprint $table) {
            $table->id(); // Chave primária
            $table->foreignId('publicacao_id')->nullable()->constrained('publicacoes')->onDelete('cascade'); // Referência à publicação (se a reação for a uma publicação)
            $table->foreignId('comentario_id')->nullable()->constrained('comentarios')->onDelete('cascade'); // Referência ao comentário (se a reação for a um comentário)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Referência ao utilizador que deu a reação
            $table->boolean('like')->default(true); // true para like, falso para dislike
            $table->timestamps(); // Campos de created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reacoes');
        Schema::dropIfExists('comentarios');
        Schema::dropIfExists('publicacoes');
        Schema::dropIfExists('midias');
    }
};
