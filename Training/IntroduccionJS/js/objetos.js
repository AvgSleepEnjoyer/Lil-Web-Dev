//Objeto literal
const producto = {
    nombre: "Tele",
    precio: 200
}

//Object constructor
function Producto(nombre, precio){
    this.nombre = nombre;
    this.precio = precio
}
const producto2 = new Producto("Consola xbox", 700)

console.log(producto2)