<?php

namespace App\Http\Models;

use App\Http\Models\Projeto;
use App\Http\Models\RepresentacaoDiagramatica;
use App\User;
use Illuminate\Database\Eloquent\Model;
use App\Http\Util\Dado;
use App\Http\Models\Repositorio;
use App\Http\Models\UsuarioModelo;

class RepresentacaoDiagramaticaVersionavel extends Model
{
    protected $connection = 'pgsql';
    protected $primaryKey = 'coddiagramaversionavel';
    protected $table = 'representacoes_diagramaticas_versionaveis';
    protected $fillable = [
        'codmodelodiagramatico',
        'nome',
        'descricao',
        'xml_modelo',
        'svg_modelo',
        'codprojeto',
        'codrepositorio',
        'codusuario',
        'codmodelo',
        'created_at',
        'updated_at',
        'tipo'
    ];


    public static function titulos()
    {
        return [
            'Modelos',
            'Ações'
        ];
    }

    public static function campos()
    {
        return [
            'Nome',
            'Descrição'
        ];
    }

    public static function types()
    {
        return [
            'text',
            'text'
        ];
    }

    public static function atributos()
    {
        return [
            'nome',
            'descricao',
            'codprojeto',
            'codrepositorio',
            'xml_modelo'

        ];

    }
    public function svgPadrao(){
        return '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="572" height="292" viewBox="324 194 572 292" version="1.1"><defs><marker id="sequenceflow-end-white-black-627u68garb26286qrmlx0q0wh" viewBox="0 0 20 20" refX="11" refY="10" markerWidth="10" markerHeight="10" orient="auto"><path d="M 1 5 L 11 10 L 1 15 Z" style="fill: black; stroke-width: 1px; stroke-linecap: round; stroke-dasharray: 10000, 1; stroke: black;"/></marker><marker id="messageflow-end-white-black-627u68garb26286qrmlx0q0wh" viewBox="0 0 20 20" refX="8.5" refY="5" markerWidth="20" markerHeight="20" orient="auto"><path d="m 1 5 l 0 -3 l 7 3 l -7 3 z" style="fill: white; stroke-width: 1px; stroke-linecap: butt; stroke-dasharray: 10000, 1; stroke: black;"/></marker><marker id="messageflow-start-white-black-627u68garb26286qrmlx0q0wh" viewBox="0 0 20 20" refX="6" refY="6" markerWidth="20" markerHeight="20" orient="auto"><circle cx="6" cy="6" r="3.5" style="fill: white; stroke-width: 1px; stroke-linecap: round; stroke-dasharray: 10000, 1; stroke: black;"/></marker></defs><g class="djs-group"><g class="djs-element djs-shape new-parent" data-element-id="Participant_0f16mff" style="display: block;" transform="matrix(1 0 0 1 330 200)"><g class="djs-visual"><rect x="0" y="0" width="560" height="130" rx="0" ry="0" style="stroke: black; stroke-width: 2px; fill: white; fill-opacity: 0.95;"/><polyline points="30,0 30,130 " style="fill: none; stroke: black; stroke-width: 2px;"/><text lineHeight="1.2" class="djs-label" style="font-family: Arial, sans-serif; font-size: 12px; font-weight: normal; fill: black;" transform="matrix(-1.83697e-16 -1 1 -1.83697e-16 0 130)"><tspan x="65" y="18.6"/></text></g><rect x="-6" y="-6" width="572" height="142" class="djs-outline" style="fill: none;"/><rect class="djs-hit djs-hit-click-stroke" x="0" y="0" width="560" height="130" style="fill: none; stroke-opacity: 0; stroke: white; stroke-width: 15px;"/><rect class="djs-hit djs-hit-all" x="0" y="0" width="30" height="130" style="fill: none; stroke-opacity: 0; stroke: white; stroke-width: 15px;"/></g><g class="djs-children"><g class="djs-group"><g class="djs-element djs-shape" data-element-id="Lane_0p1q5ox" style="display: block;" transform="matrix(1 0 0 1 360 200)"><g class="djs-visual"><rect x="0" y="0" width="530" height="130" rx="0" ry="0" style="stroke: black; stroke-width: 2px; fill: white; fill-opacity: 0.35;"/><text lineHeight="1.2" class="djs-label" style="font-family: Arial, sans-serif; font-size: 12px; font-weight: normal; fill: black;" transform="matrix(-1.83697e-16 -1 1 -1.83697e-16 0 130)"><tspan x="65" y="18.6"/></text></g><rect x="-6" y="-6" width="542" height="142" class="djs-outline" style="fill: none;"/><rect class="djs-hit djs-hit-click-stroke" x="0" y="0" width="530" height="130" style="fill: none; stroke-opacity: 0; stroke: white; stroke-width: 15px;"/><rect class="djs-hit djs-hit-all" x="0" y="0" width="30" height="130" style="fill: none; stroke-opacity: 0; stroke: white; stroke-width: 15px;"/></g></g><g class="djs-group"><g class="djs-element djs-connection" data-element-id="Flow_06puueh" style="display: block;"><g class="djs-visual"><path d="m  418,270L470,270 " style="fill: none; stroke-width: 2px; stroke: black; stroke-linejoin: round; marker-end: url(\'#sequenceflow-end-white-black-627u68garb26286qrmlx0q0wh\');"/></g><polyline points="418,270 470,270 " class="djs-hit djs-hit-stroke" style="fill: none; stroke-opacity: 0; stroke: white; stroke-width: 15px;"/><rect x="412" y="264" width="64" height="12" class="djs-outline" style="fill: none;"/></g></g><g class="djs-group"><g class="djs-element djs-connection" data-element-id="Flow_081xwoq" style="display: block;"><g class="djs-visual"><path d="m  570,270L630,270 " style="fill: none; stroke-width: 2px; stroke: black; stroke-linejoin: round; marker-end: url(\'#sequenceflow-end-white-black-627u68garb26286qrmlx0q0wh\');"/></g><polyline points="570,270 630,270 " class="djs-hit djs-hit-stroke" style="fill: none; stroke-opacity: 0; stroke: white; stroke-width: 15px;"/><rect x="564" y="264" width="72" height="12" class="djs-outline" style="fill: none;"/></g></g><g class="djs-group"><g class="djs-element djs-connection" data-element-id="Flow_0igzds6" style="display: block;"><g class="djs-visual"><path d="m  730,270L812,270 " style="fill: none; stroke-width: 2px; stroke: black; stroke-linejoin: round; marker-end: url(\'#sequenceflow-end-white-black-627u68garb26286qrmlx0q0wh\');"/></g><polyline points="730,270 812,270 " class="djs-hit djs-hit-stroke" style="fill: none; stroke-opacity: 0; stroke: white; stroke-width: 15px;"/><rect x="724" y="264" width="94" height="12" class="djs-outline" style="fill: none;"/></g></g><g class="djs-group"><g class="djs-element djs-shape" data-element-id="StartEvent_1" style="display: block;" transform="matrix(1 0 0 1 382 252)"><g class="djs-visual"><circle cx="18" cy="18" r="18" style="stroke: black; stroke-width: 2px; fill: white; fill-opacity: 0.95;"/></g><rect class="djs-hit djs-hit-all" x="0" y="0" width="36" height="36" style="fill: none; stroke-opacity: 0; stroke: white; stroke-width: 15px;"/><rect x="-6" y="-6" width="48" height="48" class="djs-outline" style="fill: none;"/></g></g><g class="djs-group"><g class="djs-element djs-shape" data-element-id="Activity_0901b6t" style="display: block;" transform="matrix(1 0 0 1 470 230)"><g class="djs-visual"><rect x="0" y="0" width="100" height="80" rx="10" ry="10" style="stroke: black; stroke-width: 2px; fill: white; fill-opacity: 0.95;"/><text lineHeight="1.2" class="djs-label" style="font-family: Arial, sans-serif; font-size: 12px; font-weight: normal; fill: black;"><tspan x="50" y="43.599999999999994"/></text></g><rect class="djs-hit djs-hit-all" x="0" y="0" width="100" height="80" style="fill: none; stroke-opacity: 0; stroke: white; stroke-width: 15px;"/><rect x="-6" y="-6" width="112" height="92" class="djs-outline" style="fill: none;"/></g></g><g class="djs-group"><g class="djs-element djs-shape" data-element-id="Activity_01o7qq0" style="display: block;" transform="matrix(1 0 0 1 630 230)"><g class="djs-visual"><rect x="0" y="0" width="100" height="80" rx="10" ry="10" style="stroke: black; stroke-width: 2px; fill: white; fill-opacity: 0.95;"/><text lineHeight="1.2" class="djs-label" style="font-family: Arial, sans-serif; font-size: 12px; font-weight: normal; fill: black;"><tspan x="50" y="43.599999999999994"/></text></g><rect class="djs-hit djs-hit-all" x="0" y="0" width="100" height="80" style="fill: none; stroke-opacity: 0; stroke: white; stroke-width: 15px;"/><rect x="-6" y="-6" width="112" height="92" class="djs-outline" style="fill: none;"/></g></g><g class="djs-group"><g class="djs-element djs-shape" data-element-id="Event_1p15yo9" style="display: block;" transform="matrix(1 0 0 1 812 252)"><g class="djs-visual"><circle cx="18" cy="18" r="18" style="stroke: black; stroke-width: 4px; fill: white; fill-opacity: 0.95;"/></g><rect class="djs-hit djs-hit-all" x="0" y="0" width="36" height="36" style="fill: none; stroke-opacity: 0; stroke: white; stroke-width: 15px;"/><rect x="-6" y="-6" width="48" height="48" class="djs-outline" style="fill: none;"/></g></g></g></g><g class="djs-group"><g class="djs-element djs-shape" data-element-id="Participant_1qlvsk1" style="display: block;" transform="matrix(1 0 0 1 330 370)"><g class="djs-visual"><rect x="0" y="0" width="560" height="110" rx="0" ry="0" style="stroke: black; stroke-width: 2px; fill: white; fill-opacity: 0.95;"/><polyline points="30,0 30,110 " style="fill: none; stroke: black; stroke-width: 2px;"/><text lineHeight="1.2" class="djs-label" style="font-family: Arial, sans-serif; font-size: 12px; font-weight: normal; fill: black;" transform="matrix(-1.83697e-16 -1 1 -1.83697e-16 0 110)"><tspan x="55" y="18.6"/></text></g><rect x="-6" y="-6" width="572" height="122" class="djs-outline" style="fill: none;"/><rect class="djs-hit djs-hit-click-stroke" x="0" y="0" width="560" height="110" style="fill: none; stroke-opacity: 0; stroke: white; stroke-width: 15px;"/><rect class="djs-hit djs-hit-all" x="0" y="0" width="30" height="110" style="fill: none; stroke-opacity: 0; stroke: white; stroke-width: 15px;"/></g><g class="djs-children"><g class="djs-group"><g class="djs-element djs-connection" data-element-id="Flow_1nlvgjb" style="display: block;"><g class="djs-visual"><path d="m  570,430L630,430 " style="fill: none; stroke-width: 2px; stroke: black; stroke-linejoin: round; marker-end: url(\'#sequenceflow-end-white-black-627u68garb26286qrmlx0q0wh\');"/></g><polyline points="570,430 630,430 " class="djs-hit djs-hit-stroke" style="fill: none; stroke-opacity: 0; stroke: white; stroke-width: 15px;"/><rect x="564" y="424" width="72" height="12" class="djs-outline" style="fill: none;"/></g></g><g class="djs-group"><g class="djs-element djs-connection" data-element-id="Flow_0497hgr" style="display: block;"><g class="djs-visual"><path d="m  730,430L812,430 " style="fill: none; stroke-width: 2px; stroke: black; stroke-linejoin: round; marker-end: url(\'#sequenceflow-end-white-black-627u68garb26286qrmlx0q0wh\');"/></g><polyline points="730,430 812,430 " class="djs-hit djs-hit-stroke" style="fill: none; stroke-opacity: 0; stroke: white; stroke-width: 15px;"/><rect x="724" y="424" width="94" height="12" class="djs-outline" style="fill: none;"/></g></g><g class="djs-group"><g class="djs-element djs-shape" data-element-id="Activity_16fkuc9" style="display: block;" transform="matrix(1 0 0 1 470 390)"><g class="djs-visual"><rect x="0" y="0" width="100" height="80" rx="10" ry="10" style="stroke: black; stroke-width: 2px; fill: white; fill-opacity: 0.95;"/><text lineHeight="1.2" class="djs-label" style="font-family: Arial, sans-serif; font-size: 12px; font-weight: normal; fill: black;"><tspan x="50" y="43.599999999999994"/></text></g><rect class="djs-hit djs-hit-all" x="0" y="0" width="100" height="80" style="fill: none; stroke-opacity: 0; stroke: white; stroke-width: 15px;"/><rect x="-6" y="-6" width="112" height="92" class="djs-outline" style="fill: none;"/></g></g><g class="djs-group"><g class="djs-element djs-shape" data-element-id="Activity_0rijirt" style="display: block;" transform="matrix(1 0 0 1 630 390)"><g class="djs-visual"><rect x="0" y="0" width="100" height="80" rx="10" ry="10" style="stroke: black; stroke-width: 2px; fill: white; fill-opacity: 0.95;"/><text lineHeight="1.2" class="djs-label" style="font-family: Arial, sans-serif; font-size: 12px; font-weight: normal; fill: black;"><tspan x="50" y="43.599999999999994"/></text></g><rect class="djs-hit djs-hit-all" x="0" y="0" width="100" height="80" style="fill: none; stroke-opacity: 0; stroke: white; stroke-width: 15px;"/><rect x="-6" y="-6" width="112" height="92" class="djs-outline" style="fill: none;"/></g></g><g class="djs-group"><g class="djs-element djs-shape selected hover" data-element-id="Event_1hx2bk6" style="display: block;" transform="matrix(1 0 0 1 812 412)"><g class="djs-visual"><circle cx="18" cy="18" r="18" style="stroke: black; stroke-width: 4px; fill: white; fill-opacity: 0.95;"/></g><rect class="djs-hit djs-hit-all" x="0" y="0" width="36" height="36" style="fill: none; stroke-opacity: 0; stroke: white; stroke-width: 15px;"/><rect x="-6" y="-6" width="48" height="48" class="djs-outline" style="fill: none;"/></g></g></g></g><g class="djs-group"><g class="djs-element djs-connection" data-element-id="Flow_1b0v7xk" style="display: block;"><g class="djs-visual"><path d="m  520,310L520,390 " style="fill: none; stroke-width: 1.5px; stroke: black; marker-end: url(\'#messageflow-end-white-black-627u68garb26286qrmlx0q0wh\'); marker-start: url(\'#messageflow-start-white-black-627u68garb26286qrmlx0q0wh\'); stroke-dasharray: 10, 12; stroke-linecap: round; stroke-linejoin: round;"/></g><polyline points="520,310 520,390 " class="djs-hit djs-hit-stroke" style="fill: none; stroke-opacity: 0; stroke: white; stroke-width: 15px;"/><rect x="514" y="304" width="12" height="92" class="djs-outline" style="fill: none;"/></g></g></svg>';
    }
//Instancia todas as posições de memória que serão exibidas no título
    public static function dados_objeto()
    {
        $dado = array();
        for ($indice = 0; $indice < 3; $indice++) {
            $dado[$indice] = new Dado();
        }
        return $dado;
    }

//Instancia somente os campos que serão exibidos no formulário e preenche os títulos da listagem
    public static function dados()
    {
        $campos = self::campos();
        $atributos = self::atributos();
        $dados = self::dados_objeto();
        $titulos = self::titulos();
        $types = self::types();
        //quantidade de atributos
        for ($indice = 0; $indice < 3; $indice++) {
            //quantidade do restante dos campos
            if ($indice < 2) {
                $dados[$indice]->campo = $campos[$indice];
                $dados[$indice]->tipo = $types[$indice];
                $dados[$indice]->titulo = $titulos[$indice];
            }
            $dados[$indice]->atributo = $atributos[$indice];


        }
        return $dados;
    }

//Relacionamentos
    public function projeto()
    {
        return $this->hasOne(Projeto::class, 'codprojeto', 'codprojeto');
    }
    public function modelo(){
        return $this->hasOne(Modelo::class,'codmodelo','codmodelo');
    }
    public function diagrama()
    {
        return $this->hasOne(RepresentacaoDiagramatica::class, 'codmodelodiagramatico', 'codmodelodiagramatico');
    }
    public function repositorio()
    {
        return $this->hasOne(Repositorio::class, 'codrepositorio', 'codrepositorio');
    }


