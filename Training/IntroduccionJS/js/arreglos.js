// Arreglos

const numeros = [5, 10, 20, 40, 80, 70]


const meses = new Array("Lunes", "Martes", "miercoles", "Jueves")


const arreglo = ["Hola", true, 56, null, {nombre : "Juan", trabajo : "Programador"}, [1, 2, 3]]
console.table(arreglo)

// //Acceder a los valores de un arerglo

// console.log(numeros[0])

// console.log("")

numeros.forEach (function(numero){       //Es como un for i in range el .forEach
    console.log(numero)
    if(numero == 10){
        console.log("10 se encuentra en el arreglo")
        }
    })

const resultado = numeros.includes(10)      //Esto es lo dearriba pero retornando un true mas facilmente
console.log(resultado)                      //No funciona con arreglos de objetos

numeros.push(90)        //Agregar elementos al final

numeros.unshift(-10, -20, -30)      //Agregar elementos al final del arreglo

console.table(numeros)

// meses.pop()       //Elimina elemento al final del arreglo

// meses.shift()     //Elimina elemento del inicio del arreglo

meses.splice(1 , 1)     //Elimina el elemento del indice, y cuantos numeros

console.log(meses)

const nuevoMeses = [...meses, "viernes"]
console.log(nuevoMeses)


const arreglo5 = [
    {Nombre : "Diego", Apellido : "Murillo", Dinero: 500},
    {Nombre : "Carlos", Apellido : "Torres", Dinero: 600},
    {Nombre : "Jose", Apellido : "Alejando", Dinero: 5100},
    {Nombre : "Miguel", Apellido : "Castillo", Dinero: 1500},
    {Nombre : "Mario", Apellido : "Vasqgues", Dinero: 50},
    {Nombre : "Daniel", Apellido : "Piña", Dinero: 20},
    {Nombre : "Jesus", Apellido : "Limon", Dinero: 70},
]

let resultado2 = arreglo5.some(function(id){        
    return id.Nombre === "Diego"
})

console.log(resultado2)

console.log("")
console.log("")

resultado2 = arreglo5.reduce(function(total, a){
    return total + a.Dinero
}, 0)

console.log(resultado2)