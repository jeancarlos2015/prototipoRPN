<?php
/**
 * Created by PhpStorm.
 * User: secre
 * Date: 19/10/2018
 * Time: 13:34
 */

namespace App\Http\Viwers;


use App\Http\Repositorys\LogRepository;
use App\Http\Util\LogMessage;

class LogViwer
{
    public $titulos = [
        'Descrição',
        'Ações'
    ];
    public $tipo = 'log';
    public $logs;
    public $logs_nao_visto;
    public function __construct($codmodelo = -1)
    {
        try {
            $this->logs = LogRepository::listar_todos();
            foreach ($this->logs as $log){
                $log->visto = 1;
                $log->update();
            }
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'GitViwer';
            $data['acao'] = '__construct';
            LogMessage::create_log($data);
        }
    }
}