    public function Documentacao()
    {
        return $this->hasOne(Documentacao::class, 'codmodelodiagramatico', 'codmodelodiagramatico');
    }

    public function usuario()
    {
        return $this->hasOne(User::class, 'codusuario', 'codusuario');
    }

    public static function validacao()
    {
        return [
            'nome' => 'required',
            'descricao' => 'required'
        ];
    }


    protected static function boot()
    {
        parent::boot();
        static::deleting(function () { // before delete() method call this
            limpar_cache();
        });

        static::created(function () {
            limpar_cache();

        });


    }
    public static function get_modelo_default($nome_modelo)
    {
        $data = "
        <?xml version=\"1.0\" encoding=\"UTF-8\"?>
<bpmn:definitions xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xmlns:bpmn=\"http://www.omg.org/spec/BPMN/20100524/MODEL\" xmlns:bpmndi=\"http://www.omg.org/spec/BPMN/20100524/DI\" xmlns:dc=\"http://www.omg.org/spec/DD/20100524/DC\" id=\"Definitions_1om5q7p\" targetNamespace=\"http://bpmn.io/schema/bpmn\">
  <bpmn:collaboration id=\"Collaboration_1635u9x\">
    <bpmn:participant id=\"Participant_1r9kbtn\" name=\"".$nome_modelo."\" processRef=\"Process_1\" />
  </bpmn:collaboration>
  <bpmn:process id=\"Process_1\" isExecutable=\"false\">
    <bpmn:startEvent id=\"StartEvent_1\" />
  </bpmn:process>
  <bpmndi:BPMNDiagram id=\"BPMNDiagram_1\">
    <bpmndi:BPMNPlane id=\"BPMNPlane_1\" bpmnElement=\"Collaboration_1635u9x\">
      <bpmndi:BPMNShape id=\"Participant_1r9kbtn_di\" bpmnElement=\"Participant_1r9kbtn\">
        <dc:Bounds x=\"288\" y=\"118\" width=\"600\" height=\"250\" />
      </bpmndi:BPMNShape>
      <bpmndi:BPMNShape id=\"_BPMNShape_StartEvent_2\" bpmnElement=\"StartEvent_1\">
        <dc:Bounds x=\"344\" y=\"225\" width=\"36\" height=\"36\" />
      </bpmndi:BPMNShape>
    </bpmndi:BPMNPlane>
  </bpmndi:BPMNDiagram>
</bpmn:definitions>

        ";
        return $data;

    }

