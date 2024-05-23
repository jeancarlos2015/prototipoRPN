<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 16/09/2018
 * Time: 05:58
 */

namespace App\Http\Controllers;


use App\Http\Fachadas\FachadaAbstract;
use Illuminate\Http\Request;

abstract class  ControllerAbstract extends Controller
{
    protected $fachada;

    function __construct($tipo)
    {
        parent::__construct();
        $this->fachada = FachadaAbstract::make($tipo);
    }

    public function index()
    {
        $numArgs = (int)func_num_args();
        $args = func_get_args();
        if ($numArgs == 0) {
            return $this->fachada->index();
        } else if ($numArgs == 1) {
            return $this->fachada->index($args[0]);
        }else if ($numArgs == 2){
            return $this->fachada->index($args[0],$args[1]);
        }
    }

    public function create()
    {
        $numArgs = (int)func_num_args();
        $args = func_get_args();
        switch ($numArgs){
            case 0:
                return $this->fachada->create();
            case 1:
                return $this->fachada->create($args[0]);
            case 2:
                return $this->fachada->create($args[0],$args[1]);
        }
    }

    public function destroy($id)
    {
        return $this->fachada->destroy($id);
    }

    public function show()
    {
        $numArgs = (int)func_num_args();
        $args = func_get_args();
        if ($numArgs == 0) {
            return $this->fachada->show();
        } else if ($numArgs == 1) {
            return $this->fachada->show($args[0]);
        }
    }

    public function edit($codigo)
    {
        return $this->fachada->edit($codigo);
    }

    public function store(Request $request)
    {
        return $this->fachada->store($request);
    }

    public function get(Request $request)
    {
        return $this->fachada->get($request);
    }

    public function update(Request $request, $codigo)
    {
        return $this->fachada->update($request, $codigo);
    }

    public function all()
    {
        return $this->fachada->all();
    }

    public function download($parametro1,$parametro2){
        return $this->fachada->download($parametro1,$parametro2);
    }

    public function traduzir($locale, $pagina){
        return $this->fachada->traduzir($locale, $pagina);
    }

    public function upload(Request $request){
        return $this->fachada->upload($request);
    }

    public function alterar(Request $request, $codigo){
        return $this->fachada->alterar($request,$codigo);
    }

    public function gravar(Request $request){
        return $this->fachada->gravar($request);
    }
}
