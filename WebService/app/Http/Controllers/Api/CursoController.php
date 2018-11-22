<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Instituicao;
use App\Http\Controllers\Api\BaseController;


class CursoController extends BaseController
{
    public function cursos($campus){
        $cursos = Instituicao::campuses($campus);
        return $this->sendResponse($cursos->toArray(), 'Cursos recuperados com sucesso.');
    }
}
