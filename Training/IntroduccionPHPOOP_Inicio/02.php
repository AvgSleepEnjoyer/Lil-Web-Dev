<?php 
declare(strict_types = 1);
include 'includes/header.php';

// Encapsulacion

class Producto{

    public function __construct(protected string $nombre, public int $precio, public bool $disponible)
    {
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

$producto = new Producto("Tablet", 300, true);

// $producto->mostrarProducto();
echo $producto->getNombre();
$producto->setNombre("Nuevo nombre");

 echo "<pre>";
 var_dump($producto);
echo"</pre>";

$producto2 = new Producto("Computadora Dell", 700, false);

// $producto2->mostrarProducto();
echo $producto2->getNombre();


// echo "<pre>";
// var_dump($producto2);
// echo"</pre>";

include 'includes/footer.php';