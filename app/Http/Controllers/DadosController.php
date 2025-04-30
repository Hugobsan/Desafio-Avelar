<?php

namespace App\Http\Controllers;

use App\Facades\FileManager;
use App\Http\Requests\StoreDadosRequest;
use App\Http\Requests\UpdateDadosRequest;
use App\Models\Dados;
use App\Models\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DadosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Dados::with(['endereco', 'anexos'])
            ->orderBy('id', 'desc');

        // Pesquisa por nome ou outros campos, se informado na query string
        if ($search = request('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('nome', 'like', "%{$search}%")
                    ->orWhereHas('endereco', function ($q2) use ($search) {
                        $q2->where('cidade', 'like', "%{$search}%")
                            ->orWhere('bairro', 'like', "%{$search}%");
                    });
            });
        }

        $dados = $query->paginate(3)->withQueryString();

        // Média Salarial
        $mediaSalarial = Dados::where('salario', '>', 0)->avg('salario');

        // Total de pessoas com ensino médio
        $ensinoMedio = Dados::where('ensino_medio', true)->count();

        // Total de anexos no sistema
        $totalAnexos = File::count();

        $insights = [
            'mediaSalarial' => $mediaSalarial,
            'ensinoMedio' => $ensinoMedio,
            'totalAnexos' => $totalAnexos,
        ];

        return view('dados.index', compact('dados', 'insights'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDadosRequest $request)
    {
        DB::beginTransaction();
        try {
            // Cria um novo objeto Dados vazio
            $dados = new Dados();

            // Usa a função storeDados para criar os dados e endereço
            $this->storeDados($request, $dados);

            // Processa os anexos
            if ($request->hasFile('anexos')) {
                foreach ($request->file('anexos') as $file) {
                    // Salva o arquivo através da facade
                    FileManager::upload($file, 'dados/anexos');

                    // Cria o relacionamento com o arquivo
                    $anexo = FileManager::upload($file, 'dados/anexos');
                    $dados->anexos()->attach($anexo->id);
                }
            }

            DB::commit();

            toastr()->success('Dados salvos com sucesso!');
            return back();
        } catch (\Exception $e) {
            DB::rollBack();

            toastr()->error('Erro ao salvar os dados!');
            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDadosRequest $request, Dados $dados)
    {
        DB::beginTransaction();
        try {
            // Usa a função storeDados para atualizar os dados e endereço
            $this->storeDados($request, $dados);
            DB::commit();
            toastr()->success('Dados atualizados com sucesso!');
            return back();
        } catch (\Exception $e) {
            DB::rollBack();

            toastr()->error('Erro ao atualizar os dados!');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dados $dados)
    {
        $dados->delete();
        toastr()->success('Dados excluídos com sucesso!');
        return back();
    }

    // Armazena um novo anexo (para um dado já existente)
    public function storeAnexo(Request $request, Dados $dados)
    {
        DB::beginTransaction();
        try {
            // Processa os anexos
            if ($request->hasFile('anexo')) {
                $anexo = FileManager::upload($request->file('anexo'), 'dados/anexos');
                $dados->anexos()->attach($anexo->id);
            }

            DB::commit();
            toastr()->success('Anexo salvo com sucesso!');
            return back();
        } catch (\Exception $e) {
            Log::error('Erro ao salvar o anexo: ' . $e->getMessage());
            DB::rollBack();
            toastr()->error('Erro ao salvar o anexo!');
            return back();
        }
    }

    // Remove um anexo (para um dado já existente)
    public function destroyAnexo(File $file)
    {
        FileManager::delete($file);
        DB::commit();
        toastr()->success('Anexo excluído com sucesso!');
        return back();
    }

    /**
     * Função para armazenar os dados com updateOrCreate
     * @param mixed $request
     * @param mixed $dados
     * @return void
     */
    protected function storeDados($request, $dados)
    {
        $dados->updateOrCreate(
            ['id' => $dados->id],
            $request->only([
                'nome',
                'idade',
                'ensino_medio',
                'sexo',
                'salario'
            ])
        );

        $dados->endereco()->updateOrCreate(
            ['dados_id' => $dados->id],
            $request->only([
                'cep',
                'cidade',
                'estado',
                'bairro',
                'rua',
                'numero',
                'complemento'
            ])
        );
    }
}
