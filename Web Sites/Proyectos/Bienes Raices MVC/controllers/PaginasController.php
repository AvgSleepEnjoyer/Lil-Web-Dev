<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController{
    public static function index(Router $router){

        $propiedades = Propiedad::get(3);
        $inicio = true;
        $router->render("paginas/index", [
            "propiedades" => $propiedades,
            "inicio" => $inicio
        ]);
    }
    public static function nosotros(Router $router){

        $router->render("paginas/nosotros");

    }
    public static function propiedades(Router $router){

        $propiedades = Propiedad::all();
        $router->render("paginas/propiedades", [
            "propiedades" => $propiedades
        ]);

    }
    public static function propiedad(Router $router){
        
        $id = validarORedireccionar("/propiedades");
        // Buscar propiedad por id
        $propiedad = Propiedad::find($id);

        $router->render("paginas/propiedad", [
            "propiedad" => $propiedad
        ]);

    }
    public static function blog(Router $router){
        $router->render("/paginas/blog");
    }
    public static function entrada(Router $router){
        $router->render("/paginas/entrada");
    }
    public static function contacto(Router $router){

    $mensaje = null;


        
        if($_SERVER["REQUEST_METHOD"] === "POST"){

            $respuestas = $_POST["contacto"];
            
            // Crear instancia
            $mail = new PHPMailer();

            $mail->isSMTP();
            $mail->Host = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Port = 2525;
            $mail->Username = '4eee0d11e2f223';
            $mail->Password = '321fc694630a88';
            $mail->SMTPSecure = "tls";

            // Configurar el contenido del mail
            $mail->setFrom("admin@bienesraices.com");
            $mail->addAddress("admin@bienesraices.com", "BienesRaices.com");
            $mail->Subject = "Tienes un nuevo mensaje";

            // Habilitaar HTML
            $mail->isHTML(true);
            $mail->CharSet = ("UTF-8");


            // Definir el contenido
            $contenido = "<html>";
            $contenido.=  "<p>Tienes un nuevo mensaje.</p>";
            $contenido.=  "<p>Nombre: " . $respuestas["nombre"]  .  "</p>";


            // Enviar de forma condicional algiunos campos de email o telefono
            if($respuestas["contacto"] === "telefono"){
                $contenido.=  "<p>Telefono: " . $respuestas["telefono"]  .  "</p>";
                $contenido.=  "<p>Eligió ser contactado por Telefono.  </p>";
                $contenido.=  "<p>Fecha: " . $respuestas["fecha"]  .  "</p>";
                $contenido.=  "<p>Hora: " . $respuestas["hora"]  .  "</p>";
                
                } else{
                    // Es email, entonces agregamops el campo de email
                    $contenido.=  "<p>Eligió ser contactado por E-mail.  </p>";
                    $contenido.=  "<p>Email: " . $respuestas["email"]  .  "</p>";
            }

            $contenido.=  "<p>Mensaje: " . $respuestas["mensaje"]  .  "</p>";
            $contenido.=  "<p>Vende o compra: " . $respuestas["tipo"]  .  "</p>";
            $contenido.=  "<p>Precio o compra: $" . $respuestas["precio"]  .  "</p>";
            $contenido.=  "<p>Prefiere ser contactado por: " . $respuestas["contacto"]  .  "</p>";

            $contenido.=  "</html>";

            $mail->Body = $contenido;
            $mail->AltBody = "Este es texto alternativo sin html";

            // Enviar el mail
            if($mail->send())
                $mensaje =  "Mensaje enviado correctamente";
            else
                $mensaje =  "El mensaje no se pudo enviar";

        }
        $router->render("/paginas/contacto", [
            "mensaje" => $mensaje
        ]);

    }
    
}