    public static function get_modelo_default1()
    {
        $data = "
        <?xml version=\"1.0\" encoding=\"UTF-8\"?>
<bpmn:definitions xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xmlns:bpmn=\"http://www.omg.org/spec/BPMN/20100524/MODEL\" xmlns:bpmndi=\"http://www.omg.org/spec/BPMN/20100524/DI\" xmlns:dc=\"http://www.omg.org/spec/DD/20100524/DC\" id=\"Definitions_141dzwv\" targetNamespace=\"http://bpmn.io/schema/bpmn\">
  <bpmn:process id=\"Process_1\" isExecutable=\"false\">
    <bpmn:startEvent id=\"StartEvent_1\" />
  </bpmn:process>
  <bpmndi:BPMNDiagram id=\"BPMNDiagram_1\">
    <bpmndi:BPMNPlane id=\"BPMNPlane_1\" bpmnElement=\"Process_1\">
      <bpmndi:BPMNShape id=\"_BPMNShape_StartEvent_2\" bpmnElement=\"StartEvent_1\">
        <dc:Bounds x=\"173\" y=\"102\" width=\"36\" height=\"36\" />
      </bpmndi:BPMNShape>
    </bpmndi:BPMNPlane>
  </bpmndi:BPMNDiagram>
</bpmn:definitions>
        ";
        return $data;

    }

    public function usuarios_modelos()
    {
        return $this->hasMany(UsuarioModelo::class, 'codmodelo', 'codmodelo');
    }





}
