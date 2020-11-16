<?php

namespace App\Controllers;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\Models\Usuario;
use stdClass;
use App\Components\auth;

class UsuarioController
{
    //     public function registro(Request $request, Response $response, $args){
    //         $usuario = new Usuario();

    //         $datosARegistrar = $request->getParsedBody() ?? [];

    //         if(empty($datosARegistrar)){
    //             $rta = RtaJsend::JsendResponse('Registro Usuario ERROR','No se recibieron datos para registrar');
    //         } else {
    //             $usuario = ValidarPost::RegistroUsuario($usuario, $datosARegistrar);
    //             $rta = RtaJsend::JsendResponse('Registro Usuario',(($usuario->save()) ? 'ok' : 'error'));
    //         }
    //         $response->getBody()->write($rta);
    //         return $response;
    //     }

    public function getAll(Request $request, Response $response, $args)
    {
        $rta = Usuario::select('id','email','tipo')->get();
        //echo "esty";
       // var_dump($rta);
        // $response->getBody()->write("String");
        $response->getBody()->write(json_encode( $rta));
        return $response;
    }

    public function getOne(Request $request, Response $response, $args)
    {
        $rta = Usuario::find($args['id']);

        $response->getBody()->write(json_encode($rta));
        return $response;
    }

    public function addOne(Request $request, Response $response, $args)
    {
       try {
            $user = new Usuario;
            $rta = new stdClass();
           
            $datosARegistrar = $request->getParsedBody() ?? [];
           
            if (!empty($datosARegistrar)
            &&strlen( $datosARegistrar['clave'])>=4) {
               // Usuario::where('email', $datosARegistrar['email'])->firstOrFail();
              
                Usuario:: whereRaw('email = ? OR nombre = ?',array($datosARegistrar['email'], $datosARegistrar['nombre']))->firstOrFail();
                
                // ::where('nombre', $datosARegistrar['nombre'])
                
                //$response->getBody()->write("error: usuario registrado ");
                $rta->message = "error: usuario registrado ";
            } else {
                $rta->message = "no se recibe datos ";
            }
        } catch (\Throwable $th) {
            //throw $th;
            $user->nombre = trim(strtolower($datosARegistrar['nombre']));
            $user->email = strtolower($datosARegistrar['email']);
            $user->tipo =  strtolower($datosARegistrar['tipo']);
            $user->clave = convert_uuencode(strtolower($datosARegistrar['clave']));
            // echo "no esta registrado";
            $rta->message = $user->save();
        } finally {
            $response->getBody()->write(json_encode($rta));
            return $response;
        }
    }
    public function login(Request $request, Response $response, $args)
    {   
       
        $rta = new stdClass();
        try {
            $body = $request->getParsedBody() ?? [];
        $email = $body['email']??'';
        $nombre = $body['nombre']??'';
      
        $clave = convert_uuencode(strtolower($body['clave']));
      

        $userRegitred = Usuario::whereRaw('email = ? OR nombre = ? AND clave = ?',array($email,$nombre,$clave))->firstOrFail();
         //   var_dump($userRegitred['tipo']);
        $rta->message = "todo bien";
           
               $rta->token = auth::signIn($userRegitred['email'],$userRegitred['tipo']);
           
            
            $response->getBody()->write(json_encode($rta));
           return $response;
            ///ACA HAY QUE LLAMAR AL METODO QUE GENERA EL TOKEN
        } catch (\Throwable $th) {
            
            $rta->message = "usuario no registrado";
            $response->getBody()->write(json_encode($rta));
            return $response->withStatus(418);
        }  


        
    }

    public function updateOne(Request $request, Response $response, $args)
    {
        $user = Usuario::find(10);

        $user->usuario = "Pepe Grillo!!";

        $rta = $user->save();

        $response->getBody()->write(json_encode($rta));
        return $response;
    }

    public function deleteOne(Request $request, Response $response, $args)
    {
       
        $user = Usuario::find($args['id']);

        $rta = $user->delete();

        $response->getBody()->write(json_encode($rta));
        return $response;
    }
}
