<?php

namespace Controllers;

use Model\Cita;
use Model\CitaServicio;
use Model\Servicio;

class APIController{

    public static function index(){
        $servicios = Servicio::all();

        echo json_encode($servicios);
    }

    public static function guardar(){
        //almacena la cita y devuelve el Id
        $cita = new Cita($_POST);
        //con esto guardo la cita
        $resultado = $cita->guardar();

        $id = $resultado['id'];

        //almacena la cita y el servicio
        //Con esto separo los servicios por coma y los llamo uno por uno a los servicios(todo esta adentro de un arreglo)
        $idServicios = explode(",", $_POST['servicios']); 

        //almacena los servicios con el id de la cita
        foreach($idServicios as $idServicio){
            $args = [
                'citaId' => $id,
                'servicioId' => $idServicio,
            ];
            $citaServicio = new CitaServicio($args);
            $citaServicio->guardar();
        }

        //retornamos una respuesta
        echo json_encode(['resultado' => $resultado]);
    }

    public static function eliminar(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = $_POST['id'];

            $cita = Cita::find($id);
            $cita->eliminar();
            header('Location:' . $_SERVER['HTTP_REFERER']);
        }
    }
}