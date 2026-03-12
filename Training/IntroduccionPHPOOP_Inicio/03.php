<?php 
declare(strict_types = 1);
include 'includes/header.php';

// Encapsulacion

class Producto{

    public $imagen;
    public static $imagenPlaceholder = "Imagen.jpg";

    public function __construct(protected string $nombre, public int $precio, public bool $disponible, string $imagen)
    {
        if($imagen){
            self::$imagenPlaceholder = $imagen;
        }
    }
    
    public static function obtenerProducto(){
        echo "Obteniendo datos del producto: ";
    }
        
    public static function obtenerImagenProducto(){
        return self::$imagenPlaceholder;
    }

    public function mostrarProducto() : void{
        echo "El producto es " . $this->nombre . " y su precio es: " . $this->precio;
    }

    public function getNombre() : string{
        return $this->nombre;
    }

    public function setNombre(string $nombre){
        $this->nombre = $nombre;
    }
}


$producto = new Producto("Tablet", 300, true, "");

echo $producto->obtenerImagenProducto();

// $producto->mostrarProducto();
echo $producto->getNombre();
$producto->setNombre("Nuevo nombre");

 echo "<pre>";
 var_dump($producto);
echo"</pre>";

$producto2 = new Producto("Computadora Dell", 700, false, "Dell g155.jpg");

echo $producto2->obtenerImagenProducto();

// $producto2->mostrarProducto();
echo $producto2->getNombre();


// echo "<pre>";
// var_dump($producto2);
// echo"</pre>";

include 'includes/footer.php';