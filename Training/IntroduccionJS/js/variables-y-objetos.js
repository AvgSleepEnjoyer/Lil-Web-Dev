"use strict"    //Correr JS en modo estricto "no obedecer todas las reglas no ejecuta"

// Variables

var producto2 = "Audifonos";

// Variables con let

let producto = "Audifonos"

// Variables con const      no va a cambiar de valor

const otroProducto = 5;

// Math

const numero = Math.PI

console.log(numero)

// Objetos

const estudiante = {
    nombre: "Diego Murillo",
    matricula : 2094886,
    cursando : true
}

console.log(estudiante)
console.log(estudiante.nombre)

estudiante.imagen = "imagen.jpg"  //Asi se agrega propiedades
delete estudiante.imagen          //Y asi se borra

const {matricula} = estudiante  // Agarra la variable matricula del objeto, tiene q usarse el nombre original para guardarlo afuera

Object.freeze(estudiante)       //No permitirá modificaciones (añadir, eliminar ni editar)
Object.seal(estudiante)         //Solo permite editar propiedades existentes

console.log(Object.isFrozen(estudiante))    //Dice si el objeto no se puede modificar, retorna 0 o 1
console.log(Object.isSealed(estudiante))    //Reotrna 0 o 1 si el producto tiene object.seal()

const materias = {
    mate : 100,
    español : 98,
    ingles : 70
}

const datos={                   //Se suman las propiedades de los objetos
    ...estudiante, ...materias
}

console.log(datos)