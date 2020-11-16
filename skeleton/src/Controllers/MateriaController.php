<?php

namespace App\Controllers;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\Models\Materia;
use stdClass;
use App\Components\auth;

class MateriaController
{


    public function addOne(Request $request, Response $response, $args)
    {
       try {
            $materia = new Materia;
            $rta = new stdClass();
           
            $datosARegistrar = $request->getParsedBody() ?? [];
           
            if (!empty($datosARegistrar) &&  $datosARegistrar['cuatrimestre'] >0 &&$datosARegistrar['cuatrimestre'] <5 ) {
               // Usuario::where('email', $datosARegistrar['email'])->firstOrFail();
              
                Materia  :: whereRaw('nombre = ? AND cuatrimestre = ?',array($datosARegistrar['materia'], $datosARegistrar['cuatrimestre']))->firstOrFail();
               
                
                // ::where('nombre', $datosARegistrar['nombre'])
                
                //$response->getBody()->write("error: usuario registrado ");
                $rta->message = "error: materia registrada ";
            } else {
                $rta->message = "no se recibe datos ";
            }
        } catch (\Throwable $th) {
            //throw $th;
            $materia->nombre = trim(strtolower($datosARegistrar['materia']));
            $materia->cuatrimestre = $datosARegistrar['cuatrimestre'];
            $materia->cupo =  $datosARegistrar['cupos'];
           
            // echo "no esta registrado";
            $rta->message = $materia->save();
        } finally {
            $response->getBody()->write(json_encode($rta));
            return $response;
        }
    }


}