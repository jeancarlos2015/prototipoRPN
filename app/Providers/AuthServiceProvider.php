<?php

namespace App\Providers;

use App\Http\Models\Mensagem;
use App\Http\Models\Modelo;
use App\Http\Models\Projeto;
use App\http\Models\Repositorio;
use App\Http\Models\RepresentacaoDiagramatica;
use App\Http\Models\RepresentacaoDiagramaticaVersionavel;
use App\User;
use http\Client\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin', function ($user){
            return in_array($user->papel(),['PROPRIETARIO','ADMINISTRADOR']) || $user->EAdministrador();
        });

        Gate::define('acesso', function ($user){
            return $user->existe_repositorio() || $user->EAdministrador();
        });
        Gate::define('acesso-mensagem', function ($user, $codmensagem){

            return $user->existe_repositorio() || $user->EAdministrador();
        });
        Gate::define('acesso-usuario', function ($user, $codusuario){

            return $user->codusuario == $codusuario || $user->EAdministrador();
        });
        Gate::define('admin-proprietario', function ($user){
            return in_array($user->papel(),['ADMINISTRADOR','PROPRIETARIO']) || $user->EAdministrador();
        });

        Gate::define('acesso-no-repositorio', function ($user){
            return $user->usuario_esta_no_repositorio() || $user->EAdministrador();
        });
        Gate::define('acesso-repositorio', function ($user, $codrepositorio){
            $repositorio = Repositorio::FindOrFail($codrepositorio);
            return $repositorio->UsuarioTemPermissao($user);
        });


        Gate::define('acesso-processo', function ($user, $codprojeto){
            $processo = Projeto::FindOrFail($codprojeto);
            return $processo->UsuarioTemPermissao($user);
        });


        Gate::define('acesso-modelo', function ($user, $codmodelo){
            $modelo = Modelo::FindOrFail($codmodelo);
            return $modelo->UsuarioTemPermissao($user);
        });
        Gate::define('edicao-modelo', function ($user, $codmodelo){
            $modelo = Modelo::FindOrFail($codmodelo);
            $podeEditar = ($modelo->codusuario==$user->codusuario) ||
            ($user->papel()=='PROPRIETARIO' && $user->codrepositorio == $modelo->codrepositorio) ||
                $user->EAdministrador();
            return $modelo->UsuarioTemPermissao($user) || $podeEditar;
        });


        Gate::define('acesso-diagrama', function ($user, $codmodelodiagramatico){
            $diagrama = RepresentacaoDiagramatica::FindOrFail($codmodelodiagramatico);
            return $diagrama->modelo->UsuarioTemPermissao($user);
        });
        Gate::define('acesso-diagrama-versionavel', function ($user, $codmodelodiagramatico){
            $diagrama = RepresentacaoDiagramaticaVersionavel::FindOrFail($codmodelodiagramatico);
            return $diagrama->modelo->UsuarioTemPermissao($user);
        });
        Gate::define('acesso-declarativo', function ($user, $codrepositorio){
            $repositorio = Repositorio::FindOrFail($codrepositorio);
            return $repositorio->UsuarioTemPermissao($user);
        });



        Gate::define('jean', function ($user){
            return $user->email=='jeancarlospenas25@gmail.com';
        });

        Gate::define('edit-user', function($userAuthenticated,$targetUser){
            return $userAuthenticated->id == $targetUser->id;
        });
        Gate::define('can-model-public', function($codmodelo){
            $diagrama = RepresentacaoDiagramatica::FindOrFail($codmodelo);
            return $diagrama->modelo->publico == true;
        });
    }
}
