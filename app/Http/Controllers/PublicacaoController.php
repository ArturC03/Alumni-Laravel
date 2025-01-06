<?php

namespace App\Http\Controllers;

use App\Models\Midia;
use App\Models\Publicacao;
use App\Models\Visibilidade;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PublicacaoController extends Controller
{
    public function index(Publicacao $publicacao)
    {
        // Increment view count if authenticated user hasn't viewed yet today
        if (auth()->check()) {
            auth()->user()->VisualizarPublicacao($publicacao);
        }

        // Check if publication can be viewed by current user
        if (! $publicacao->CanBeViewedBy(auth()->user())) {
            abort(403, 'Não tens permissão para visualizar esta publicação.');
        }

        // Load necessary relationships
        $publicacao->load([
            'user',
            'midia',
            'reacoes',
            'comentarios' => function ($query) {
                $query->with('user')
                    ->orderBy('created_at', 'desc');
            },
        ]);

        return view('publicacao.index', compact('publicacao'));
    }

    public function criar()
    {
        $visibilidades = Visibilidade::all();

        return view('publicacao.criar', compact('visibilidades'));
    }

    public function guardar(Request $request)
    {
        // Validação rigorosa com base nos campos dos modelos fornecidos
        $validatedData = $request->validate([
            'titulo' => 'required|string|max:255',
            'conteudo' => 'required|string',
            'user_id' => 'required|integer|exists:users,id',
            'visibilidade_id' => 'required|integer|exists:visibilidades,id',
            'midia' => 'nullable|file|mimes:jpg,jpeg,png,gif,mp4|max:2048',
        ]);

        // Inicia uma transação
        DB::beginTransaction();

        try {
            // Criar a publicação
            $publicacao = Publicacao::create($validatedData);

            // Processar mídia, se existir
            if ($request->hasFile('midia')) {
                $this->processarMidia($request, $publicacao);
            }

            // Confirmar transação
            DB::commit();

            return redirect()->route('home')->with('success', 'Publicação criada com sucesso!');
        } catch (Exception $e) {
            // Reverter transação em caso de erro
            DB::rollBack();

            return redirect()->back()->withErrors([
                'error' => 'Erro ao criar a publicação: '.$e->getMessage(),
            ]);
        }
    }

    private function processarMidia(Request $request, Publicacao $publicacao)
    {
        // Armazenar o arquivo
        $mediaPath = $request->file('midia')->store('midias', 'public');

        // Determinar o tipo do arquivo
        $fileExtension = strtolower($request->file('midia')->getClientOriginalExtension());
        $fileType = Midia::detetarTipoMidia($fileExtension);

        // Registrar a mídia
        $midia = Midia::create([
            'tipo' => $fileType,
            'media_path' => $mediaPath,
        ]);

        // Associar a mídia à publicação
        $publicacao->update(['midia_id' => $midia->id]);
    }
}
