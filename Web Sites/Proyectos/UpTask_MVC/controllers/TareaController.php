<?php

namespace Controllers;

use Throwable;
use Model\Proyecto;
use Model\Tarea;

class TareaController{
    public static function index() : void {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            # code...
        }
    }

    public static function crear() : void {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            return;
        }

        session_start();

        // Validar que lleguen los datos antes de usarlos
        $proyectoId = $_POST["proyectoId"] ?? null;
        $nombre     = trim($_POST["nombre"] ?? "");

        if (!$proyectoId || $nombre === "") {
            echo json_encode([
                "tipo"    => "error",
                "mensaje" => "Datos incompletos para crear la tarea"
            ]);
            return;
        }

        $proyecto = Proyecto::where("url", $proyectoId);

        if (!$proyecto || $proyecto->propietarioId !== $_SESSION["id"]) {
            echo json_encode([
                "tipo"    => "error",
                "mensaje" => "Hubo un error al agregar la tarea"
            ]);
            return;
        }

        // Crear y guardar la tarea
        try {
            $tarea = new Tarea([
                "nombre"     => $nombre,
                "proyectoId" => $proyecto->id
            ]);

            $resultado = $tarea->guardar(); // ajusta al método real de tu clase

            if ($resultado) {
                echo json_encode([
                    "tipo"    => "exito",
                    "mensaje" => "La tarea fue agregada correctamente"
                ]);
            } else {
                echo json_encode([
                    "tipo"    => "error",
                    "mensaje" => "No se pudo guardar la tarea"
                ]);
            }
        } catch (Throwable $e) {
            // Loguear el error real, pero devolver JSON limpio al cliente
            error_log("Error al crear tarea: " . $e->getMessage());
            echo json_encode([
                "tipo"    => "error",
                "mensaje" => "Hubo un error al agregar la tarea"
            ]);
        }
    }

    public static function actualizar() : void {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            # code...
        }
    }

    public static function eliminar() : void {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            # code...
        }
    }

}