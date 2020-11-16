<?php

namespace App\Controllers;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\Models\Inscripcion;

use App\Models\Usuario;
use stdClass;
use App\Components\auth;
use App\Models\Materia;

class InscripcionController
{


    public function addOne(Request $request, Response $response, $args)
    {
       try {
            $inscripcion = new Inscripcion;
            $rta = new stdClass();
          
            $token = auth::check($request->getHeader('token')[0]);
           
            $idMateria = $args['id'];
            //  $datosARegistrar = $request->getParsedBody() ?? [];
             
              if ($idMateria >0) {
                 // Usuario::where('email', $datosARegistrar['email'])->firstOrFail();
             //    $request->getHeader('token')[0]
                Materia::where('id', $idMateria)->firstOrFail();
                  $alumno = Usuario::where('email', $token->email)->firstOrFail();
                 
                  

                  $inscripcion->id_materia = $idMateria;
                  $inscripcion->id_alumno = $alumno['id'];
                 
                  // echo "no esta registrado";
                  $rta->message = $inscripcion->save();


            // if (!empty($datosARegistrar) &&  $datosARegistrar['cuatrimestre'] >0 &&$datosARegistrar['cuatrimestre'] <5 ) {
            //    // Usuario::where('email', $datosARegistrar['email'])->firstOrFail();
              
            //     Inscripcion  :: whereRaw('nombre = ? AND cuatrimestre = ?',array($datosARegistrar['materia'], $datosARegistrar['cuatrimestre']))->firstOrFail();
               
                
       
                
            //     //$response->getBody()->write("error: usuario registrado ");
               
            } else {
                $rta->message = "id invalido ";
            }
        } catch (\Throwable $th) {
            //throw $th;
            // $materia->nombre = trim(strtolower($datosARegistrar['materia']));
            // $materia->cuatrimestre = $datosARegistrar['cuatrimestre'];
            // $materia->cupo =  $datosARegistrar['cupos'];
            $rta->message = "error: materia no registrada ";
            // // echo "no esta registrado";
            // $rta->message = $materia->save();
        } finally {
            $response->getBody()->write(json_encode($rta));
            return $response;
        }
    }


}