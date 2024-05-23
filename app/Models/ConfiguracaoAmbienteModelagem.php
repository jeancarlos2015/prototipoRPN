<?php

namespace App\Http\Models;

use App\Http\Models\Projeto;
use App\Http\Repositorys\AcessoRecenteRepository;
use App\User;
use Illuminate\Database\Eloquent\Model;
use App\Http\Models\Repositorio;
class ConfiguracaoAmbienteModelagem extends Model
{
    protected $connection = 'pgsql';
    protected $primaryKey = 'codconfiguracaoambientemodelagem';
    protected $table = 'configuracaoambientemodelagem';
    protected $fillable = [
        'codprojeto',
        'codrepositorio',
        'codusuario',
        'codmodelo',
        'codmodelodiagramatico',


        'exibirdescricaodiagrama',
        'exibiradicaousuariosdiagrama',
        'exibiralteracoes',
        'exibiriconepainel',
        'exibireditarmodelouploaddiagrama',
        'exibiracessoeditardiagrama',
        'exibiracessodocumentacaotextual',
        'exibiracessosrecentes',
        'exibiracessousuarios',
        'exibiracessoadicaovalidador',
        'exibiracessovalidardiagrama',
        'exibiracessoenviarmensagem',
        'exibiracessodonwloaddiagrama',
        'exibiracessoinformacoesdiagrama',
        'exibiracessorepositorios',

        'created_at',
        'updated_at',
    ];

    public function ExibirAcessoValidarDiagrama()
    {
        return $this->exibiracessovalidardiagrama == 1;
    }

    public function ExibirDescricaoDiagrama()
    {
        return $this->exibirdescricaodiagrama == 1;
    }

    public function ExibirAdicaoUsuariosDiagrama()
    {
        return $this->exibiradicaousuariosdiagrama == 1;
    }


    public function ExibirAlteracoes()
    {
        return $this->exibiralteracoes == 1;
    }


    public function ExibirIconePainel()
    {
        return $this->exibiriconepainel == 1;
    }


    public function ExibirEditarModeloUploadDiagrama()
    {
        return $this->exibireditarmodelouploaddiagrama == 1;
    }


    public function ExibirAcessoEditarDiagrama()
    {
        return $this->exibiracessoeditardiagrama == 1;
    }


    public function ExibirAcessoDocumentacaoTextual()
    {
        return $this->exibiracessodocumentacaotextual == 1;
    }


    public function ExibirAcessosRecentes()
    {
        return $this->exibiracessosrecentes == 1;
    }


    public function ExibirAcessoAdicaoValidador()
    {
        return $this->exibiracessoadicaovalidador == 1;
    }

    public function ExibirAcessoUsuarios()
    {
        return $this->exibiracessousuarios == 1;
    }

    public function ExibirAcessoEnviarMensagem()
    {
        return $this->exibiracessoenviarmensagem == 1;
    }


    public function ExibirAcessoDonwloadDiagrama()
    {
        return $this->exibiracessodonwloaddiagrama == 1;
    }


    public function ExibirAcessoInformacoesDiagrama()
    {
        return $this->exibiracessoinformacoesdiagrama == 1;
    }


    public function ExibirAcessoRepositorios()
    {
        return $this->exibiracessorepositorios == 1;
    }


    public function usuario()
    {
        return $this->hasOne(User::class, 'codusuario', 'codusuario');
    }

    public function projeto()
    {
        return $this->hasOne(Projeto::class, 'codprojeto', 'codprojeto');
    }

    public function repositorio()
    {
        return $this->hasOne(Repositorio::class, 'codrepositorio', 'codrepositorio');
    }

    public function modelo()
    {
        return $this->hasOne(Modelo::class, 'codmodelo', 'codmodelo');
    }


    protected static function boot()
    {
        parent::boot();

        static::updated(function ($configuracaomenu) {
            AcessoRecenteRepository::CriaAcessoRecenteConfiguracaoAmbienteModelagem($configuracaomenu, 'edicao_configuracao_menu', 'ALteração de configuracao para o usuário ' . $configuracaomenu->usuario->name);
            limpar_cache();
        });

        static::deleting(function ($modelo) { // before delete() method call this
            limpar_cache();
        });

        static::created(function ($configuracaomenu) {
            AcessoRecenteRepository::CriaAcessoRecenteConfiguracaoAmbienteModelagem($configuracaomenu, 'criacao_configuracao_menu', 'Criação de configuracao para o usuário ' . $configuracaomenu->usuario->name);
            limpar_cache();
        });


    }


}
