<?php

namespace App\Http\Repositorys;


use App\Http\Models\Documentacao;
use App\Http\Models\Modelo;
use App\Http\Models\Repositorio;
use App\Http\Models\RepresentacaoDiagramatica;
use App\Http\Util\LogMessage;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class DocumentacaoRepository extends Repository
{

    public function __construct()
    {
        $this->setModel(Repositorio::class);
    }

    public static function listar()
    {
        return Cache::remember('listar_documentacao' . Auth::getUser()->codusuario, 2000, function () {
            if (Auth::getUser()->EAdministrador()) {
                return Documentacao::all();
            } elseif (in_array(Auth::getUser()->papel(), ['PROPRIETARIO', 'COLABORADOR', 'CLIENTE'])) {
                $repositorio = Auth::getUser()->repositorio;
                return Documentacao::all()->where('publico', true)
                    ->union(Documentacao::all()->where('codusuario', Auth::getUser()->codusuario))
                    ->union(Documentacao::all()->where('codrepositorio', $repositorio->codrepositorio));
            } else {
                return Documentacao::all()->where('publico', true);
            }
        });
    }


    public static function count()
    {
        return collect(self::listar())->count();
    }

    public static function atualizar(Request $request, $coddocumentacao)
    {
        try {
            DB::beginTransaction();
            $documentacao = Documentacao::findOrFail($coddocumentacao);
            $documentacao->update($request->all());
            self::limpar_cache();
            DB::commit();
            return $documentacao;
        } catch (\Exception $ex) {
            DB::rollBack();
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Documentação Textual';
            $data['acao'] = 'atualizar_documentacao';
            return LogMessage::create_log($data);
        }
    }

    public static function limpar_cache()
    {
        Cache::forget('listar_documentacao' . Auth::getUser()->codusuario);
    }

    private static function Existe($dado = [])
    {
        return Documentacao::all()
                ->where('codusuario', $dado['codusuario'])
                ->where('codrepositorio', $dado['codrepositorio'])
                ->where('codprojeto', $dado['codprojeto'])
                ->where('codmodelo', $dado['codmodelo'])
                ->where('codmodelodiagramatico', $dado['codmodelodiagramatico'])
                ->where('nome', $dado['nome'])
                ->count() > 0;
    }

    public static function incluir(Request $request)
    {
        try {

            if (!self::Existe($request->all())) {
                DB::beginTransaction();
                Documentacao::create($request->all());
                self::limpar_cache();
                DB::commit();
                flash('Descrição salva com sucesso!')->success();
            }
        } catch (\Exception $ex) {
            DB::rollBack();
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Documentação Textual';
            $data['acao'] = 'atualizar_documentacao';
            LogMessage::create_log($data);
        }



    }

    public static function salvar($dado = [])
    {
        try {
            DB::beginTransaction();
            foreach (Auth::getUser()->usuarios() as $usuario) {

                if ($usuario->TemAviso()) {
                    $documentacao = $usuario->Aviso();
                    $documentacao->descricao = $dado['descricao'];
                    $documentacao->visto = 0;
                    $documentacao->nome = $dado['nome'];
                    $documentacao->update();
                } else {
                    $dado['codusuario'] = $usuario->codusuario;
                    $documentacao = Documentacao::create($dado);
                }
            }
            DB::commit();

            return $documentacao;
        } catch (\Exception $ex) {
            DB::rollBack();
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Aviso';
            $data['acao'] = 'Criação do aviso';
            LogMessage::create_log($data);
            return null;
        }
    }

    public static function excluir($coddocumentacao)
    {
        try {
            DB::beginTransaction();
            $doc = Documentacao::findOrFail($coddocumentacao);
            $value = $doc->delete();
            self::limpar_cache();
            DB::commit();
            return flash('Registro excluido com sucesso!')->success();
        } catch (\Exception $ex) {
            DB::rollBack();
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Diagramas Versionáveis';
            $data['acao'] = 'create';
            return LogMessage::create_log($data);
        }
    }

    public static function excluir_todos()
    {

        try {
            DB::beginTransaction();
            $documentacoes = self::listar();
            foreach ($documentacoes as $documentacao) {
                $documentacao->delete();
            }
            self::limpar_cache();
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
        }

    }

}
