// Clases

class Producto{
    constructor(nombre, precio){
        this.nombre = nombre
        this.precio = precio
    }

    formatearProducto(){
        return `El producto ${this.nombre} tiene un precio de ${this.precio}`
    }
    
}

const producto = new Producto("Monitor curvo de 29 pulgadas", 800)

console.log(producto.formatearProducto());

// Herencia

class Libro extends Producto{
    constructor(nombre, precio, isbn){
        super(nombre, precio)
        this.isbn = isbn
    }

    formatearProducto(){
        return `${super.formatearProducto()} y su ISBN es ${this.isbn}`;
    }
}

const libro = new Libro("JavaScript curso", 500, 128768787)
console.log(libro.formatearProducto())

